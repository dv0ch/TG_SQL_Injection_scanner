import requests
from bs4 import BeautifulSoup as bs
from urllib.parse import urlparse, urljoin
from urllib.parse import urljoin
import colorama
import pprint
import telebot
import constants

bot = telebot.TeleBot(constants.token)

s = requests.Session()
s.headers["User-Agent"] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Safari/537.36"

# запускаем модуль colorama
colorama.init()

GREEN = colorama.Fore.GREEN
GRAY = colorama.Fore.LIGHTBLACK_EX
RESET = colorama.Fore.RESET
YELLOW = colorama.Fore.YELLOW
RED = colorama.Fore.RED
# инициализировать набор ссылок (уникальные ссылки)
internal_urls = set()
external_urls = set()
total_urls_visited = 0
sql_results = []

def is_valid(url):
    """
    Проверяет, является ли url действительным URL
    """
    parsed = urlparse(url)
    return bool(parsed.netloc) and bool(parsed.scheme)


def get_all_website_links(url):
    """
    Возвращает все URL-адреса, найденные на `url`, в котором он принадлежит тому же веб-сайту.
    """
    # все URL-адреса `url`
    urls = set()
    # доменное имя URL без протокола
    domain_name = urlparse(url).netloc
    soup = bs(requests.get(url).content, "html.parser")
    for a_tag in soup.findAll("a"):
        href = a_tag.attrs.get("href")
        if href == "" or href is None:
            # href пустой тег
            continue
        # присоединяемся к URL, если он относительный (не абсолютная ссылка)
        href = urljoin(url, href)
        parsed_href = urlparse(href)
        # удалить GET-параметры URL, фрагменты URL и т. д.
        href = parsed_href.scheme + "://" + parsed_href.netloc + parsed_href.path
        if not is_valid(href):
            # недействительный URL
            continue
        if href in internal_urls:
            # уже в наборе
            continue
        if domain_name not in href:
            # внешняя ссылка
            if href not in external_urls:
                print(f"{GRAY}[!] Внешняя ссылка: {href}{RESET}")
                external_urls.add(href)
            continue
        print(f"{GREEN}[*] Внутренняя ссылка: {href}{RESET}")
        urls.add(href)
        internal_urls.add(href)
    return urls


def crawl(url, max_urls=30):
    """
    Сканирует веб-страницу и извлекает все ссылки.
    Вы найдете все ссылки в глобальных переменных набора external_urls и internal_urls.
    параметры:
         max_urls (int): максимальное количество URL-адресов для сканирования, по умолчанию - 30.
    """
    global total_urls_visited
    total_urls_visited += 1
    print(total_urls_visited)
    print(f"{YELLOW}[*] Проверена ссылка: {url}{RESET}")
    links = get_all_website_links(url)
    for link in links:
        if total_urls_visited > max_urls or  len(internal_urls)>20:
            break
        crawl(link, max_urls=30)

def crawl_link(link):
    global sql_results
    crawl(link)
    print("[+] Итого внутренних ссылок:", len(internal_urls))
    print("[+] Итого внешних ссылок:", len(external_urls))
    print("[+] Итого URL:", len(external_urls) + len(internal_urls))
    internal_urls.add(link)
    #создание списка с уязвимостями
    for link in internal_urls:
        sql_results.append(scan_sql_injection(link))
    #объединение списков
    result_dict=dict(zip(internal_urls, sql_results))
    #вывод в консоль
    for url,vulnerability in result_dict.items():    
        print(f'{YELLOW}{str(url)}{RESET}:___:{RED}{str(vulnerability)}{RESET}')
    sql_string = ""
    for url,vulnerability in result_dict.items():
        sql_string += (f"{url}:___:{vulnerability}\n")
    print(sql_string)
    return sql_string
    """
    file=open("result1.txt","w")
    counter=0
    for url,vulnerability in result_dict.items():
        counter+=1
        file.write(f'{counter}) {str(url)}:___:{str(vulnerability)} \n ')
    file.close()
    return '../result1.txt'
    """
#===========================================================================================================================

def get_all_forms(url):
    #получение форм из переданного адреса
    soup = bs(s.get(url).content, "html.parser")
    return soup.find_all("form")


def get_form_details(form):
    #полученеи информации о формах
    details = {}
    try:
        action = form.attrs.get("action").lower()
    except:
        action = None
    
    method = form.attrs.get("method", "get").lower()
    
    inputs = []
    for input_tag in form.find_all("input"):
        input_type = input_tag.attrs.get("type", "text")
        input_name = input_tag.attrs.get("name")
        input_value = input_tag.attrs.get("value", "")
        inputs.append({"type": input_type, "name": input_name, "value": input_value})
    
    details["action"] = action
    details["method"] = method
    details["inputs"] = inputs
    return details


def is_vulnerable(response):
    
    errors = {
        # MySQL
        "you have an error in your sql syntax;",
        "warning: mysql",
        # SQL Server
        "unclosed quotation mark after the character string",
        # Oracle
        "quoted string not properly terminated",
    }
    for error in errors:
        
        if error in response.content.decode().lower():
            return True
    # no error detected
    return False


def scan_sql_injection(url):
    #проверка есть ли уязвимость в URL
    for c in "\"'":
        # проверка возможности добавления кавычек
        new_url = f"{url}{c}"
        response = s.get(new_url)
        if is_vulnerable(response):
            #sql Инъекция обнаружена в URL
            case_1 = "[+] SQL Injection vulnerability detected, link: "+ str(new_url)
        
    # Поиск уязвимостей в формах
    forms = get_all_forms(url)
    case_2 = (f"[+] Detected {len(forms)} forms on {url}.")
    
    for form in forms:
        form_details = get_form_details(form)
        for c in "\"'":
            
            data = {}
            for input_tag in form_details["inputs"]:
                if input_tag["value"] or input_tag["type"] == "hidden":
                    
                    try:
                        data[input_tag["name"]] = input_tag["value"] + c
                    except:
                        pass
                elif input_tag["type"] != "submit":
                    
                    data[input_tag["name"]] = f"test{c}"
            url = urljoin(url, form_details["action"])
            if form_details["method"] == "post":
                res = s.post(url, data=data)
            elif form_details["method"] == "get":
                res = s.get(url, params=data)
            
            #вывод сообщения в зависимости от найденных уязвимостей
            if is_vulnerable(res):#нет уязвимости в адрессе, есть в формах
                var_1 = "[+] SQL Injection vulnerability not detected in URL. Cheking for forms" + case_2 +". [+] Form: "+str(form)
                return var_1
            elif is_vulnerable(response)==True:#есть уязвимость в адрессе
                var_3 = case_1
                return var_3
            elif is_vulnerable(response)==False and is_vulnerable(response) == False:#нет уязвимостей вообще
                var_2 = "[+] SQL Injection vulnerability not detected in URL. Cheking for forms. [+] Forms with vulnerability not detected."
                return var_2