<?php
require_once("../GameInsertUpdate.php");
require_once("../GameSelect.php");
require_once("../vendor/autoload.php");

$gameupdate = new GameInsertUpdate();
$link = $gameupdate->mysql_connect();

$gameselect = new GameSelect();
$relese_maker_list = $gameselect->release_maker_select($link);

$gameupdate->release_maker_update($link, $relese_maker_list);