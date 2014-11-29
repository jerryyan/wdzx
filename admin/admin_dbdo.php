<?php

include '../db.php';
if (isset($_POST['do']) && $_POST['do'] == "ischeck") {
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = $_POST["id"];
        mysql_query("update wdzx_navigation_submit set fstatus=1 where id=$id");
        $result = db_fetch_array("select * from wdzx_navigation_submit where id=$id", $conn);
        $name = $result['name'];
        $url = $result['url'];
        $initial = getfirstchar($result['name']);
        $time = $result['year'];
        $nowtime = date("Y-m-d");
        $monthNum = getMonthNum($time, $nowtime);
        if ($monthNum >= 0 && $monthNum <= 3) {
            $level = 4;
        } elseif ($monthNum > 3 && $monthNum <= 6) {
            $level = 3;
        } else {
            $level = 2;
        }
        $province = $result['province'];
        $sql = "insert into wdzx_navigation_links(name,url,initial,level,province) value('$name','$url','$initial',$level,'$province')";
        $result = mysql_query($sql, $conn);
        echo $result;
        exit();
    }
}

//2个时间月份比较
function getMonthNum($date1, $date2, $tags = '-') {
    $date1 = explode($tags, $date1);
    $date2 = explode($tags, $date2);
    return abs($date1[0] - $date2[0]) * 12 + abs($date1[1] - $date2[1]);
}

//获取汉字首字母
function getfirstchar($s0) {
    $firstchar_ord = ord(strtoupper($s0{0}));
    if (($firstchar_ord >= 65 and $firstchar_ord <= 91)or ( $firstchar_ord >= 48 and $firstchar_ord <= 57))
        return $s0{0};
    $s = iconv("UTF-8", "gb2312", $s0);
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if ($asc >= -20319 and $asc <= -20284)
        return "A";
    if ($asc >= -20283 and $asc <= -19776)
        return "B";
    if ($asc >= -19775 and $asc <= -19219)
        return "C";
    if ($asc >= -19218 and $asc <= -18711)
        return "D";
    if ($asc >= -18710 and $asc <= -18527)
        return "E";
    if ($asc >= -18526 and $asc <= -18240)
        return "F";
    if ($asc >= -18239 and $asc <= -17923)
        return "G";
    if ($asc >= -17922 and $asc <= -17418)
        return "H";
    if ($asc >= -17417 and $asc <= -16475)
        return "J";
    if ($asc >= -16474 and $asc <= -16213)
        return "K";
    if ($asc >= -16212 and $asc <= -15641)
        return "L";
    if ($asc >= -15640 and $asc <= -15166)
        return "M";
    if ($asc >= -15165 and $asc <= -14923)
        return "N";
    if ($asc >= -14922 and $asc <= -14915)
        return "O";
    if ($asc >= -14914 and $asc <= -14631)
        return "P";
    if ($asc >= -14630 and $asc <= -14150)
        return "Q";
    if ($asc >= -14149 and $asc <= -14091)
        return "R";
    if ($asc >= -14090 and $asc <= -13319)
        return "S";
    if ($asc >= -13318 and $asc <= -12839)
        return "T";
    if ($asc >= -12838 and $asc <= -12557)
        return "W";
    if ($asc >= -12556 and $asc <= -11848)
        return "X";
    if ($asc >= -11847 and $asc <= -11056)
        return "Y";
    if ($asc >= -11055 and $asc <= -10247)
        return "Z";
    return null;
}
