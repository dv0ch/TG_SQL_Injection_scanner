import requests
from urllib.parse import urlparse, urljoin
from bs4 import BeautifulSoup
import colorama

# запускаем модуль colorama
colorama.init()

GREEN = colorama.Fore.GREEN
GRAY = colorama.Fore.LIGHTBLACK_EX
RESET = colorama.Fore.RESET
YELLOW = colorama.Fore.YELLOW

# инициализировать набор ссылок (уникальные ссылки)
internal_urls = set()
external_urls = set()

total_urls_visited = 0


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
    soup = BeautifulSoup(requests.get(url).content, "html.parser")
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
    print(f"{YELLOW}[*] Проверена ссылка: {url}{RESET}")
    links = get_all_website_links(url)
    for link in links:
        if total_urls_visited > max_urls:
            break
        crawl(link, max_urls=max_urls)


if __name__ == "__main__":
    crawl('http://testphp.vulnweb.com/artists.php?artist=1')

    print("[+] Итого внутренних ссылок:", len(internal_urls))
    print("[+] Итого внешних ссылок:", len(external_urls))
    print("[+] Итого URL:", len(external_urls) + len(internal_urls))
    print(internal_urls)