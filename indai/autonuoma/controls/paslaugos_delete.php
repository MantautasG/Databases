<?php

include 'libraries/paslaugos.class.php';
$paslaugosObj = new paslaugos();

if(!empty($id)) {
	// patikriname, ar šalinama markė nepriskirta modeliui
	$count = $paslaugosObj->getPaslaugosCountOfUzsakytos($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// šaliname markę
		$paslaugosObj->deletePaslaugos($id);
	} else {
		// nepašalinome, nes markė priskirta modeliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}

	// nukreipiame į markių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>