<?php

include 'libraries/sutartis.class.php';
$sutartisObj= new sutartis();

if(!empty($id)) {
	// patikriname, ar šalinamas modelis nenaudojamas, t.y. nepriskirtas jokiam automobiliui
	$count = $sutartisObj->getPaslaugosCountOfSutartis($id);

	$removeErrorParameter = '';
	if($count == 0) {
		// pašaliname modelį
                //$sutartisObj->deleteSkundai($id);
		$sutartisObj->deleteSutartis($id);
	} else {
		// nepašalinome, nes modelis priskirtas bent vienam automobiliui, rodome klaidos pranešimą
		$removeErrorParameter = '&remove_error=1';
	}
        
        
	// nukreipiame į modelių puslapį
	header("Location: index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}