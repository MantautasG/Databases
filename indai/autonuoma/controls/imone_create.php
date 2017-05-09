<?php

include 'libraries/imone.class.php';
$imoneObj= new imone();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Pavadinimas', 'Adresas', 'El_pastas', 'Telefono_nr', 'Faksas', 'Valstybe', 'fk_MiestasMiesto_id');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Pavadinimas' => 25
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Pavadinimas' => 'words',
		'Adresas' => 'anything',
		'El_pastas' => 'email',
		'Telefono_nr' => 'anything',
        'Faksas'=>'anything',
        'Valstybe'=>'anything',
        'fk_MiestasMiesto_id' => 'positivenumber'
		);

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$imoneObj->insertImone($dataPrepared);
		//$darbuotojasObj->insertSkundai($dataPrepared);

		// nukreipiame į markių puslapį
		//header("Location: index.php?module={$module}&action=list");
		//die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
}

// įtraukiame šabloną
include 'templates/imone_form.tpl.php';

?>