# before use run:
# pip install speechRecognition
# on mac also install:
# brew install portaudio & pip install --global-option='build_ext' --global-option='-I/usr/local/include' --global-option='-L/usr/local/lib' pyaudio
import speech_recognition as sr
import mysql.connector
from mysql.connector import Error

swearwords = []

def getSwearWords(result):
    for item in result:
        swearwords.append(item[0])
    for word in swearwords:
        print(word)
    
try:
    connection = mysql.connector.connect(host='127.0.0.1', database='swearstopper', user='root', password='root')
    if connection.is_connected():
        db_Info = connection.get_server_info()
        print("Connected to MySQL Server version ", db_Info)
        cursor = connection.cursor(buffered=True)
        query = cursor.execute("SELECT * FROM forbidden_words")
        result = cursor.fetchall()
        getSwearWords(result)

except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if (connection.is_connected()):
        cursor.close()
        connection.close()
        print("MySQL connection is closed")

r = sr.Recognizer()
while True:
    with sr.Microphone() as source:
        print('Say Something!')
        audio = r.listen(source)
        print('Done!')

    text = r.recognize_google(audio)
    print(text)

    if any(word in text for word in swearwords):
        print('stop swearing!')
