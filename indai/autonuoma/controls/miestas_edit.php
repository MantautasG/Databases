<?php

include 'libraries/miestas.class.php';
$miestasObj = new miestas();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Pavadinimas', 'Rajonas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Pavadinimas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Pavadinimas' => 'anything',
		'Rajonas' => 'anything');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$miestasObj->updateMiestas($dataPrepared);

		// nukreipiame į markių puslapį
		//header("Location: index.php?module={$module}&action=list");
		//die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
	}
} else {
	// išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $miestasObj->getMiestas($id);
}

// įtraukiame šabloną
include 'templates/miestas_form.tpl.php';

?>