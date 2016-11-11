# diana
__The pseudo artificial intelligence made in Javascript__
Click [here](http://dbater.net/projects/diana/) for a live demo (__Note:__ Some functionalities might not work).

Diana started out as a hobby project for me, and has turned out quite well.

Diana uses 
- [Annyang](https://www.talater.com/annyang/) - For it's speech recognition
- [Javascript Speech Synthesis API](https://developers.google.com/web/updates/2014/01/Web-apps-that-talk-Introduction-to-the-Speech-Synthesis-API) - For TTS conversion
- And a bunch of small APIs and algorithms to achieve it's functionalities.

__NOTE:__ Diana was never intended to be a fully fledged AI. It was more of a strict command following robot, made to test the complete power of Javascript.

## Following are a list of some of the commands which diana responds to (new commands are added to the list regularly)

- hello/hi
- what is your name
- what is the time
- calculate {number1} {operation} {number2}
- play a song
- wake me up in {number} {hours/minutes/seconds} (displays timer)
- Close timer
- what is your name
- my name is {name} (saved in cookie for one session)
- what is my name
- search for {query} (not available in live demo. works in localhost)
- tell me a joke/I am bored
- go to sleep
- wake up (requires password, "mc4")
- translate {text} to {language} (currently only hindi and french are supported. Hindi has some known bugs which I am trying to fix)


Apart from that, diana also has a memory which allows it to remember stuff we teach it. The current memory for diana can be viewed [here](http://dbater.net/projects/diana/memory.txt)

## You may modify and redistribute the code anyway you want, but with proper credits
