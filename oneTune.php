<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	include '../../tuneSet.php';
	include 'recRelate.php';
	
	// now get the tune for the thing...
	$tune_id = 1209;
	$res = json_decode(getTuneInfo($tune_id), 1);
	var_dump($res);