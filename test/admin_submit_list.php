<?php include 'common/header.php';

$id = $_REQUEST["id"];
if($id > 0){
	mysql_query("update wdzx_navigation_submit set fstatus=1 where id=$id");
}
$sql = "select * from wdzx_navigation_submit order by id desc";
$dh_list = db_fetch_arrays($sql, $conn);
?>

<table align="center" border="1">
  <tr>
    <th>名称</th>
    <th>网址</th>
    <th>联系人QQ</th>
    <th>省份</th>
    <th>年份</th>
    <th>logo地址</th>
	<th>添加时间</th>
    <th>状态</th>
  </tr>
  <?php foreach ($dh_list as $dh){?>
  <tr>
    <td><?php echo $dh['name'];?></td>
    <td><?php echo $dh['url'];?></td>
    <td><?php echo $dh['link_qq'];?></td>
    <td><?php echo $dh['province'];?></td>
    <td><?php echo $dh['year'];?></td>
    <td><?php echo $dh['logo_url'];?></td>
	<td><?php //echo date('Y-m-d H:i:s', $dh['add_time'];);?></td>
    <td><a href="?id=<?php echo $dh['id'];?>"><?php echo $dh['fstatus']==0?"未审核":"已审核";?></a></td>
  </tr>
  <?php }?>
</table>



<?php include 'common/footer.php';?>
