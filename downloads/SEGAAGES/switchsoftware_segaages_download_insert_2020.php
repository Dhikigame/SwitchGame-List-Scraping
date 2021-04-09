<?php

require_once("../../phpQuery/phpQuery-onefile.php");
require_once("../../GameInsertUpdate.php");

$url = "https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%83%80%E3%82%A6%E3%83%B3%E3%83%AD%E3%83%BC%E3%83%89%E3%82%BD%E3%83%95%E3%83%88%E3%81%AE%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7";
$options = stream_context_create(array('ssl' => array(
    'verify_peer'      => false,
    'verify_peer_name' => false
  )));
$html = file_get_contents($url, false, $options);
$doc = phpQuery::newDocument($html);

$gameinsertupdate = new GameInsertUpdate();
$link = $gameinsertupdate->mysql_connect();


$remove_i_count = 0;
$no_software_count = 0;
// 日付取得
echo "【日付】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  $month = substr($doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text(), 0, 2);
  $day = substr($doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text(), 5, 7);
  $day = substr($day, 0, 2);
  $db_store['release_date'][$count] = "2019/" . $month . "/" . $day;

  echo ++$count . " ";
  echo $i . " ";
  echo $no_software_count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text() . "\n";
}
// var_dump($remove_i);

// タイトル
echo "【タイトル】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  $db_store['title'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(1)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(1)']->text() . "\n";
}

// 販売メーカー
echo "【販売メーカー】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  $db_store['release_maker'][$count] = "セガ";

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(2)']->text() . "\n";
}

// オンライン対応
echo "【オンライン対応】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  $db_store['online'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(3)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(3)']->text() . "\n";
}

// ランキング対応
echo "【ランキング対応】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  $db_store['ranking'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(4)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(4)']->text() . "\n";
}

// CERO
echo "【CERO】\n";
$count = 0;
for($i = 2287; $i <= 2291; $i++) {

  if(strpos($doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text(), "教") !== false || strpos($doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text(), "+") !== false || strpos($doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text(), "審査") !== false) {
    $db_store['cero'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text();
  } else {
    $db_store['cero'][$count] = substr($doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text(), 0, 1);
  }

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text() . "\n";
}
var_dump($db_store);

$gameinsertupdate->soft_regist($link, $db_store, 2);