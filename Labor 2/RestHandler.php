<?php
require_once("SimpleRest.php");
require_once("Mobile.php");
require_once("Movie.php");
require_once("DatabaseConnection.php");
		
class RestHandler extends SimpleRest {

	/**
	 * Liefert als Antwort alle in der Datenbank enthaltenen Filme.
	 * Hierbei werden allerdings nur die film_id und der title geliefert.
	 */
	function getAllMovies(){
		$rawData = getAllMoviesFromDatabase();
		$this->replyData($rawData);
	}

	/**
	 * Liefert als Antwort die Informationen zu dem Film mit der
	 * gegebenen id. Diese Informationen sind die film_id, title,
	 * description, release_year und length.
	 */
	function getMovie($id){
		$rawData = getMovieFromDatabase($id);
		$this->replyData($rawData);
	}

	function getAllMobiles() {	

		$mobile = new Mobile();
		$rawData = $mobile->getAllMobile();

		$this->replyData($rawData);
	}
	
	public function getMobile($id) {

		$mobile = new Mobile();
		$rawData = $mobile->getMobile($id);

		$this->replyData($rawData);
	}

	private function replyData($data) {
		if(empty($data)) {
			$statusCode = 404;
			$data = array('error' => 'No data found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($data);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($data);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($data);
			echo $response;
		}
	}

	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {

		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

}