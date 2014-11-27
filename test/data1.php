<?php
$filename = "site.txt";
$handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'
$contents = fread($handle, filesize ($filename));
fclose($handle);
$list = explode('<a class="url" target="_blank"  href="', $contents);
//print_r($list);
$index = 0;
foreach ($list as $obj){
	if($index == 0){
		$index++;
		continue;
	}
	
	$tmp = substr($obj, 0, strpos($obj, '<div class="tips-star">'));
	$tmp1 = explode('">', $tmp);
	$url = trim($tmp1[0]);
	$name = trim(str_replace("\r\n",'',str_replace('</a>', '', trim(str_replace(" ", "", $tmp1[1])))));
	echo "update wdzx_navigation_links set province='天津' where name='$name';";
	$index++;
}