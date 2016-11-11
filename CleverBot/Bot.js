	var bot = new cleverbot('G5G0OEQ5Fm5TWrU9','sxvckufwcChfggXS51EmIszRMs05SKpD');
	bot.setNick("Diana");
	bot.create(function (err, session) {
		console.log(session);
	  // session is your session name, it will either be as you set it previously, or cleverbot.io will generate one for you

	  // Woo, you initialized cleverbot.io.  Insert further code here
	});

	function askCleverBot(q){
		try{
			console.log(q);
			bot.ask(JSON.stringify(q), function (err, response) {
				speak(response);
			});
		}
		catch(e){
			speak("I don't know what to say");
		}
	}