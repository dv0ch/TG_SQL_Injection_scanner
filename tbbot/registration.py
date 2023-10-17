import mysql.connector
import telebot
import constants
from mysql.connector import Error

bot = telebot.TeleBot(constants.token)

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="user_db"
)

mycursor = mydb.cursor()

mycursor.execute("SHOW TABLES")
