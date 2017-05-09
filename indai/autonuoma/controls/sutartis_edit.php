<?php

include 'libraries/sutartis.class.php';
$sutartisObj= new sutartis();

include 'libraries/indas.class.php';
$indasObj= new indas();

$formErrors = null;
$data = array();

$dateArray=getdate();
$dateNow=$dateArray['year']."-".$dateArray['mon']."-".$dateArray['mday'];

$itemId="";
// nustatome privalomus laukus
$required = array('Isnuomavimo_data', 'Planuojamas_grazinimas', 'Kaina', 'Busena', 'Pradine_bukle', 'Galutine_bukle', 'fk_DarbuotojasTab_nr', 'fk_KlientasAsm_kodas');

// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
	include 'utils/validator.class.php';

	// nustatome laukų validatorių tipus
	$validations = array (
		'Isnuomavimo_data' => 'date',
		'Planuojamas_grazinimas' => 'date',
		'Kaina' => 'anything',
		'Busena' => 'anything',
		'Pradine_bukle' => 'anything',
                'Galutine_bukle' => 'anything',
                'fk_DarbuotojasTab_nr' => 'positivenumber',
                'fk_KlientasAsm_kodas' => 'positivenumber');

	// sukuriame laukų validatoriaus objektą
	$validator = new validator($validations, $required);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname sutartį
		$sutartisObj->updateSutartis($dataPrepared);

		// atnaujiname užsakytas paslaugas
                $sutartisObj->updateTarpininkas($dataPrepared);
		//$contractsObj->updateOrderedServices($dataPrepared);

		// nukreipiame vartotoją į sutarčių puslapį
		if($formErrors == null) {
			//header("Location: index.php?module={$module}&action=list");
			//die();
		}
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();

		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
                
		if(isset($_POST['kiekiai']) && sizeof($_POST['kiekiai']) > 0) {
			$i = 0;
			foreach($_POST['kiekiai'] as $key => $val) {
                                
				$data['Items'][$i]['Count'] = $val;
				$i++;
			}
		}
                if(isset($_POST['paslaugos']) && sizeof($_POST['paslaugos']) > 0) {
			$i = 0;
			foreach($_POST['paslaugos'] as $key => $val) {
                                
				$data['Items'][$i]['fk_ItemId'] = $val; // gal keisti į fk_IndoIndas_id
				$i++;
			}
		}
                
	}
} else {
	//  išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $sutartisObj->getSutartis($id);
	$data['Items'] = $sutartisObj->getTarpininkas($id);
        $Nr=$data['Nr'];
}

// nustatome požymį, kad įrašas redaguojamas norint išjungti ID redagavimą šablone

// įtraukiame šabloną
include 'templates/sutartis_form.tpl.php';

