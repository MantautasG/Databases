<?php

include 'libraries/darbuotojas.class.php';
$darbuotojasObj= new darbuotojas();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Vardas', 'Pavarde', 'El_pastas', 'Pareigos', 'Idarbinimo_data', 'fk_ImoneImones_id', 'skundai');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Vardas' => 20,
	'Pavarde' => 20,
	'El_pastas' => 20,
	'Pareigos' => 20,
	'Idarbinimo_data' => 20,
	'fk_ImoneImones_id' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Vardas' => 'alfanum',
		'Pavarde' => 'alfanum',
		'El_pastas' => 'email',
		'Pareigos' => 'alfanum',
		'Idarbinimo_data' => 'date',
		'fk_ImoneImones_id' => 'positivenumber',
		'skundai' => 'anything');

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// įrašome naują įrašą
		$darbuotojasObj->insertDarbuotojas($dataPrepared);
		$darbuotojasObj->insertSkundai($dataPrepared);

		// nukreipiame į markių puslapį
		//header("Location: index.php?module={$module}&action=list");
		//die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
                if(isset($_POST['skundai']) && sizeof($_POST['skundai']) > 0) {
			$i = 0;
			foreach($_POST['skundai'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['skundas'] = $val;
				$i++;
			}
		}
	}
}
include 'templates/darbuotojas_form.tpl.php';