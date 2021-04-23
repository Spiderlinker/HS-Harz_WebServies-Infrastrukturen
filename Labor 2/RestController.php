<?php
require_once("RestHandler.php");

checkViewParameter();
checkMovieParameter();

function checkViewParameter(){
	$view = "";
	if(isset($_GET["view"]))
		$view = $_GET["view"];
	
	/* controls the RESTful services URL mapping */
	switch($view){
	
		case "all":
			// to handle REST Url /mobile/list/
			$mobileRestHandler = new RestHandler();
			$mobileRestHandler->getAllMobiles();
			break;
			
		case "single":
			// to handle REST Url /mobile/show/<id>/
			$mobileRestHandler = new RestHandler();
			$mobileRestHandler->getMobile($_GET["id"]);
			break;
	
		case "" :
			//404 - not found;
			break;
	}
}

function checkMovieParameter() {
	$movies = "";
	if(isset($_GET["movies"]))
		$movies = $_GET["movies"];

		/* controls the RESTful services URL mapping */
	switch($movies){

		case "all": // alternativ: list
			// to handle REST Url /mobile/list/
			$mobileRestHandler = new RestHandler();
			$mobileRestHandler->getAllMovies();
			break;
			
		case "single": // alternativ: show
			// to handle REST Url /mobile/show/<id>/
			$mobileRestHandler = new RestHandler();
			$mobileRestHandler->getMovie($_GET["id"]);
			break;

		case "" :
			//404 - not found;
			break;
	}
}



