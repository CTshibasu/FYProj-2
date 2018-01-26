<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	include '/Applications/MAMP/htdocs/SessionCURL/appUI/funBlocks/test_session.php';

	// firstly, tune activity:
  	$tuneAct = act_streams("tunes");

  	// test output and create code accordingly
  	// echo '<pre>'.$tuneAct.'</pre>';

  	// then try to redo the structure of the array
  	$ta = json_decode($tuneAct, 1);

  	var_dump($ta);

  	// now give the no. of items
  	// var_dump(count($ta["items"])); 

  	// goes through loop, then...
  	// the condition bit has been used so it can be easily scalable
  	// for($i = 0; $i < count($ta["items"]); $i++){
  	// 	// now print out...
  	// 	echo ($i+1).". ".$ta["items"][$i]["title"].'<br>';

  	// }


