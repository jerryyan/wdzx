<?php
include '../db.php';
$id = $_POST['id'];
$result = mysql_query("delete from  wdzx_navigation_links where id=$id", $conn);
echo $result;


