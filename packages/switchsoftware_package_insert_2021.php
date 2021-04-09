<?php

require_once("../phpQuery/phpQuery-onefile.php");
require_once("../GameInsertUpdate.php");

$url = "https://ja.wikipedia.org/wiki/Nintendo_Switch%E3%81%AE%E3%82%B2%E3%83%BC%E3%83%A0%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%B8%80%E8%A6%A7";
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
for($i = 632; $i <= 1100; $i++) {
  // 発売予定がなくなった場合
  if(strpos($doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text(), '月') === false) {
    $no_software_count++;
    echo $no_software_count . " ";
    continue;
  }

  $month = substr($doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text(), 0, 2);
  $day = substr($doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text(), 5, 7);
  $day = substr($day, 0, 2);
  $db_store['release_date'][$count] = "2021/" . $month . "/" . $day;

  echo ++$count . " ";
  echo $i . " ";
  echo $no_software_count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(0)']->text() . "\n";
}
// var_dump($remove_i);

// タイトル
echo "【タイトル】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['title'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(1)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(1)']->text() . "\n";
}

// 販売メーカー
echo "【販売メーカー】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['release_maker'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(2)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(2)']->text() . "\n";
}

// オンライン対応
echo "【オンライン対応】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['online'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(3)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(3)']->text() . "\n";
}

// ランキング対応
echo "【ランキング対応】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['ranking'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(4)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(4)']->text() . "\n";
}

// JoyCon横持ち対応
echo "【JoyCon横持ち対応】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['joycon_sideways'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(5)']->text() . "\n";
}

// ダウンロード版対応
echo "【ダウンロード版対応】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  $db_store['download'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(6)']->text();

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(6)']->text() . "\n";
}

// CERO
echo "【CERO】\n";
$count = 0;
for($i = 632; $i <= 1100 - $no_software_count; $i++) {

  if(strpos($doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text(), "教") !== false || strpos($doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text(), "+") !== false || strpos($doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text(), "審査") !== false) {
    $db_store['cero'][$count] = $doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text();
  } else {
    $db_store['cero'][$count] = substr($doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text(), 0, 1);
  }

  echo ++$count . " ";
  echo $doc['table tbody tr:eq(' . $i . ') td:eq(7)']->text() . "\n";
}
var_dump($db_store);

$gameinsertupdate->soft_regist($link, $db_store, 1);