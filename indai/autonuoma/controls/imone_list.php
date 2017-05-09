<?php

// sukuriame markių klasės objektą
include 'libraries/imone.class.php';
$imoneObj = new imone();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $imoneObj->getImoneListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';

$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio markes
$data = $imoneObj->getImoneList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/imone_list.tpl.php';