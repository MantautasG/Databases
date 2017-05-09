<?php

include 'libraries/miestas.class.php';
$miestasObj = new miestas();

if(!empty($id)) {
	// patikriname, ar šalinama markė nepriskirta modeliui
	$count = $miestasObj->getmiestaiCountOfImone($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// šaliname markę
		$miestasObj->deleteMiestas($id);
	} else {
		// nepašalinome, nes markė priskirta modeliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}

	// nukreipiame į markių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>