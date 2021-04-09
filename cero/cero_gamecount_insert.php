<?php
require_once("../GameInsertUpdate.php");
require_once("../GameSelect.php");
require_once("../vendor/autoload.php");

$gameinsert = new GameInsert();
$link = $gameinsert->mysql_connect();

$gameselect = new GameSelect();
$relese_maker_list = $gameselect->release_maker_group_select($link);

$cero_list = $gameselect->release_maker_cero_gamecount_select($link, $relese_maker_list);
// echo count($relese_maker_list);
$gameinsert->relese_maker_cero_gamecount_list_insert($link, $cero_list);