<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// call the test_session file
	// include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';

	// include file for DB...
	include '../../appUI/inc/PDO_connect.php';

	// now call the variable from the form
	$label = html_entity_decode($_POST['label']);
	// $label = "Jigs";

	// call the function get_search
	// echo get_search("tunes", $label);

	function get_search($word, $searchTerm, $pageItem = 5, $pageNo = 1){
		// do nothing...

		// have the link of the search as a variable with the query at the end of it
		$url = "https://thesession.org/".$word."/search?q=".$searchTerm."&format=json&perpage=".$pageItem."&page=".$pageNo;

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

	// echo '<pre>'.get_search("tunes", "Jig").'</pre>';
	// echo '------------------------------------------<br>';
	$a = get_search("tunes", $label);
	$arr = json_decode($a, 1);

	// JSON index count
	$i = 1;

	// output the genre/type of tune
	// echo $arr["q"];

	// for this one, we need to add extra functionality
	// $arr["q"] is an index that we can use to SELECT a description according to the...
	// printed statement
	// then construct some JSON structure, and refer to it in the ajax after the callback of the function
	// bind -- the parameters
	$pullDesc = $db->prepare("SELECT 
							    description, ref
							FROM
							    definition_idx
							        INNER JOIN
							    genres ON definition_idx.genre_id = genres.id
							WHERE
							    genres.`name` = ?
							");

	// replace possible underscores
	$x = str_replace("_", " ", $arr["q"]);
	$pullDesc->bindParam(1, $x);

	// now to execute 
	$pullDesc->execute();

	// pull the results in desc format
	$resDesc = $pullDesc->fetchAll(pdo::FETCH_ASSOC);
	// $pullDesc->bindParam();
	// var_dump($resDesc);

	// now create an array that to encode into json and dump on the AJAX callback in inc_starter
	foreach($resDesc as $RD){
		// now...for the arrays for the index
		// $values[$i]['genre'] = str_replace("_", " ", $arr["q"]);
		$values['genre'] = $x;
		$values['description'] = $RD['description'];
		$values['ref'] = $RD['ref'];
	}

	// printing out the array (in PHP form) to convert it to JSON
	echo json_encode($values);

	// echo $a["q"];
	// $arr = json_decode($a, 1);
	// // $tunes = ($arr['tunes']);
	// // echo $arr['pages'];

	// $numPages = $arr['pages'];
	// $itemLimit = 5;

	// $str = '[';
	// // now create a loop
	// for($i = 1; $i <= $numPages; $i++){
	// 	if($i != 1){
	// 		$str .= ",";
	// 	}
	// 	$str.= get_search("tunes", $label, $itemLimit, $i);
	// }
	// $str.="]";

	// echo $str;