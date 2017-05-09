<?php

include 'libraries/imone.class.php';
$imoneObj= new imone();

if(!empty($id)) {
	// patikriname, ar šalinamas modelis nenaudojamas, t.y. nepriskirtas jokiam automobiliui
	$count = $imoneObj->getDarbuotojasCountOfImone($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// pašaliname modelį
            //    $darbuotojasObj->deleteSkundai($id);
		$imoneObj->deleteImone($id);
	} else {
		// nepašalinome, nes modelis priskirtas bent vienam automobiliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}
        
        
	// nukreipiame į modelių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}