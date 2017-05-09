<?php

include 'libraries/darbuotojas.class.php';
$darbuotojasObj = new darbuotojas();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('Vardas', 'Pavarde', 'El_pastas', 'Pareigos', 'Idarbinimo_data', 'fk_ImoneImones_id', 'skundai');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'Vardas' => 20
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'Vardas' => 'words',
		'Pavarde' => 'words',
		'El_pastas' => 'email',
		'Pareigos' => 'words',
        'Idarbinimo_data'=>'date',
        'fk_ImoneImones_id'=>'positivenumber',
        'skundai' => 'anything'
		);

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname duomenis
		$darbuotojasObj->updateDarbuotojas($dataPrepared);
		$darbuotojasObj->deleteSkundai($dataPrepared['Tab_nr']);
        $darbuotojasObj->updateSkundai($dataPrepared);

		header("Location: index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
                $Tab_nr=$data['Tab_nr'];
		if(isset($_POST['skundai']) && sizeof($_POST['skundai']) > 0) {
			$i = 0;
			foreach($_POST['skundai'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['skundas'] = $val;
				$i++;
			}
		}
	}
} else {
	// tikriname, ar nurodytas elemento id. Jeigu taip, išrenkame elemento duomenis ir jais užpildome formos laukus.
	if(!empty($id)) {
		$data = $darbuotojasObj->getDarbuotojas($id);
                $data['paslaugos_kainos'] = $darbuotojasObj->getSkundai($id);
                $Tab_nr=$data['Tab_nr'];
		/*$tmp = $servicesObj->getServicePrices($id);
		if(sizeof($tmp) > 0) {
			foreach($tmp as $key => $val) {
				// jeigu paslaugos kaina yra naudojama, jos koreguoti neleidziame ir įvedimo laukelį padarome neaktyvų
				$priceCount = $contractsObj->getPricesCountOfOrderedServices($id, $val['galioja_nuo']);
				if($priceCount > 0) {
					$val['neaktyvus'] = 1;
				}
				$data['paslaugos_kainos'][] = $val;
			}
		}*/
	}
}

// įtraukiame šabloną
include 'templates/darbuotojas_form.tpl.php';

?>