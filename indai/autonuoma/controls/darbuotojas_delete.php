<?php

include 'libraries/darbuotojas.class.php';
$darbuotojasObj= new darbuotojas();

if(!empty($id)) {
	// patikriname, ar šalinamas modelis nenaudojamas, t.y. nepriskirtas jokiam automobiliui
	$count = $darbuotojasObj->getSutartisCountOfDarbuotojas($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// pašaliname modelį
                $darbuotojasObj->deleteSkundai($id);
		$darbuotojasObj->deleteDarbuotojas($id);
	} else {
		// nepašalinome, nes modelis priskirtas bent vienam automobiliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}
        
        
	// nukreipiame į modelių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}