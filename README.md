 Webhook for Test Bot- Facebook Messenger Bot
 Autor: GUETIKILA Daouda
 Date: 06/04/2017
 Time: 22:08
 
 NB: 
 1 - Lisez attentivement ce document
 2 - Votre WEBHOOK est index.php

 
I - Configuration:
	1 - Remplacer your_serveur dans index.php par l'adresse de votre serveur
	2 - Remplacer YOUR_ACCESS_TOKEN dans bpts.class.php par votre token facebook
	3 - Remplacer YOUR_APP_VERIFY_TOKEN dans bpts.class.php par le token de v�rification que vous avez saisie dans FaceBook

II - Test:
  1 - Pour tester votre bots et local, d�commentez les 03 lignes suivantes:
	//$data = Bots::getTestResponse('fruit');
	//Bots::sendTestRequest(Bots::setMessage($message['sender']['id'],$message_retour));
	
  2 - Ensuite commentez les 03 lignes suivantes:
	$data = Bots::getResponse();
	Bots::sendRequest(Bots::setMessage($message['sender']['id'],$message_retour));
	
  3 - En fin, appeler votre bots dans l'url de la fa�on suivante: 127.0.0.1/testbots/index.php?input=xxx ou xxx est la 
	  r�ponse envoy�e � votre bots d�puis messenger par l'utilisateur; "bonjour" par exemple.
	  
  4 - Constatez le contenu au format JSON affich�.