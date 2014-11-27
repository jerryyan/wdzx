<?php

$conn = mysql_connect("localhost", "root", "ROOT.mysq1")or die("数据库连接失败");
mysql_select_db("datazx", $conn);
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);

function db_fetch_arrays($sql, $conn) {
    $result = mysql_query($sql, $conn);
    $i = 0;
    $_res = array();
    while (@$res = mysql_fetch_array($result, MYSQL_ASSOC)) {
        foreach ($res as $key => $value) {
            $_res[$i][$key] = $value; //直接转义
        }
        $i++;
    }
    return $_res;
}

function db_fetch_array($sql, $conn) {
    $result = mysql_query($sql, $conn);
    $res = mysql_fetch_array($result, MYSQL_ASSOC);
    $_res = "";
    if (is_array($res)) {
        foreach ($res as $key => $value) {
            $_res[$key] = $value;
        }
    }
    $query = $_res;
    return $query;
}

?>
