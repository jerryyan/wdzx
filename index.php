<?php include 'common/header.php';
$province = $_REQUEST["province"];
$initial  = $_REQUEST["initial"];

$szm = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$sql = "select * from wdzx_navigation_links  where 1=1 ";
$wtnum = "select count(*) from wdzx_navigation_links where level=5 ";
$a=mysql_query($wtnum, $conn);
$row=mysql_fetch_row($a);

if($province != '')
	$sql .= " and province='$province'";
if($initial != '')
	$sql .= " and initial='$initial'";
$dh_list = db_fetch_arrays($sql, $conn);
?>
<div class="tt">

  <div class="ptlist">	    
    <ul>
      <?php 
      $dh_level1 = db_fetch_arrays("select * from wdzx_navigation_links where is_hot=1", $conn);
      $i = 0;foreach($dh_level1 as $dh){?>	
      <li><a href="<?php echo $dh['url'];?>" target="_blank" <?php if($i==7){?>style="border-right:1px solid #cecece"<?php }?>><img src="images/logo/<?php echo $dh['id'];?>.png" width="124" height="74" /></a></li>
      <?php $i++;}?>
      <li style="display:none;"><a href="#" style="border-right:1px solid #cecece"><img src="images/tj_25.jpg" width="124" height="74" /></a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="w1000 mt10">
  <div class="ptlisttitle left">网贷平台导航</div>
  <ul class="left subcloumn">
    <li><a href="#">行业第三方</a></li>
	<li><a href="#">第三方支付</a></li>
	<li><a href="#">网贷系统</a></li>
	<li><a href="#">监管机构</a></li>
	<li><a href="#">银行大全</a></li>
  </ul>
  <div class="login right"><a href="submit.php">申请加入导航</a></div>
  <div class="clear"></div>
</div>
<div class="tt2">
  <div class="column">
  	<?php $province_list = db_fetch_arrays("SELECT province,COUNT(*) AS total FROM wdzx_navigation_links GROUP BY province ORDER BY total DESC;", $conn);?>
    <div class="left cllist"><span>地区分类：</span>&nbsp;
    <a href="?initial=<?php echo $initial;?>" <?php if($province == ""){?>class="current"<?php }?>>全部</a>
    <?php foreach ($province_list as $value) {?>
    <a href="?province=<?php echo $value["province"];?>&initial=<?php echo $initial;?>" <?php if($province == $value["province"]){?>class="current"<?php }?>><?php echo $value["province"];?>(<?php echo $value["total"];?>)</a>
    <?php }?>
    </div>
    <div class="clear"></div>
    
    <div class="clline"></div>
    <div class="cllist2"><span>字母查找：</span>&nbsp;
    <a href="?province=<?php echo $province;?>" <?php if($initial == ''){?>class="current"<?php }?>>全</a>
    
    <?php foreach($szm as $s){?>
    <a href="?initial=<?php echo $s;?>&province=<?php echo $province;?>" <?php if($initial == $s){?>class="current"<?php }?>><?php echo $s;?></a>
    <?php }?>
      <div class="cler"></div>
      <div class="clear"></div>
    </div>
    
  </div>
  <div class="content">
    <ul class="left tbalist" style="position:relative;">
      <li onmousemove="level_show(0)"><a href="#" class="current" id="type_0">所有平台</a></li>
      <li onmousemove="level_show(1)"><a href="#" id="type_1">活跃平台</a></li>
      <li onmousemove="level_show(2)"><a href="#" id="type_2">人气平台</a></li>
      <li onmousemove="level_show(3)"><a href="#" id="type_3">成长平台</a></li>
      <li onmousemove="level_show(4)"><a href="#" id="type_4">新平台</a></li>
      <li onmousemove="level_show(5)"><a href="#" id="type_5">问题平台</a></li>
	  <!--<span style="position:absolute ;top:285px;left:30px;font-size:12px;color:red;">个</span>--><?php //echo $row[0];?>
    </ul>
    <div class="left conlist" id="level_0">
      <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php foreach ($dh_list as $dh){?>
        <li><a href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="left conlist" id="level_1" style="display:none;">
	  <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php foreach ($dh_list as $dh){if($dh["level"] != 1){continue;}?>
        <li><a href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="left conlist" id="level_2" style="display:none;">
	  <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php foreach ($dh_list as $dh){if($dh["level"] != 2){continue;}?>
        <li><a href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="left conlist" id="level_3" style="display:none;">
	  <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php foreach ($dh_list as $dh){if($dh["level"] != 3){continue;}?>
        <li><a href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="left conlist" id="level_4" style="display:none;">
	  <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php foreach ($dh_list as $dh){if($dh["level"] != 4){continue;}?>
        <li><a href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="left conlist" id="level_5" style="display:none;">
	  <div class="clear"></div>
      <div class="clline"></div>
      <ul class="conlisttext">
        <?php $rev_dh_list = array_reverse($dh_list);foreach ($rev_dh_list as $dh){if($dh["level"] != 5){continue;}?>
        <li><a style="color:red;" href="<?php echo $dh['url'];?>" target="_blank"><font size="3px;"><?php echo $dh['name'];?></font></a></li>
        <?php }?>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="clear"></div>
  </div>
</div>
<script type="text/javascript">
<!--
function level_show(id){
	for(var i = 0; i<6; i++){
		$("#level_"+i).hide();
		$("#type_"+i).attr("class", "");
	}
	
	$("#level_"+id).show();
	$("#type_"+id).attr("class","current");
}
//-->
</script>
<?php include 'common/footer.php';?>