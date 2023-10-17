import telebot
from telebot import types
import base_scanner1
import validators
import requests

import constants


bot = telebot.TeleBot(constants.token)
s = requests.Session()


@bot.message_handler(commands=['start'])
def start_func(message):
    markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
    scan = types.KeyboardButton('🔍 Сканирование')
    lk = types.KeyboardButton('🗄🖥Личный кабинет')
    other = types.KeyboardButton('➡️Другое')

    markup.add(scan, lk, other)
    bot.send_message(message.from_user.id, "Добро пожаловать, {0.first_name}!".format(
        message.from_user), reply_markup=markup)


@bot.message_handler(content_types=["text"])
def bot_message(message):
    if message.text == '🔍 Сканирование':
        markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
        lite_scan = types.KeyboardButton('🔍 Lite сканнер')
        pro_scan = types.KeyboardButton('🔎 Pro сканнер')
        back = types.KeyboardButton('⬅️ Назад')
        markup.add(lite_scan, pro_scan, back)

        bot.send_message(message.from_user.id,
                         "🔍 Сканирование", reply_markup=markup)

    elif message.text == "🗄🖥Личный кабинет":
        buttons = types.InlineKeyboardMarkup()
        url_button = types.InlineKeyboardButton(
            text='Личный кабинет', url='https://usnd.to/sPPc3')
        buttons.add(url_button)
        mention = f'<a href="tg://user?id={message.from_user.id}">{message.from_user.first_name}</a>'
        bot.send_message(message.from_user.id, text=f'<b>Ваш личный кабинет, </b> {mention}, \n<a href="URL"><i>https://usnd.to/sPPc3</i></a>',
                         parse_mode="HTML", reply_to_message_id=message.message_id, reply_markup=buttons)

    elif message.text == "➡️Другое":
        markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
        sets = types.KeyboardButton('⚙️Настройки')
        info = types.KeyboardButton('ℹ️ Информация')
        back = types.KeyboardButton('⬅️ Назад')
        markup.add(sets, info, back)

        bot.send_message(message.from_user.id, "➡️Другое", reply_markup=markup)

    elif message.text == "ℹ️ Информация":
        bot.send_message(
            message.from_user.id, text="____ℹ️ Информация ℹ️____ \nСоздатель бота - Я любимый \nВерсия бота - 0.1", parse_mode="HTML")

    elif message.text == "⚙️Настройки":
        markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
        reg = types.KeyboardButton('👤Регистрация')
        osets = types.KeyboardButton('Другие настройки')
        back = types.KeyboardButton('⬅️ Назад')
        markup.add(reg, osets, back)

        bot.send_message(message.from_user.id, "⚙️Настройки", reply_markup=markup)

    elif message.text == "👤Регистрация":
        bot.send_message(message.from_user.id, "Ваш уникальный ключ для регистрации на сайте:")
        bot.send_message(message.from_user.id, str(message.from_user.id))

    elif message.text == '⬅️ Назад':
        markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
        scan = types.KeyboardButton('🔍 Сканирование')
        lk = types.KeyboardButton('🗄🖥Личный кабинет')
        other = types.KeyboardButton('➡️Другое')

        markup.add(scan, lk, other)
        bot.send_message(message.from_user.id, "⬅️ Назад", reply_markup=markup)

    elif message.text == "🔍 сканнер":
        send_url = bot.send_message(message.from_user.id, "Введите URL-адрес")
        global send_list
        send_list = [send_url, message.from_user.id]
        bot.register_next_step_handler(send_url, lite_scan_obr)
        print("succesful")


def lite_scan_obr(message):
    try:
        messsage = base_scanner1.crawl_link(message.text)
        bot.send_message(send_list[1], messsage)
    except requests.exceptions.ConnectTimeout:
        bot.send_message(send_list[1], "Ошибка проверки адреса")
    except requests.exceptions.MissingSchema:
        bot.send_message(send_list[1], "Ошибка ввода адреса")
    except requests.exceptions.ConnectionError:
        bot.send_message(send_list[1], "Проблема соединения")
    except requests.exceptions.InvalidURL:
        bot.send_message(send_list[1], "Не правильно введен адрес")

bot.polling(none_stop=True, interval=0)
