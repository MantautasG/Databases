<?php
// sukuriame modelių klasės objektą
include 'libraries/sutartis.class.php';
$sutartisObj = new sutartis();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $sutartisObj->getSutartisListCount();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio modelius
$data = $sutartisObj->getSutartisList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/sutartis_list.tpl.php';
