<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include '../db.php';
$lifetime = 60*60; //保存1小时
session_set_cookie_params($lifetime);
session_start();
session_regenerate_id(true);


if (!empty($_GET['action']) && $_GET['action'] == "logout") {
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    header("Location:login.php");
    exit;
}

if (!isset($_POST['submit'])) {
    exit('非法访问!');
}
$username = htmlspecialchars($_POST['username']);
$flat = db_fetch_array("select flat from wdzx_navigation_users where username='$username'", $conn);
if (empty($flat)) {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
$pwd = $_POST['password'];
$password = MD5($pwd . $flat['flat']);

//检测用户名及密码是否正确
$check_query = mysql_query("select id from wdzx_navigation_users where username='$username' and pwd='$password' limit 1");
if ($result = mysql_fetch_array($check_query)) {
    //登录成功
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $result['id'];
    header("Location:admin_list.php");
    exit;
} else {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
?>