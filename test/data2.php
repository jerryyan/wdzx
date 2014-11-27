<?php
$province = array(
"3"=>"浙江",
"4"=>"江苏",
"5"=>"广东",
"6"=>"福建",
"7"=>"山东",
"8"=>"河北",
"9"=>"天津",
"10"=>"辽宁",
"11"=>"吉林",
"12"=>"黑龙江",
"13"=>"内蒙古",
"14"=>"山西",
"15"=>"河南",
"16"=>"安徽",
"17"=>"江西",
"18"=>"广西",
"19"=>"湖南",
"20"=>"湖北",
"21"=>"宁夏",
"22"=>"陕西",
"23"=>"重庆",
"24"=>"贵州",
"25"=>"四川",
"26"=>"海南",
"27"=>"云南",
"28"=>"青海",
"29"=>"西藏",
"30"=>"甘肃",
"31"=>"北京",
"32"=>"上海",
"33"=>"新疆",
);
for($i = 2; $i < 34; $i++ ){
	$url = "http://www.p2plac.com/CityALl.aspx?TypeId=".$i; 
	$contents = file_get_contents($url); 
	$contents = substr($contents, strpos($contents, '<div class="bd Fix" style="float: left; display: block; margin-top: 0px; width: 946px;">'));
	$contents = substr($contents, 0, strpos($contents, '<!--list.var2-->'));
	
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
		$name = str_replace("【危】", "",$name);
		echo 'update wdzx_navigation_links set province="'.$province["$i"].'" where name="$name";';
		$index++;
	}
	echo "<br>";
}



