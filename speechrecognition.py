# before use run:
# pip install speechRecognition
# on mac also install:
# brew install portaudio & pip install --global-option='build_ext' --global-option='-I/usr/local/include' --global-option='-L/usr/local/lib' pyaudio
import speech_recognition as sr

swearwords = ['fuck', 'penis', 'hello']
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
