<?php

require_once "./vendor/autoload.php";


class OBR{

	private $client;
	public $baseUrl = 'https://ebms.obr.gov.bi:9443/ebms_api/';

	public function __construct(){
		$token = $this->getToken();
		$this->client = new GuzzleHttp\Client([
			'headers' => [ 
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $token
			]
		]);
	}

	public function postData(string $url,array $value)
	{
		if(!$this->client){
			$this->client = new GuzzleHttp\Client([
				'headers' => [ 
					'Content-Type' => 'application/json',
					// 'Authorization' => 'Bearer ' . $token
				]
			]);

		}
		$response = $this->client->post($this->baseUrl. $url,[
			"body" => json_encode($value)]);
		return json_decode($response->getBody()->getContents()) ;
	}

	public function getToken(){
		$response =  $this->postData('login/',[
			'username' => 'ws400038277200404',
			'password' => '>1Q0Tn;a',
		]);

		return $response->result->token;
	}

	public function checkTin(string $tp_TIN){
		$tp_TIN = trim($tp_TIN);
		
		$response =  $this->postData('checkTIN/',[
			'tp_TIN' => $tp_TIN
		]);

		return $response;
	}
}



$obrClient =  new OBR();

print_r($obrClient->checkTin('4002060640'));