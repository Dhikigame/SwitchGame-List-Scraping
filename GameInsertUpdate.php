<?php
class GameInsertUpdate {

    /* Mysqlに接続 */
    public function mysql_connect() {

        /* Mysql接続 */
        $IPADDR = isset($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:gethostbyname(gethostname());

        require_once("../info/db_info.php");
        require_once("../info/ipaddress_info.php");    
        $search_ipaddress = new IPAddress();
        $search_dbinfo = new DB();

        if($IPADDR == $search_ipaddress->server_ipaddress()) { 
            $link = mysqli_connect($search_dbinfo->server_ipaddress_db(), $search_dbinfo->server_db("user"), $search_dbinfo->server_db("password")); //DBサーバ自身に接続
        } else {
            $link = mysqli_connect($search_dbinfo->local_ipaddress_db(), $search_dbinfo->local_db("user"), $search_dbinfo->local_db("password")); //DBサーバ自身に接続
        }

        /* DB選択 */
        $db_selected = mysqli_select_db($link, $search_dbinfo->select_db());
        if (!$db_selected){
            die("エラー：50009");
        }

        return $link;
    }

    /* 最新動画をDBに更新する */
    public function soft_regist($link, $db_store, $softtype=1, $release_maker="ハムスター") {

        // ソフトのタイプがパッケージ版である場合
        if($softtype == 1) {

            echo count($db_store['release_date']) . "\n";

            for($count = 0; $count <= count($db_store['release_date']) - 1; $count++) {

                $regist_sql = $this->sql_insert_update_create($db_store['title'][$count], $link);
                echo $regist_sql . "\n";
                if($regist_sql === "no_regist") {
                    continue;
                }

                $onlinetype_num = $this->online_check($db_store['online'][$count]);
                $rankingtype_num = $this->ranking_check($db_store['ranking'][$count]);
                $joycon_sideways_num = $this->joycon_sideways_check($db_store['joycon_sideways'][$count]);
                $download_num = $this->download_check($db_store['download'][$count]);

                $regist_sql .= $this->sql_regist_create($db_store, $softtype ,$onlinetype_num, $rankingtype_num, $joycon_sideways_num, $download_num, $count, $regist_sql);
                echo $regist_sql . "\n";

                echo $db_store['release_date'][$count] . " " . $softtype . " " . $db_store['title'][$count] . " " . $db_store['release_maker'][$count] . " " . $onlinetype_num . " " . $rankingtype_num . " " . $joycon_sideways_num . " " . $download_num . " " . $db_store['cero'][$count] . "\n";
                
                $regist = mysqli_query($link, $regist_sql);
                echo "\n";
            }
        }

        // ソフトのタイプがダウンロード専用、SEGA AGESである場合
        if($softtype == 2) {

            echo count($db_store['release_date']) . "\n";

            for($count = 0; $count <= count($db_store['release_date']) - 1; $count++) {

                $regist_sql = $this->sql_insert_update_create2($db_store['title'][$count], $link);
                echo $regist_sql . "\n";
                if($regist_sql === "no_regist") {
                    continue;
                }

                $onlinetype_num = $this->online_check($db_store['online'][$count]);
                $rankingtype_num = $this->ranking_check($db_store['ranking'][$count]);

                $regist_sql .= $this->sql_regist_create2($db_store, $softtype ,$onlinetype_num, $rankingtype_num, 1, $count, $regist_sql);
                echo $regist_sql . "\n";

                echo $db_store['release_date'][$count] . " " . $softtype . " " . $db_store['title'][$count] . " " . $db_store['release_maker'][$count] . " " . $onlinetype_num . " " . $rankingtype_num . " 1 " . $db_store['cero'][$count] . "\n";
                
                $regist = mysqli_query($link, $regist_sql);
                echo "\n";
            }
        }

        // ソフトのタイプがアーケードアーカイブス、アケアカNEOGEOである場合
        if($softtype == 3) {

            echo count($db_store['release_date']) . "\n";

            for($count = 0; $count <= count($db_store['release_date']) - 1; $count++) {

                $regist_sql = $this->sql_insert_update_create3($db_store['title'][$count], $link);
                echo $regist_sql . "\n";
                if($regist_sql === "no_regist") {
                    continue;
                }

                $regist_sql .= $this->sql_regist_create3($db_store, $softtype , 1, $count, $regist_sql, $release_maker);
                echo $regist_sql . "\n";

                echo $db_store['release_date'][$count] . " " . $softtype . " " . $db_store['title'][$count] . " " . $release_maker . " 1 " . $db_store['cero'][$count] . "\n";
                
                $regist = mysqli_query($link, $regist_sql);
                echo "\n";
            }
        }
        $link = null;
    }

    private function sql_insert_update_create($title, $link) {

        if(strpos($title, '"') !== false) {
            $select_sql = "select title from switch_software_data where title = '" . $title . "' limit 1";
        } else {
            $select_sql = 'select title from switch_software_data where title = "' . $title . '" limit 1';
        }
        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        $row = mysqli_fetch_array($select);
        print($row[0]);

        if($row[0] !== null) {
            $regist_sql = 'no_regist';
        } else {
            $regist_sql = 'insert into switch_software_data(release_date, type, title, release_maker, online, ranking, joycon_sideways, download, cero) values(';
        }
        
        return $regist_sql;
    }

    private function sql_insert_update_create2($title, $link) {

        if(strpos($title, '"') !== false) {
            $select_sql = "select title from switch_software_data where title = '" . $title . "' limit 1";
        } else {
            $select_sql = 'select title from switch_software_data where title = "' . $title . '" limit 1';
        }
        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        $row = mysqli_fetch_array($select);
        print($row[0]);

        if($row[0] !== null) {
            $regist_sql = 'no_regist';
        } else {
            $regist_sql = 'insert into switch_software_data(release_date, type, title, release_maker, online, ranking, download, cero) values(';
        }
        
        return $regist_sql;
    }

    private function sql_insert_update_create3($title, $link) {

        if(strpos($title, '"') !== false) {
            $select_sql = "select title from switch_software_data where title = '" . $title . "' limit 1";
        } else {
            $select_sql = 'select title from switch_software_data where title = "' . $title . '" limit 1';
        }
        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        $row = mysqli_fetch_array($select);
        print($row[0]);

        if($row[0] !== null) {
            $regist_sql = 'no_regist';
        } else {
            $regist_sql = 'insert into switch_software_data(release_date, type, title, release_maker, download, cero) values(';
        }
        
        return $regist_sql;
    }


    private function sql_regist_create($db_store, $softtype=1 ,$onlinetype_num, $rankingtype_num, $joycon_sideways_num, $download_num, $count=0, $regist_sql) {

        if(strpos($regist_sql, "update") !== false) {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = 'release_date="' . $db_store['release_date'][$count] . '", type=' . $softtype . ', title="' . $db_store['title'][$count] . '", release_maker="' . $db_store['release_maker'][$count] . '", online=' . $onlinetype_num . ', ranking=' 
                . $rankingtype_num . ', joycon_sideways=' . $joycon_sideways_num . ', download=' . $download_num . ', cero="' . $db_store['cero'][$count] . '" where title LIKE "%' . $db_store['title'][$count] . '%"';
            } else {
                $regist_sql = "release_date='" . $db_store['release_date'][$count] . "', type=" . $softtype . ", title='" . $db_store['title'][$count] . "', release_maker='" . $db_store['release_maker'][$count] . "', online=" . $onlinetype_num . ", ranking="
                . $rankingtype_num . ", joycon_sideways=" . $joycon_sideways_num . ", download=" . $download_num . ", cero='" . $db_store['cero'][$count] . "' where title LIKE '%" . $db_store['title'][$count] . "%'";
            }
        } else {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = '"' . $db_store['release_date'][$count] . '", ' . $softtype . ', "' . $db_store['title'][$count] . '", "' . $db_store['release_maker'][$count] . '", ' . $onlinetype_num . ', ' 
                . $rankingtype_num . ', ' . $joycon_sideways_num . ', ' . $download_num . ', "' . $db_store['cero'][$count] . '")';
            } else {
                $regist_sql = "'" . $db_store['release_date'][$count] . "', " . $softtype . ", '" . $db_store['title'][$count] . "', '" . $db_store['release_maker'][$count] . "', " . $onlinetype_num . ", " 
                . $rankingtype_num . ", " . $joycon_sideways_num . ", " . $download_num . ", '" . $db_store['cero'][$count] . "')";
            }
        }

        return $regist_sql;
    }

    private function sql_regist_create2($db_store, $softtype=1 ,$onlinetype_num, $rankingtype_num, $download_num, $count=0, $regist_sql) {

        if(strpos($regist_sql, "update") !== false) {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = 'release_date="' . $db_store['release_date'][$count] . '", type=' . $softtype . ', title="' . $db_store['title'][$count] . '", release_maker="' . $db_store['release_maker'][$count] . '", online=' . $onlinetype_num . ', ranking=' 
                . $rankingtype_num . ', download=' . $download_num . ', cero="' . $db_store['cero'][$count] . '" where title LIKE "%' . $db_store['title'][$count] . '%"';
            } else {
                $regist_sql = "release_date='" . $db_store['release_date'][$count] . "', type=" . $softtype . ", title='" . $db_store['title'][$count] . "', release_maker='" . $db_store['release_maker'][$count] . "', online=" . $onlinetype_num . ", ranking="
                . $rankingtype_num . ", download=" . $download_num . ", cero='" . $db_store['cero'][$count] . "' where title LIKE '%" . $db_store['title'][$count] . "%'";
            }
        } else {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = '"' . $db_store['release_date'][$count] . '", ' . $softtype . ', "' . $db_store['title'][$count] . '", "' . $db_store['release_maker'][$count] . '", ' . $onlinetype_num . ', ' 
                . $rankingtype_num . ', ' . $download_num . ', "' . $db_store['cero'][$count] . '")';
            } else {
                $regist_sql = "'" . $db_store['release_date'][$count] . "', " . $softtype . ", '" . $db_store['title'][$count] . "', '" . $db_store['release_maker'][$count] . "', " . $onlinetype_num . ", " 
                . $rankingtype_num . ", " . $download_num . ", '" . $db_store['cero'][$count] . "')";
            }
        }

        return $regist_sql;
    }

    private function sql_regist_create3($db_store, $softtype=1, $download_num, $count=0, $regist_sql, $release_maker="ハムスター") {

        if(strpos($regist_sql, "update") !== false) {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = 'release_date="' . $db_store['release_date'][$count] . '", type=' . $softtype . ', title="' . $db_store['title'][$count] . '", release_maker="' . $release_maker . '", online='
                . $download_num . ', cero="' . $db_store['cero'][$count] . '" where title LIKE "%' . $db_store['title'][$count] . '%"';
            } else {
                $regist_sql = "release_date='" . $db_store['release_date'][$count] . "', type=" . $softtype . ", title='" . $db_store['title'][$count] . "', release_maker='" . $release_maker . "', online="
                . $download_num . ", cero='" . $db_store['cero'][$count] . "' where title LIKE '%" . $db_store['title'][$count] . "%'";
            }
        } else {
            if(strpos($db_store['title'][$count], "'") !== false) {
                $regist_sql = '"' . $db_store['release_date'][$count] . '", ' . $softtype . ', "' . $db_store['title'][$count] . '", "' . $release_maker . '", ' 
                . ', ' . $download_num . ', "' . $db_store['cero'][$count] . '")';
            } else {
                $regist_sql = "'" . $db_store['release_date'][$count] . "', " . $softtype . ", '" . $db_store['title'][$count] . "', '" . $release_maker . "', "
                . $download_num . ", '" . $db_store['cero'][$count] . "')";
            }
        }

        return $regist_sql;
    }

    private function online_check($onlinetype) {

        if($onlinetype === "") {
            $onlinetype = 0;
        }
        if(strpos($onlinetype, "●") !== false) {
            $onlinetype = 1;
        }
        if(strpos($onlinetype, "○") !== false) {
            $onlinetype = 2;
        }

        return $onlinetype;
    }

    private function ranking_check($rankingtype) {

        if($rankingtype === "") {
            $rankingtype = 0;
        }
        if(strpos($rankingtype, "●") !== false) {
            $rankingtype = 1;
        }

        return $rankingtype;
    }

    private function joycon_sideways_check($joycon_sideways_type) {

        if($joycon_sideways_type === "") {
            $joycon_sideways_type = 0;
        }
        if(strpos($joycon_sideways_type, "●") !== false) {
            $joycon_sideways_type = 1;
        }
        if(strpos($joycon_sideways_type, "○") !== false) {
            $joycon_sideways_type = 2;
        }

        return $joycon_sideways_type;
    }

    private function download_check($downloadtype) {

        if($downloadtype === "") {
            $downloadtype = 0;
        }
        if(strpos($downloadtype, "●") !== false) {
            $downloadtype = 1;
        }

        return $downloadtype;
    }

    // 販売メーカーが同じ会社(名前が違う)を共通化させる
    public function release_maker_update($link, $relese_maker_list) {

        for($count = 0; $count <= count($relese_maker_list) - 1; $count++) {

            $release_maker = false;
            if(strpos($relese_maker_list[$count][1], "Astragon") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Astragon' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Chucklefish") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'ConcernedApe' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Deck13") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Deck13' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Deck 13") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Deck13' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "DMM GAMES") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'DMM GAMES' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Double Eleven") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Double Eleven' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Headup Games") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Headup Games' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Hi-Rez Studios") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Hi-Rez Studios' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Higgs Games") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Humble Bundle' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Ironhide Game Studio") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Ironhide Game Studio' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Microïds") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Microïds' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Playdead") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Playdead' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Ratalaika Games") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Ratalaika Games' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "RebellionInteract") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'RebellionInteract' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "ROCKSTAR GAMES/テイクツー・インタラクティブ・ジャパン") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'テイクツー・インタラクティブ・ジャパン' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Soedesco") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Soedesco' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Team17") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Team17' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "THQ Nordic ジャパン") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'THQ Nordic ジャパン' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Thunderful") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Thunderful' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Tribute Games") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Tribute Games' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Tru Blu Games") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Tru Blu Games' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "Yogscast") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'Yogscast' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "セガ") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'セガ' where id = " . $relese_maker_list[$count][0];
                echo $update_maker_update;
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "ダブルドライブ") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'ダブルドライブ' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "ゼニマックス・アジア") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'ゼニマックス・アジア' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "コンパイルハート") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'コンパイルハート' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "日本マイクロソフト") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = '日本マイクロソフト' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            if(strpos($relese_maker_list[$count][1], "ヒューネックス") !== false) {
                $update_maker_update = "update switch_software_data set release_maker = 'ヒューネックス' where id = " . $relese_maker_list[$count][0];
                $release_maker = true;
            }
            echo $release_maker;
            if($release_maker == true) {
                $regist = mysqli_query($link, $update_maker_update);
            }
        }
    }
}

class GameInsert extends GameInsertUpdate {

    public function relese_maker_cero_gamecount_list_insert($link, $relese_maker_cero_gamecount_list) {
        /* CERO全て */
        $cero_all = is_countable($relese_maker_cero_gamecount_list['cero_all']) ? count($relese_maker_cero_gamecount_list['cero_all']) : 0;
        $type1_all = is_countable($relese_maker_cero_gamecount_list['type1_all']) ? count($relese_maker_cero_gamecount_list['type1_all']) : 0;
        $type2_all = is_countable($relese_maker_cero_gamecount_list['type2_all']) ? count($relese_maker_cero_gamecount_list['type2_all']) : 0;
        $type3_all = is_countable($relese_maker_cero_gamecount_list['type3_all']) ? count($relese_maker_cero_gamecount_list['type3_all']) : 0;
        $download_all = is_countable($relese_maker_cero_gamecount_list['download_all']) ? count($relese_maker_cero_gamecount_list['download_all']) : 0;
        for($count = 0; $count <= $cero_all - 1; $count++) {
            $insert_relese_maker_cero_gamecount = "insert into switch_software_releasemaker_gamecount (`release_maker`, `cero_all`) ";
            $insert_relese_maker_cero_gamecount .= "values('" . $relese_maker_cero_gamecount_list['cero_all'][$count][1] . "', ";
            $insert_relese_maker_cero_gamecount .= $relese_maker_cero_gamecount_list['cero_all'][$count][0] . ")";
            $regist = mysqli_query($link, $insert_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type1_all - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_all = " . $relese_maker_cero_gamecount_list['type1_all'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_all'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type2_all - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_all = " . $relese_maker_cero_gamecount_list['type2_all'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_all'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type3_all - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_all = " . $relese_maker_cero_gamecount_list['type3_all'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_all'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $download_all - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_all = " . $relese_maker_cero_gamecount_list['download_all'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_all'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_A_3 */
        $cero_A_3 = is_countable($relese_maker_cero_gamecount_list['cero_A_3']) ? count($relese_maker_cero_gamecount_list['cero_A_3']) : 0;
        $type1_A_3 = is_countable($relese_maker_cero_gamecount_list['type1_A_3']) ? count($relese_maker_cero_gamecount_list['type1_A_3']) : 0;
        $type2_A_3 = is_countable($relese_maker_cero_gamecount_list['type2_A_3']) ? count($relese_maker_cero_gamecount_list['type2_A_3']) : 0;
        $type3_A_3 = is_countable($relese_maker_cero_gamecount_list['type3_A_3']) ? count($relese_maker_cero_gamecount_list['type3_A_3']) : 0;
        $download_A_3 = is_countable($relese_maker_cero_gamecount_list['download_A_3']) ? count($relese_maker_cero_gamecount_list['download_A_3']) : 0;
        for($count = 0; $count <= $cero_A_3 - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_A_3 = " . $relese_maker_cero_gamecount_list['cero_A_3'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_A_3'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type1_A_3 - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_A_3 = " . $relese_maker_cero_gamecount_list['type1_A_3'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_A_3'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type2_A_3 - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_A_3 = " . $relese_maker_cero_gamecount_list['type2_A_3'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_A_3'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $type3_A_3 - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_A_3 = " . $relese_maker_cero_gamecount_list['type3_A_3'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_A_3'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= $download_A_3 - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_A_3 = " . $relese_maker_cero_gamecount_list['download_A_3'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_A_3'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_7 */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_7']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_7 = " . $relese_maker_cero_gamecount_list['cero_7'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_7'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_7']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_7 = " . $relese_maker_cero_gamecount_list['type1_7'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_7'][$count][1] . "'";
            // echo $update_relese_maker_cero_gamecount . "<br>";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_7']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_7 = " . $relese_maker_cero_gamecount_list['type2_7'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_7'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_7']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_7 = " . $relese_maker_cero_gamecount_list['type3_7'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_7'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_7']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_7 = " . $relese_maker_cero_gamecount_list['download_7'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_7'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_B_12 */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_B_12']) - 1; $count++) {
            // if($relese_maker_cero_gamecount_list['cero_all_type1'][0] == null) {

            // }
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_B_12 = " . $relese_maker_cero_gamecount_list['cero_B_12'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_B_12'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_B_12']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_B_12 = " . $relese_maker_cero_gamecount_list['type1_B_12'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_B_12'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_B_12']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_B_12 = " . $relese_maker_cero_gamecount_list['type2_B_12'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_B_12'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_B_12']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_B_12 = " . $relese_maker_cero_gamecount_list['type3_B_12'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_B_12'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_B_12']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_B_12 = " . $relese_maker_cero_gamecount_list['download_B_12'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_B_12'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_C */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_C']) - 1; $count++) {
            // if($relese_maker_cero_gamecount_list['cero_all_type1'][0] == null) {

            // }
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_C = " . $relese_maker_cero_gamecount_list['cero_C'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_C'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_C']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_C = " . $relese_maker_cero_gamecount_list['type1_C'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_C'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_C']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_C = " . $relese_maker_cero_gamecount_list['type2_C'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_C'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_C']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_C = " . $relese_maker_cero_gamecount_list['type3_C'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_C'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_C']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_C = " . $relese_maker_cero_gamecount_list['download_C'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_C'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_16 */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_16']) - 1; $count++) {
            // if($relese_maker_cero_gamecount_list['cero_all_type1'][0] == null) {

            // }
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_16 = " . $relese_maker_cero_gamecount_list['cero_16'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_16'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_16']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_16 = " . $relese_maker_cero_gamecount_list['type1_16'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_16'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_16']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_16 = " . $relese_maker_cero_gamecount_list['type2_16'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_16'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_16']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_16 = " . $relese_maker_cero_gamecount_list['type3_16'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_16'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_16']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_16 = " . $relese_maker_cero_gamecount_list['download_16'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_16'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_D */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_D']) - 1; $count++) {
            // if($relese_maker_cero_gamecount_list['cero_all_type1'][0] == null) {

            // }
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_D = " . $relese_maker_cero_gamecount_list['cero_D'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_D'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_D']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_D = " . $relese_maker_cero_gamecount_list['type1_D'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_D'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_D']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_D = " . $relese_maker_cero_gamecount_list['type2_D'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_D'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_D']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_D = " . $relese_maker_cero_gamecount_list['type3_D'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_D'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_D']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_D = " . $relese_maker_cero_gamecount_list['download_D'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_D'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        /* cero_Z */
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['cero_Z']) - 1; $count++) {
            // if($relese_maker_cero_gamecount_list['cero_all_type1'][0] == null) {

            // }
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set cero_Z = " . $relese_maker_cero_gamecount_list['cero_Z'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['cero_Z'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type1_Z']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type1_Z = " . $relese_maker_cero_gamecount_list['type1_Z'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type1_Z'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type2_Z']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type2_Z = " . $relese_maker_cero_gamecount_list['type2_Z'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type2_Z'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['type3_Z']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set type3_Z = " . $relese_maker_cero_gamecount_list['type3_Z'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['type3_Z'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }
        for($count = 0; $count <= count($relese_maker_cero_gamecount_list['download_Z']) - 1; $count++) {
            $update_relese_maker_cero_gamecount = "update switch_software_releasemaker_gamecount set download_Z = " . $relese_maker_cero_gamecount_list['download_Z'][$count][0] . " where release_maker = '" . $relese_maker_cero_gamecount_list['download_Z'][$count][1] . "'";
            $regist = mysqli_query($link, $update_relese_maker_cero_gamecount);
        }


    }

}