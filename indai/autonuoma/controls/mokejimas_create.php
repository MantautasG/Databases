<?php

include 'libraries/mokejimas.class.php';
$mokejimasObj= new mokejimas();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Data', 'Suma', 'fk_KlientasAsm_kodas', 'fk_SaskaitaNr');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Data' => 20,
	'Suma' => 20,
	'fk_KlientasAsm_kodas' => 20,
	'fk_SaskaitaNr' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Data' => 'date',
		'Suma' => 'alfanum',
		'fk_KlientasAsm_kodas' => 'positivenumber',
		'fk_SaskaitaNr' => 'positivenumber');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$mokejimasObj->insertMokejimas($dataPrepared);
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
include 'templates/mokejimas_form.tpl.php';

?>