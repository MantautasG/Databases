<?php

// sukuriame markių klasės objektą
include 'libraries/mokejimas.class.php';
$mokejimasObj = new mokejimas();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $mokejimasObj->getMokejimasListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';

$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $mokejimasObj->getMokejimasList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/mokejimas_list.tpl.php';