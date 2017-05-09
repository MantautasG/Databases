<?php

// sukuriame markių klasės objektą
include 'libraries/miestas.class.php';
$miestasObj = new miestas();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $miestasObj->getMiestasListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';

$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $miestasObj->getMiestasList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/miestas_list.tpl.php';