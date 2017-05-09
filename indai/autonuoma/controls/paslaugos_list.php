<?php

// sukuriame markių klasės objektą
include 'libraries/paslaugos.class.php';
$paslaugosObj = new paslaugos();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $paslaugosObj->getPaslaugosListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';

$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $paslaugosObj->getPaslaugosList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/paslaugos_list.tpl.php';