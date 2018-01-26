<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	include 'setsRelate.php';
	// want to see if I can scrape the data from the website instead of requesting it
	// I will attempt to use DOMdocument class in PHP

	// Create a stream
	// include_once('/Applications/MAMP/htdocs/SessionCURL/tools/simple_html_dom.php');

	// $html = file_get_html('http://www.google.com/');

	// // Find all images 
	// foreach($html->find('img') as $element) 
	//        echo $element->src . '<br>';

	// function curl_download($Url){
	//     if (!function_exists('curl_init')){
	//         die('cURL is not installed. Install and try again.');
	//     }

	//     $ch = curl_init();
	//     curl_setopt($ch, CURLOPT_URL, $Url);
	//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//     $output = curl_exec($ch);
	//     curl_close($ch);
	//     return $output;
	// }

	// print curl_download('http://www.gutenberg.org/browse/scores/top');

	// $html = file_get_contents('http://pokemondb.net/evolution'); //get the html returned from the following url
	// $pokemon_doc = new DOMDocument();
	// libxml_use_internal_errors(TRUE); //disable libxml errors

	// if(!empty($html)){ //if any html is actually returned

	// 	$pokemon_doc->loadHTML($html);
	// 	libxml_clear_errors(); //remove errors for yucky html
		
	// 	$pokemon_xpath = new DOMXPath($pokemon_doc);

	// 	//get all the h2's with an id
	// 	$pokemon_row = $pokemon_xpath->query('//h2[@id]');

	// 	if($pokemon_row->length > 0){
	// 		foreach($pokemon_row as $row){
	// 			echo $row->nodeValue . "<br/>";
	// 		}
	// 	}
	// }

	echo "-- RECORDINGS --<br>";

	// now i want to implement the same program for the same thing with a session link 
	// $sesh = file_get_contents('https://thesession.org/tunes/1209/recordings'); // get the html from the session site
	// $sesh_doc = new DOMDocument();
	// libxml_use_internal_errors(TRUE); //disable libxml errors

	// if(!empty($sesh)){
	// 	$sesh_doc->loadHTML($sesh);
	// 	libxml_clear_errors(); //remove errors for yucky html

	// 	$sesh_xpath = new DOMXPATH($sesh_doc);

	// 	//get all the a's with a class
	// 	$sesh_row = $sesh_xpath->query('//a[@class="manifest-item-title"]');
	// 	if($sesh_row->length > 0){
	// 		foreach($sesh_row as $row){
	// 			echo $row->nodeValue . " - ".$row->getAttribute('href')."<br/>";
	// 		}
	// 	}

	// }

	// successful, now a part of the algorithm would be:
		// 1. I select A tune or recording
		// 2. Gives the information on the number of related objects in regards to tunes and recordings
		// 3. use the algorithm above to find the related objects of information, call on the get_tunes function in loop for each
		// 4. will be apart of the page section that shows "related results" to any tune selected.
		// 5. On succession of this, then I'll be able to expand this to recordings also.

	// create a scenario that simulates the sequence of the data
		// I go to the tune search to get "Tommy's People"
		// then it brings me to the page that tells me how many recordings, tunebooks and tunesets it's in
		// then click on the recordings which provides you a list of tunes associated with "Tommy's People"
		// then look at the bottom list of tunes that are associated to said tune

	// now to simulate that, I will get the tune by its id then call on the file_get_contents
	// then it will bring you to the tunes/recordings, append the individual names and the links to arrays (maybe just ids)
	// then run the get_tunes functions on the array of ids, it should return the same list of names as the ones given on the website.

	// so we start with the $tune_id = 192 "Tommy's People"
	$id = 192;

	// then we call on the get_tunes
	// var_dump(setTuneRelate($id));

	// now have a function that looks at the recordings of the tunes
	function getRec($stringLink){

		// now assign the url
		$url = "https://thesession.org".$stringLink."?format=json";

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
			return $response;
		} 

	}

	// now it returns the json of the tune with the particular id 192
	// possibly create a function for this, future implementation for this would be to use a flag to toggle, more later...
	function relateTune($id){

		// retrieve the webpage with a particular name
		$url = file_get_contents('https://thesession.org/tunes/'.$id.'/recordings');
		$url_doc = new DOMDocument();
		libxml_use_internal_errors(TRUE); // disable libXML errors
		$storage = array(); // to storage the hrefs with ids on them to be called later

		// test if $url is empty or not
		if(!empty($url)){
			// return TRUE; // successful!

			// next step is to get the doc and filter out the particular ones
			$url_doc->loadHTML($url);
			libxml_clear_errors(); // checking for improper HTML

			// create a path tree for the page
			$url_xpath = new DOMXPATH($url_doc);
			// get every row of the list of the query for related tune links
			$url_row = $url_xpath->query('//a[@class="manifest-item-title"]');

			// -- this is where the problem now lies --
			if($url_row->length > 0){
				foreach($url_row as $row){
					$storage[] = $row->getAttribute('href');
				}
			}

			// var_dump($url_row);

			// check the array
			return (json_encode($storage));

		}

		// else it will not be true in that statement
		// return FALSE;
	}

	// echo '-- check $url isn\'t empty --<br>';
	// var_dump(json_decode((relateTune($id))));

	// variable that holds the array of the links to the related tunes
	$array = json_decode((relateTune($id)));

	// so now we can get the string value of the link of related tunes
	// then use the ids on them to get the designated tunes
	// then loop through it and get the tune info of each "recording for now"

	foreach($array as $a){
		// call the custom function about to be made
		echo getRec($a);
	}



