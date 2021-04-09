<?php
class GameSelect {

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

    public function gamecount_select($link) {

        $select_sql = "select count(*) from switch_software_data";

        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        $row = mysqli_fetch_array($select);
        print($row[0] . " ");

        return $row[0];
    }

    public function gamerand_select($link, $gamerand) {

        $select_sql = "select id, title from switch_software_data limit 1 OFFSET " . $gamerand;

        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        while($row = mysqli_fetch_array($select)) {
            $select_game[0] = $row[0];
            $select_game[1] = $row[1];
        }


        return $select_game;
    }

    public function release_maker_select($link) {

        $select_sql = "select id, release_maker from switch_software_data";

        $count = 0;
        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        while($row = mysqli_fetch_array($select)) {
            $select_game[$count][0] = $row[0];
            $select_game[$count][1] = $row[1];
            // echo $select_game[$count][0] . " " . $select_game[$count][1] . "<br>";
            $count++;
        }


        return $select_game;
    }

    public function release_maker_group_select($link) {

        $select_sql = "select release_maker from switch_software_data group by release_maker";

        $count = 0;
        $select = mysqli_query($link, $select_sql);//SQLのクエリ送信（クエリ：DBに情報要求）
        while($row = mysqli_fetch_array($select)) {
            $select_game[$count][0] = $row[0];
            // echo $select_game[$count][0] . "<br>";
            $count++;
        }


        return $select_game;
    }

    public function release_maker_cero_gamecount_select($link, $relese_maker_list) {
        require_once("../gamecount/gamecount.php");
        $select_cero_gamecount = release_maker_gamecount($link);

        return $select_cero_gamecount;
    }
}