<?php
function release_maker_gamecount($link) {

    $today = date("Y-m-d");
    /* CERO全て */
    echo "---------------CERO ALL---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_all'][$count][0] = $row[0];
        $select_cero_gamecount['cero_all'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_all'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_all'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------CERO ALL type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_all'][$count][0] = $row[0];
        $select_cero_gamecount['type1_all'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_all'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_all'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------CERO ALL type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_all'][$count][0] = $row[0];
        $select_cero_gamecount['type2_all'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_all'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_all'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------CERO ALL type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_all'][$count][0] = $row[0];
        $select_cero_gamecount['type3_all'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_all'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_all'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------CERO ALL download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_all'][$count][0] = $row[0];
        $select_cero_gamecount['download_all'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_all'][$count][0] . " ";
        // echo $select_cero_gamecount['download_all'][$count][1] . "<br>";
        $count++;
    }

    /* cero_A_3 */
    echo "---------------cero_A_3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND (cero = 'A' OR cero = '3+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_A_3'][$count][0] = $row[0];
        $select_cero_gamecount['cero_A_3'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_A_3'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_A_3'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_A_3 type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND (cero = 'A' OR cero = '3+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_A_3'][$count][0] = $row[0];
        $select_cero_gamecount['type1_A_3'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_A_3'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_A_3'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_A_3 type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND (cero = 'A' OR cero = '3+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_A_3'][$count][0] = $row[0];
        $select_cero_gamecount['type2_A_3'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_A_3'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_A_3'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_A_3 type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND (cero = 'A' OR cero = '3+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_A_3'][$count][0] = $row[0];
        $select_cero_gamecount['type3_A_3'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_A_3'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_A_3'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_A_3 download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND (cero = 'A' OR cero = '3+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_A_3'][$count][0] = $row[0];
        $select_cero_gamecount['download_A_3'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_A_3'][$count][0] . " ";
        // echo $select_cero_gamecount['download_A_3'][$count][1] . "<br>";
        $count++;
    }

    /* cero_7 */
    echo "---------------cero_7---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND cero = '7+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_7'][$count][0] = $row[0];
        $select_cero_gamecount['cero_7'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_7'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_7'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_7 type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND cero = '7+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_7'][$count][0] = $row[0];
        $select_cero_gamecount['type1_7'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_7'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_7'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_7 type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND cero = '7+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_7'][$count][0] = $row[0];
        $select_cero_gamecount['type2_7'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_7'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_7'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_7 type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND cero = '7+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_7'][$count][0] = $row[0];
        $select_cero_gamecount['type3_7'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_7'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_7'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_7 download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND cero = '7+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_7'][$count][0] = $row[0];
        $select_cero_gamecount['download_7'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_7'][$count][0] . " ";
        // echo $select_cero_gamecount['download_7'][$count][1] . "<br>";
        $count++;
    }

    /* cero_B_12 */
    echo "---------------cero_B_12---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND (cero = 'B' OR cero = '12+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_B_12'][$count][0] = $row[0];
        $select_cero_gamecount['cero_B_12'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_B_12'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_B_12'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_B_12 type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND (cero = 'B' OR cero = '12+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_B_12'][$count][0] = $row[0];
        $select_cero_gamecount['type1_B_12'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_B_12'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_B_12'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_B_12 type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND (cero = 'B' OR cero = '12+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_B_12'][$count][0] = $row[0];
        $select_cero_gamecount['type2_B_12'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_B_12'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_B_12'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_B_12 type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND (cero = 'B' OR cero = '12+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_B_12'][$count][0] = $row[0];
        $select_cero_gamecount['type3_B_12'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_B_12'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_B_12'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_B_12 download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND (cero = 'B' OR cero = '12+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_B_12'][$count][0] = $row[0];
        $select_cero_gamecount['download_B_12'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_B_12'][$count][0] . " ";
        // echo $select_cero_gamecount['download_B_12'][$count][1] . "<br>";
        $count++;
    }

    /* cero_C */
    echo "---------------cero_C---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND cero = 'C' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_C'][$count][0] = $row[0];
        $select_cero_gamecount['cero_C'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_C'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_C'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_C type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND cero = 'C' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_C'][$count][0] = $row[0];
        $select_cero_gamecount['type1_C'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_C'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_C'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_C type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND cero = 'C' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_C'][$count][0] = $row[0];
        $select_cero_gamecount['type2_C'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_C'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_C'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_C type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND cero = 'C' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_C'][$count][0] = $row[0];
        $select_cero_gamecount['type3_C'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_C'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_C'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_C download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND cero = 'C' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_C'][$count][0] = $row[0];
        $select_cero_gamecount['download_C'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_C'][$count][0] . " ";
        // echo $select_cero_gamecount['download_C'][$count][1] . "<br>";
        $count++;
    }

    /* cero_16 */
    echo "---------------cero_16---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND cero = '16+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_16'][$count][0] = $row[0];
        $select_cero_gamecount['cero_16'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_16'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_16'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_16 type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND cero = '16+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_16'][$count][0] = $row[0];
        $select_cero_gamecount['type1_16'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_16'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_16'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_16 type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND cero = '16+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_16'][$count][0] = $row[0];
        $select_cero_gamecount['type2_16'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_16'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_16'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_16 type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND cero = '16+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_16'][$count][0] = $row[0];
        $select_cero_gamecount['type3_16'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_16'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_16'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_16 download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND cero = '16+' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_16'][$count][0] = $row[0];
        $select_cero_gamecount['download_16'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_16'][$count][0] . " ";
        // echo $select_cero_gamecount['download_16'][$count][1] . "<br>";
        $count++;
    }

    /* cero_D */
    echo "---------------cero_D---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND cero = 'D' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_D'][$count][0] = $row[0];
        $select_cero_gamecount['cero_D'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_D'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_D'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_D type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND cero = 'D' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_D'][$count][0] = $row[0];
        $select_cero_gamecount['type1_D'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_D'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_D'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_D type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND cero = 'D' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_D'][$count][0] = $row[0];
        $select_cero_gamecount['type2_D'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_D'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_D'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_D type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND cero = 'D' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_D'][$count][0] = $row[0];
        $select_cero_gamecount['type3_D'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_D'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_D'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_D download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND cero = 'D' group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_D'][$count][0] = $row[0];
        $select_cero_gamecount['download_D'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_D'][$count][0] . " ";
        // echo $select_cero_gamecount['download_D'][$count][1] . "<br>";
        $count++;
    }

    /* cero_Z */
    echo "---------------cero_Z---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND (cero = 'Z' OR cero = '18+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['cero_Z'][$count][0] = $row[0];
        $select_cero_gamecount['cero_Z'][$count][1] = $row[1];
        // echo $select_cero_gamecount['cero_Z'][$count][0] . " ";
        // echo $select_cero_gamecount['cero_Z'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_Z type=1---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 1 AND (cero = 'Z' OR cero = '18+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type1_Z'][$count][0] = $row[0];
        $select_cero_gamecount['type1_Z'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type1_Z'][$count][0] . " ";
        // echo $select_cero_gamecount['type1_Z'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_Z type=2---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 2 AND (cero = 'Z' OR cero = '18+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type2_Z'][$count][0] = $row[0];
        $select_cero_gamecount['type2_Z'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type2_Z'][$count][0] . " ";
        // echo $select_cero_gamecount['type2_Z'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_Z type=3---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND type = 3 AND (cero = 'Z' OR cero = '18+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['type3_Z'][$count][0] = $row[0];
        $select_cero_gamecount['type3_Z'][$count][1] = $row[1];
        // echo $select_cero_gamecount['type3_Z'][$count][0] . " ";
        // echo $select_cero_gamecount['type3_Z'][$count][1] . "<br>";
        $count++;
    }
    echo "---------------cero_Z download---------------<br>";
    $select_sql = "select count(title), release_maker from switch_software_data where release_date <= '" . $today . "' AND download = 1 AND (cero = 'Z' OR cero = '18+') group by release_maker";
    $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
    $count = 0;
    while($row = mysqli_fetch_array($select)) {
        $select_cero_gamecount['download_Z'][$count][0] = $row[0];
        $select_cero_gamecount['download_Z'][$count][1] = $row[1];
        // echo $select_cero_gamecount['download_Z'][$count][0] . " ";
        // echo $select_cero_gamecount['download_Z'][$count][1] . "<br>";
        $count++;
    }

    return $select_cero_gamecount;
}