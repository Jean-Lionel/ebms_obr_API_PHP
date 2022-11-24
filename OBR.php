<?php

require_once "./vendor/autoload.php";


class OBR{

	private $client;
	public $baseUrl = 'https://ebms.obr.gov.bi:9443/ebms_api/';

	public function __construct(){
		$this->client = new GuzzleHttp\Client([
			'headers' => [ 'Content-Type' => 'application/json' ]
		]);
	}

	public function postData($url, $value)
	{
		$response = $this->client->post($this->baseUrl. $url,[
				"body" => json_encode($value)]);
		return $response;
	}

	public function getToken(){
		$response =  $this->postData('login/',[
			'username' => 'ws400038277200404',
			'password' => '>1Q0Tn;a',
		]);

		return $response->getBody()->getContents();
	}
}



$obrClient =  new OBR();

print_r($obrClient->getToken());