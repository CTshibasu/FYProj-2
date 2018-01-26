<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// create function that gets the popular tunes
	// need no parameters, since it's the only instance of itself
	function get_popular($pageNo = 1){

		// get the URL
		$url = "https://thesession.org/tunes/popular?format=json&page=".$pageNo;

		// put in the  curl function
		$ch = curl_init($url);

		// create an array for the data to be pulled into
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// save response to variable
		$response = curl_exec($ch);

		if(empty($response)) {
			$error = curl_error($ch);
	        //$error now contains the error thrown when curl_exec failed to execute
	        echo $error;
		} else {

			//prints out the JSON for the new tunes for the session API
			$res = $response;

			// return JSON object;
			return $res;
		} 
	}

	// echo '<pre>'.get_popular().'</pre>';

	// the intention of the page is to incorporate the results on the "popular tunes" with some custom...
	// stat card features, each page having 10 items per page

	$resPop = json_decode(get_popular(), 1);
	var_dump($resPop["tunes"]);
