<html>
<head>
<script src="annyang2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="AsyncTask.min.js"></script>
<script type="text/javascript" src="transliteration.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//cdn.cleverbot.io/build/1.0/cleverbot.io.min.js"></script>
<script type="text/javascript" src="CleverBot/Bot.js"></script>
<script type="text/javascript" src="Webcam/Webcam.js"></script>
<script type="text/javascript" src="Webcam/Picture.js"></script>
<script type="text/javascript" src="Chobi/Chobi.js"></script>


<script>
var isLearning = false;
var isLearningPassword = null;
var qcmd = "";
var init = true;
var result = 0;
var isPlaying=false;
var timerOn=false;
var alarmTime=0;
var sleep = false;
var client = "";
var theTimer;
var pwdreq = false;
var imageMode = false;
window.onkeypress=function(e){
if(e.keyCode == 32){
	if(isPlaying){
		isPlaying=false;
		document.getElementById("msong").pause();
	}
	else{
		isPlaying=true;
		document.getElementById("msong").play();
	}

}
}


function newInformation(key,value){
	var mAsyncTask = new AsyncTask(
		function(){

		},
		{
			url: 'teach.php',
			method: 'POST',
			data:{
				pwd: isLearningPassword,
				key: key,
				value: value
			}
		},
		function(s,r){
			speak(r);
		}
	);
	mAsyncTask.execute();
}

function getRandomArbitrary(min, max) {
    return Math.round(Math.random() * (max - min) + min);
}


var msg = new SpeechSynthesisUtterance();
var voices = window.speechSynthesis.getVoices();
msg.voice = voices[2];
msg.lang = 'en-US';
msg.voiceURI = 'native';
msg.rate=0.9;
msg.pitch=1;


function getJoke(){
	if(sleep) return;
	 var xhttp;
  if (window.XMLHttpRequest) {
    // code for modern browsers
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
	 if(xhttp.readyState == 4 && xhttp.status == 200){
		msg.text=xhttp.responseText+". Hahahahaha!";
		window.speechSynthesis.speak(msg);
	}
  };
  xhttp.open("GET", "get_joke.php", true);
  xhttp.send();
}

function ajaxGet(url) {
  if(sleep) return;
  var xhttp;
  if (window.XMLHttpRequest) {
    // code for modern browsers
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
	 if(xhttp.readyState == 4 && xhttp.status == 200){
		if(xhttp.responseText == "The Result is. answer") msg.text="some error occured";
		else msg.text=xhttp.responseText;
		window.speechSynthesis.speak(msg);
	}
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}
var wndw;

function speak(speech){
	if(pwdreq) {
		msg.text='Incorrect password';
		window.speechSynthesis.speak(msg);
	}
	if(sleep) return;
	msg.text=speech;
	window.speechSynthesis.speak(msg);
}


function getTemperature(q){
	var asyncTask = new AsyncTask(
	function(){},
	{
		'url': 'http://api.apixu.com/v1/current.json?key=03edffb8122e4957af7110843161111&q='+q,
		'method': 'GET',
		'data':{
		}
	},
	function(s,a){
		try{
			a = JSON.parse(a);
			var temp_c = a.current.temp_c;
			var condition = a.current.condition.text;
			var humidity = a.current.humidity;
			speak("Weather forecast of "+q+". The temperature is "+temp_c+' degrees celcius. Sky looks to be '+condition+'. Humidity '+humidity);
		}
		catch(e){
			speak("Can't retrieve weather. Sorry. Reason. "+e);
		}
	}
	);
	asyncTask.execute();
}


function showTimer(time){
time/=1000;
theTimer = setInterval(function(){
		document.getElementById("minfo").style.zIndex="1000";
		document.getElementById("minfo").style.opacity="0.8";
		var date = new Date(null);
		date.setSeconds(time); // specify value for SECONDS here
		if(time == 0) {
			clearInterval(theTimer);
			document.getElementById("minfo").style.opacity="0.0";			
			document.getElementById("minfo").style.zIndex="1000";
			document.getElementById("maudio").innerHTML = '<audio id="msong" src="'+"http://www.nakano.kylos.pl/temp/George%20Michael%20-%20Careless%20whisper.mp3"+'" autoplay></audio>';
			return;
		}
		document.getElementById("minfo").innerHTML=date.toISOString().substr(11, 8);
		time--;
		},1000);
}

function getTranslatedData(q,lang){
			$.ajax({
			 	url: 'translate.php?tl='+lang+'&q='+encodeURI(q.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"")),
			 	success: function(e){
			 		var str = e.substr(4);
			 		str = str.substr(0,str.indexOf('"'));
			 		if(lang==='hindi'){
			 			transliterate(str);
			 		}
			 		else{
			 			speak(str);
			 		}
			 	},
			 	error: function(e){
			 		alert("Error"+e);
			 	}
			 });
		}


function transliterate(q){
			//google.load("language", "1");
			//var arr = new Array(q);
			//google.language.transliterate(arr, 'hi', 'en', function(str){
				var str = transl(q);
				str = str.replace(/kmbkht/g,'kumbakt');
				str = str.replace(/nmste/g,'namaste');
				speak(str);
			//});
		}

function evaluateExpression(str){
str = str.replace(/result/g,result);
str = str.replace(/resultant 2/g,result+' into');
str = str.replace(/resultant/g,result+'into');

str = str.replace(/hundred/g,'');
str = str.replace(/thousand/g,'');
str = str.replace(/and/g,'');

str = str.replace(/modulo/g,'%');
str = str.replace(/modulus/g,'%');
str = str.replace(/mod/g,'%');
str = str.replace(/multiplied by/g,'*');
str = str.replace(/divided by/g,'/');
str = str.replace(/star/g,'*');
str = str.replace(/into/g,'*');
str = str.replace(/times/g,'*');
str = str.replace(/minus/g,'-');
str = str.replace(/by/g,'/');
try{
 result = eval(str);
 return eval(str);
}
catch(e){
 return "Invalid expression";
}
}

if (annyang) {
speak('Hi I am Diana. How can I help you?');
  // Let's define our first command. First the text we expect, and then the function it should call
  var commands = {
  	'Education mode on *q': function(q){
  		isLearningPassword = q;
  		isLearning = true;
  		speak('Education mode on with password, '+q);
  	},
  	'Education mode :off': function(off){
  		if(off!="off"&&off!='of')
  			return;
  		isLearningPassword = null;
  		isLearning = false;
  		speak('Education mode off');
  	},
  	'learn *q': function(q){
  		if(isLearning){
  			var values = q.split(' is ');
  			var key = values[0];
  			var value = values[1];
  			newInformation(key,value);	
  		}
  		else{
  			speak('Education mode is not on');
  		}
  	},
	'Wake up': function(){
		if(!sleep){
			speak('I am up, you blind idiot');
			return;
		}
		sleep=false;
		speak('What is the password?'); 
		pwdreq = true;
		sleep=true;
	},
	'(Diana) (go to) sleep': function(){
		speak('Going to sleep.');
		sleep = true;
	},
	'hello': function() {
		speak('Hello there');
	},
	'diana': function(){
		speak('Yes master?');
	},
	'how are you': function() {
		speak('I am fine. How are you?');
	},
	'I am sorry': function() {
		speak('It\'s okay '+client);
	},
	'Im sorry': function() {
		speak('It\'s okay '+client);
	},
	'what is your age': function(){
		speak('I am a computer program. I dont age, you idiot!');
	},
	'how old are you': function(){
		speak('I am 379 years old.');
	},
	'search (for) *query': function(query){
		speak('Searching for. '+query);
		if(!sleep)
		wndw=window.open("http://www.google.com/search?q="+query,'_blank');
	},
	'google (for) *query': function(query){
		speak('Searching for. '+query);
		if(!sleep)
		wndw=window.open("http://www.google.com/search?q="+query,'_blank');
	},
	'close (this) tab':function(){
		speak('Closing all opened tabs');
		if(!sleep)
		wndw.close();
	},
	'calculate *q': function(q){
		speak(evaluateExpression(q));	
	},
	'i *q you': function(q){
		speak('I am incapable of '+q+'. But for you, I will make an exception.');
	},
	'what is the time (now)': function(){
		var d=new Date();
		var hours=d.getHours();
		var ampm = "a m";
		if(hours>12) {hours-=12;ampm="p m";}
		speak('The time is '+hours+":"+d.getMinutes()+" "+ampm);
	},
	'what is my name': function(){
		if(client=="") speak('I do not know. What is your name?');
		else speak('Your name is '+client);
	},
	'my name is *n': function(n){
		speak('Nice to meet you '+n+', i am diana');
		if(!sleep)
		client = n;
	},
	'I am very bored': function(){
		getJoke();
	},

	'i am *n': function(n){
		speak('Nice to meet you '+n+', i am diana');
		if(!sleep)
		client = n;
	},
	'who is your master': function(){
		speak('I was created by j0y.');
	},
	'what is the weather :c *place': function(c,place){
		if(c==="of"||c==="in"||c==="on") getTemperature(place);
		else{

		}
	},
	'play (a) *q song': function(q){
		var songs = [
	"http://hcmaslov.d-real.sci-nnov.ru/public/mp3/Michael%20Jackson/Michael%20Jackson%20'Billie%20Jean'.mp3",
	"http://hcmaslov.d-real.sci-nnov.ru/public/mp3/Michael%20Jackson/Michael%20Jackson%20'Beat%20It'.mp3",
	"http://www.nakano.kylos.pl/temp/George%20Michael%20-%20Careless%20whisper.mp3",
	"http://www.thegeekdoctor.com/private/MusicSingle/Metal/Guns%20N%20Roses/Guns%20N%20Roses%20-%20Paradise%20City.mp3",
	"http://www.thegeekdoctor.com/private/MusicSingle/Metal/Guns%20N%20Roses/Guns%20n'%20Roses%20-%20Sweet%20Child%20O'%20Mine.mp3",
	"http://hcmaslov.d-real.sci-nnov.ru/public/mp3/ABBA/ABBA%20'S.%20O.%20S.%20'.mp3"
	];
		var r = getRandomArbitrary(0,songs.length-1);
		speak('playing '+q+' song');
		if(!sleep)
		setTimeout(function(){document.getElementById("maudio").innerHTML = '<audio id="msong" src="'+songs[r]+'" autoplay></audio>';},1500);
		isPlaying=true;
	},
	'stop (the) song': function(){
		isPlaying=false;
		document.getElementById("msong").pause();
		speak('Stopping the song.');
	},
	'what is up': function(){
		speak('Nothing much. You say.');
	},
	'Tell (me) (a) (another) joke': function(){getJoke();},
	'wake me up in :num :unit':function(num,unit){
		var tmp=0;;
		if(isNaN(num)){
			speak('Invalid command');
			return;
		}
		if(unit=="hour"||unit=="hours") tmp=num*3600;
		else if(unit=="minute"||unit=="minutes") tmp=num*60;
		else if(unit=="second"||unit=="seconds") tmp=num*1;
		else{
			speak("What the hell is a "+unit+"? Use proper units like hours, minutes, or seconds.");
			return;
		}
		alarmTime=tmp*1000;
		speak("Setting timer for: "+num+" "+unit);
		timerOn=true;
	},
	'Translate *q to :lang': function(q,lang){
					getTranslatedData(q,lang);
		},
	'set timer for :num :unit':function(num,unit){
		var tmp=0;;
		if(isNaN(num)){
			speak('Invalid command');
			return;
		}
		if(unit=="hour"||unit=="hours") tmp=num*3600;
		else if(unit=="minute"||unit=="minutes") tmp=num*60;
		else if(unit=="second"||unit=="seconds") tmp=num*1;
		else{
			speak("What the hell is a "+unit+"? Use proper units like hours, minutes, or seconds.");
			return;
		}
		alarmTime=tmp*1000;
		speak("Setting timer for: "+num+" "+unit);
		timerOn=true;
	},
	':end timer': function(end){
		if(end=="close"||end=="terminate"||end=="stop"){
			if(sleep) return;
			clearInterval(theTimer);
			document.getElementById("minfo").style.opacity="0.0";
			speak("Timer "+end+" successful");
		}	
	},
	'image mode on': function(){
		if(imageMode){
			speak("Image mode is already on");
			return;
		}
		initializeCamera();
		imageMode = true;
		speak("Image mode is on");
	},
	'image mode :off': function(off){
		if(off==="off"||off==="of"){
			if(!imageMode){
				speak("Image mode is already off");
				return;
			}
			resetCamera();
			imageMode = false;
			speak("Image mode is off");
			return;
		}
		getAIResponse("image mode "+off);
	},
	'show preview': function(){
		if(!imageMode){
			speak("Image mode is not on");
			return;
		}
		showPreview();
		speak("Showing preview");
	},
	'hide preview': function(){
		if(!imageMode){
			speak("Image mode is not on");
			return;
		}
		hidePreview();
		speak("Preview hidden");
	},
	'take (a) picture': function(){
		if(!imageMode){
			speak("Image mode is not on");
			return;
		}
		speak("Taking picture");
		setTimeout(function(){
			takePicture();
			speak("Should I save it?");
			qcmd = "savePicture();";
		},2000);

	},
	'hide (the) picture': function(){
		if(!imageMode){
			speak("Image mode is not on");
			return;
		}
		speak("Hiding picture");
		hidePicture();
	},
	'make (the) picture *effect': function(effect){
		if(!imageMode){
			speak("Image mode is not on");
			return;
		}
		effect = effect.toLowerCase();
		speak("Making picture "+effect);
		setTimeout(function(){
			if(effect === "black and white"){
				chobi.blackAndWhite().loadImageToCanvas();
			}
			else if(effect === "sepia"){
				chobi.sepia.loadImageToCanvas();
			}
			else if(effect === "crayon"){
				chobi.crayon().loadImageToCanvas();
			}
			else if(effect === "cartoon"){
				chobi.cartoonify.loadImageToCanvas();
			}
			else if(effect === "vintage"){
				chobi.vintage().loadImageToCanvas();
			}
			else{
				speak("Effect not present right now. Sorry");
			}
		},2000);
	},
	'save (the) picture': function(){
		speak("Saving picture");
		savePicture();
	},
	'yes (please)':function(){
		if(qcmd!=""){
			eval(qcmd);
			speak('Sure');
			qcmd="";
		}
	},
	'ok':function(){
		if(qcmd!=""){
			eval(qcmd);
			speak('Sure');
			qcmd="";
		}
	},
	'sure':function(){
		if(qcmd!=""){
			eval(qcmd);
			speak('Sure');
			qcmd="";
		}
	},
	'no': function(){
		speak('If you say so');
		if(qcmd==="savePicture();"){
			hidePicture();
		}
		qcmd="";
	},
	// 'command *q': function(q){
	// 	var mAsyncTask = new AsyncTask(
	// 		function(){

	// 		},
	// 		{
	// 			url: 'command.php',
	// 			method: 'POST',
	// 			data:{
	// 				q: q
	// 			}
	// 		},
	// 		function(s,r){
	// 			console.log(r);
	// 		}
	// 	);
	// 	mAsyncTask.execute();
	// },
	':start :is *key': function(start,is,key){
		if(start!="who"&&start!="where"&&start!="what"){
			getAIResponse(start+' '+is+' '+key);	
			//speak(start+' '+is+' '+key+'? I did not understand that. Please speak again');
			return;
		}
		var mAsyncTask = new AsyncTask(
			function(){

			},
			{
				url: 'remember.php',
				method: 'POST',
				data:{
					key: key
				}
			},
			function(status,response){
				if(status){
					if(response == 'Null'){
						getAIResponse(start+" "+is+" "+key);
						//speak('I dont know '+start+' '+is+' '+key+'. Should I Google it?');
						//qcmd = "wndw=window.open('http://www.google.com/search?q="+start+"+"+is+"+"+encodeURIComponent(key)+"','_blank');";
					}
					else{
						if(key=="your name"){
							key = "My Name";
						}
						speak(key+' '+is+' '+response);						
					}
				}
				else{
					speak('Some error occured. Please try again');
				}
			}
		);
		mAsyncTask.execute();
	},
	'*q': function(q){
		if(pwdreq){
			if(q=="mc4"){
				sleep=false;			
				pwdreq = false;
				speak('Welcome back '+client+'!');
			}
			else{
				sleep=false;					
				pwdreq = false;
				speak('Incorrect password');
				sleep=true;
			}
			return;
		}
		var curses = ['fuck','shit'];
		curses.forEach(function(item,index){
			if(q.includes(item)) {
				speak('Why are you swearing? Be polite.');
				return;
			}
		});

		getAIResponse(q);
	}
	
  };

  // Add our commands to annyang
  annyang.addCommands(commands);

  // Start listening. You can call this here, or attach this call to an event, button, etc.
 
}

var animateFlag=false;
var animation = 0;

msg.onstart = function(){
	document.getElementById("minfo").style.zIndex="1000";
	document.getElementById("minfo").innerHTML=msg.text;
	document.getElementById("minfo").style.opacity="0.8";
	if(!init)
		annyang.pause();
	animateFlag=true;
	animate();
};
msg.onend = function(){
	animateFlag=false;
	if(init){
		annyang.start();
		init = false;
	}
	else annyang.resume();
	document.getElementById("minfo").style.opacity="0.0";	
	document.getElementById("minfo").style.zIndex="-1000";
	if(timerOn){
		setTimeout(function(){document.getElementById("maudio").innerHTML = '<audio id="msong" src="http://www.thegeekdoctor.com/private/MusicSingle/Metal/Guns%20N%20Roses/Guns%20n\'%20Roses%20-%20Sweet%20Child%20O\'%20Mine.mp3" autoplay></audio>';isPlaying=true;},alarmTime+1000);
		showTimer(alarmTime);
		timerOn=false;
	}
};

function animate(){
	var sphere = document.getElementById("sphere");
	var animator = setInterval(function(){
		if(!animateFlag){
			sphere.style.backgroundColor = "#4444ff";
			window.clearInterval(animator);
			return;
		}
		if(animation==0) {
			sphere.style.backgroundColor = "#f0f0f0";
			animation=1;
		}
		else{
			sphere.style.backgroundColor = "#4444ff";
			animation=0;
		}
		
	},200);
}


function getAIResponse(q){
	askCleverBot(q);
}
</script>

<style>
#sphere {
   width: 60px;
   height: 60px;
   position: absolute;
   top: 45%;
   left: 45%;
   margin-left: -(60/2)px;
   margin-top: -(60/2)px;
   opacity: 0.7;
}
body{
	margin: 0px;
}
#webcam-picture-container{
	position: absolute;
	z-index: 99;
	display: none;
}
#saved-image-container{
	position: absolute;
	width: 320px;
	height: 240px;
	z-index: 100;
}
</style>
</head>
<body>
<span id="minfo" style="background-color:#0a0a0a;position:fixed;z-index:-1000;width:100%;padding:1%;transition-duration:0.2s;color:#e5e5e5;text-align:center;font-weight:bold;font-family:arial;font-size:500%;margin-top:15%;"></span>
<div style="position:absolute;width:100%;height:100%;"><img src="bg.png" style="width:100%;height:100%;" ></div>
<span id="sphere" style="transition-duration:0.5s;border-radius:50%;padding:3%;background-color:#4444ff;cursor:none;border:1px solid black;box-shadow:0px 0px 15px #f0f0f0;" onmouseover="javascript:speak('That is my heart. Please do not touch it.');this.style.backgroundColor='#ff4444';this.style.boxShadow='0px 0px 15px #0a0a0a';" onmouseout="javascript:this.style.backgroundColor='#4444ff';this.style.boxShadow='0px 0px 15px #f0f0f0';" ></span>

<div id="webcam-picture-container"></div>
<canvas id="saved-image-container"></canvas>

<div id="maudio"></div>
<div id="alarm">

</body>
</html>
