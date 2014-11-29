<?php

include '../db.php';
$del = $_POST['del'];
if ($del == "list") {
    $id = $_POST['id'];
    $result = mysql_query("delete from  wdzx_navigation_links where id=$id", $conn);
    echo $result;
    exit();
}

if ($del == 'submitlist') {
    $id = $_POST['id'];
    $result = mysql_query("delete from wdzx_navigation_submit where id=$id", $conn);
    echo $result;
    exit();
}


