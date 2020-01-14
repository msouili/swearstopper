# before use run:
# pip install speechRecognition
# on mac also install:
# brew install portaudio & pip install --global-option='build_ext' --global-option='-I/usr/local/include' --global-option='-L/usr/local/lib' pyaudio
import speech_recognition as sr
import mysql.connector
from mysql.connector import Error
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)

GPIO.setup(23, GPIO.OUT)

GPIO.setup(23, GPIO.LOW)

swearwords = ['hello']

r = sr.Recognizer()
while True:
    with sr.Microphone() as source:
        print('Say Something!')
        r.adjust_for_ambient_noise(source)
        audio = r.listen(source)
        print('Done!')

    try:
        text = r.recognize_google(audio) or '123'
        print(text)
    
    except:
        print("Ich hab dich nicht verstanden")

    if any(word in text for word in swearwords):
        print('stop swearing!')
        GPIO.output(23, GPIO.HIGH)
        time.sleep(0.5)
        GPIO.output(23, GPIO.LOW)
    