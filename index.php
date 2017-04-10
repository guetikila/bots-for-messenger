<?php
	require_once 'bots.class.php';
	/**
	 * Webhook for Test Bot- Facebook Messenger Bot
	 * webhook file
	 *
	 * Autor: GUETIKILA Daouda
	 * Date: 06/04/2017
	 * Time: 22:08
	 */

	/**
	  *Pour tester votre bots et local, décommentez les 03 lignes suivantes:
		//$data = Bots::getTestResponse('fruit');
		//Bots::sendTestRequest(Bots::setMessage($message['sender']['id'],$message_retour));
		
	  *Ensuite commentez les 03 lignes suivantes:
		$data = Bots::getResponse();
		Bots::sendRequest(Bots::setMessage($message['sender']['id'],$message_retour));
		
	  *En fin, appeler votre bots dans l'url de la façon suivante: 127.0.0.1/testbots/index.php?input=xxx ou xxx est la 
	   réponse envoyée à votre bots dépuis messenger par l'utilisateur; "bonjour" par exemple.
	   Constatez le contenu au format JSON affiché.
	 */
	 	 
	/* Si le bot reçoit quelque chose */
	if (Bots::authentificationIsOk())
		Bots::setup();

	/* Reception des données en provenance de Facebook Messenger */
	$data = Bots::getResponse();
	//$data = Bots::getTestResponse();

	if ($data) {
		foreach ($data as $message) {

			/* Ignorer les messages de livraison */
			if (!empty($message['delivery'])) {
				continue;
			}
			
			/* Ignorer les écho de mes propres messages */
			if (($message['message']['is_echo'] == "true")) {
				continue;
			}
			
			/* Quand le bot reçoit un message de l'utilisateur */
			if (!empty($message['message'])) {
				$command = $message['message']['text'];

			/* Quand le bot reçoit un click de button click de l'utilisateur */
			} else if (!empty($message['postback'])) {
				$command = $message['postback']['payload'];
			}
			
			/* strtolower: Recevoir toutes les entrées de l'utilisateur en minuscules */
			$command = strtolower($command);
						
			switch ($command) {
				case 'hi':
				case 'hello':
				case 'bonjour':
				case 'bjr':
				case 'salut':
				case 'slt':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Bonjour et bienvenue chez Orange",
								"item_url"=>"http://www.orange.bf",
								"image_url"=>"https://your_serveur/img/logo.jpe",
								"subtitle"=>"Vous rapprocher de l'essentiel !",
							  ]
							]
						  ]
						]];
					break;

				case 'orange':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Orange est une entreprise française de télécommunications. Elle comptait fin 2015 près de 262,9 millions5 de clients dans le monde1, des chiffres en hausse par rapport à ceux affichés en 20146. En 2013, l'entreprise est leader ou second opérateur dans 75 % des pays européens où elle est implantée et dans 83 % des pays en Afrique et au Moyen-Orient",
								"item_url"=>"https://fr.wikipedia.org/wiki/Orange_(entreprise)",
								"subtitle"=>"Source: Wikipédia du 10/04/2017",
							  ]
							]
						  ]
						]];
					break;

				case 'produits':
				case 'produit':
				case 'services':
				case 'service':
				case 'listing':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"list",
							"elements"=>[
							 [
								"title"=>"Service Orange Money",
								"item_url"=>"http://www.orange.bf/particuliers/1/5/orange-money.html",
								"image_url"=>"https://your_serveur/img/money.png",
								"subtitle"=>"Consulter notre site web pour plus de détails",
								"buttons"=>[
								  [
									"type"=>"postback",
									"title"=>"Orange Money",
									"payload"=>"orange_money",
								  ]
								]
							 ],
							 [
								"title"=>"Service Orange Internet",
								"item_url"=>"http://www.orange.bf/particuliers/1/8/forfaits-internet-11.html",
								"image_url"=>"https://your_serveur/img/orange.png",
								"subtitle"=>"Consulter notre site web pour plus de détails",
								"buttons"=>[
								  [
									"type"=>"postback",
									"title"=>"Orange internet",
									"payload"=>"orange_internet",
								  ]
								]
							  ]
							]
						  ]
						]];
					break;

				case 'orange_money':
				case 'money':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Orange Money est le porte-monnaie électronique que le Groupe Orange offre à tous ses clients pour effectuer des transactions financières de diverses natures.",
								"item_url"=>"http://www.orange.bf/particuliers/1/5/orange-money.html",
								"image_url"=>"https://your_serveur/img/money.png",
								"subtitle"=>"Vous rapprocher de l'essentiel !",
								"buttons"=>[
								  [
									"type"=>"postback",
									"title"=>"Comment souscrire?",
									"payload"=>"souscription_orange_money",
								  ],
								  [
									"type"=>"postback",
									"title"=>"Listing des services",
									"payload"=>"listing",
								  ],
								  [
									"type"=>"postback",
									"title"=>"Assistance Orange money",
									"payload"=>"assistance_orance_money"
								  ],                            
								]
							  ]
							]
						  ]
						]];
					break;

				case 'orange_internet':
				case 'internet':
				case 'net':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Orange internet vous permet de profiter des forfaits pour accéder à internet depuis votre ordinateur ou téléphone mobile avec une connexion fluide.",
								"item_url"=>"http://www.orange.bf/particuliers/1/8/forfaits-internet-11.html",
								"image_url"=>"https://your_serveur/img/orange.png",
								"subtitle"=>"Vous rapprocher de l'essentiel !",
								"buttons"=>[
								  [
									"type"=>"postback",
									"title"=>"Comment souscrire?",
									"payload"=>"souscription_orange_internet"
								  ],
								  [
									"type"=>"postback",
									"title"=>"Assistance Orange internet",
									"payload"=>"souscription_orange_internet"
								  ],
								  [
									"type"=>"postback",
									"title"=>"Listing des services",
									"payload"=>"listing"
								  ],                            
								]
							  ]
							]
						  ]
						]];
					break;

				case 'souscription_orange_money':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"L'ouverture d’un porte-monnaie électronique Orange Money est gratuite. Il vous suffit de disposer d’un numéro Orange, qu’il soit un numéro prépayé ou sur facture.",
								"item_url"=>"http://www.orange.bf/particuliers/1/5/orange-money-inscription.html",
								"subtitle"=>"Vous rapprocher de l'essentiel !",
								"buttons"=>[
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/5/orange-money-inscription.html",
									"title"=>"Voir détails..."
								  ]                            
								]
							  ]
							]
						  ]
						]];
					break;

				case 'souscription_orange_internet':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Orange internet vous permet de profiter des forfaits pour accéder à internet depuis votre téléphone avec une connexion fluide.",
								"item_url"=>"http://www.orange.bf/particuliers/1/8/forfaits-internet-11.html",
								"subtitle"=>"Vous rapprocher de l'essentiel !",
								"buttons"=>[
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/8/forfaits-internet-11.html",
									"title"=>"Forfait internet"
								  ],
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/8/services-internet-12.html",
									"title"=>"Service internet"
								  ],
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/8/astuces-internet-13.html",
									"title"=>"Astuces internet"
								  ]                          
								]
							  ]
							]
						  ]
						]];
					break;

				case 'assistance_orance_money':
					$message_retour = ["attachment"=>[
						  "type"=>"template",
						  "payload"=>[
							"template_type"=>"generic",
							"elements"=>[
							  [
								"title"=>"Assistance Orange money:",
								"item_url"=>"http://www.orange.bf/particuliers/1/5/orange-money-deposer-retirer-argent.html",
								"subtitle"=>"Visitez notre site web pour plus de détails...",
								"buttons"=>[
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/5/orange-money-deposer-retirer-argent.html",
									"title"=>"Dépôt et retrait d'argent"
								  ],
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/5/orange-money-envoyer-argent.html",
									"title"=>"Transfert d'argent"
								  ],
								  [
									"type"=>"web_url",
									"url"=>"http://www.orange.bf/particuliers/1/5/orange-money-effectuer-paiement.html",
									"title"=>"Effectuer un paiement"
								  ]                           
								]
							  ]
							]
						  ]
						]];
					break;
					
				default:
					if (!empty($command))
						$message_retour = 'Je ne vous ai pas bien compris, veuillez être plus claire SVP.';
		   } /* End case */
			
			/* Si le message de retour est défini on envoie la réponse du bots à l'utilisateur */
			if(isset($message_retour)){
				Bots::sendRequest(Bots::setMessage($message['sender']['id'],$message_retour));
				//Bots::sendTestRequest(Bots::setMessage($message['sender']['id'],$message_retour));
			}
			
		} /* End foreach */
	} /* End if($data) */