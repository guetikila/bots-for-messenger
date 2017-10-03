<?php
	/**
	 * Webhook for Test Bot- Facebook Messenger Bot
	 * Bots class
	 *
	 * Autor: GUETIKILA Daouda
	 * Date: 06/04/2017
	 * Time: 22:08
	 */
	 
	class Bots {
		const API_URL 	= 'https://graph.facebook.com/v2.6/me/messages?access_token=YOUR_ACCESS_TOKEN';
		const APP_TOKEN = 'YOUR_APP_VERIFY_TOKEN';
		
		public static function sendRequest($data,$type='POST'){
			$ch = curl_init(self::API_URL);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			curl_close($ch);
			return json_decode($result, true);
		}

		public static function sendTestRequest($data,$type='POST'){
			echo '<pre>';
			print_r(json_decode($data));
			echo '</pre>';
		}
		
		public static function setMessage($user_id,$message){
			$data['recipient']['id'] = $user_id;
			if(is_array($message))
				$data['message'] = $message;
			else
				$data['message']['text'] = $message;
			return json_encode($data);
		}

		public static function getResponse(){
			$data = self::getAllData();
			return (isset($data['entry'][0]['messaging']) && !empty($data['entry'][0]['messaging'])) ? $data['entry'][0]['messaging'] : false;
		}

		public static function getTestResponse(){
			if(isset($_GET['input']) && !empty($_GET['input']))
				$input = $_GET['input'];
			else
				$input = 'bonjour';
			$data[0]['delivery'] = '';
			$data[0]['message']['is_echo'] = '';
			$data[0]['message']['text'] = $input;
			$data[0]['postback']['payload'] ='';
			$data[0]['sender']['id'] = '123654789';
			return $data;
		}

		public static function getAllData(){
			return json_decode(file_get_contents("php://input"), true, 512, JSON_BIGINT_AS_STRING);
		}
		
		public static function authentificationIsOk(){
			return (!empty($_REQUEST['hub_mode']) && $_REQUEST['hub_mode'] == 'subscribe' && $_REQUEST['hub_verify_token'] == self::APP_TOKEN);
		}
		
		public static function setup(){
			echo $_REQUEST['hub_challenge'];
		}
	}