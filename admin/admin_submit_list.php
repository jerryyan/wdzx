<?php
include '../common/admin_header.php';
if (isset($_REQUEST["id"])&&!empty($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    if ($id > 0) {
        mysql_query("update wdzx_navigation_submit set fstatus=1 where id=$id");
    }
}
$sql = "select * from wdzx_navigation_submit order by id desc";
$dh_list = db_fetch_arrays($sql, $conn);
if (isset($_GET['del']) && $_GET['del'] == 'tok') {
    $sqlt = 'delete from wdzx_navigation_submit where id=' . $id;
    mysql_query($sqlt);
}




if (isset($_REQUEST["page"]) && !empty($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
} else {
    $page = 1;
}


if (is_numeric($page)) {
    $page_size = 20;
    $query = "select count(*) as total from wdzx_navigation_submit order by id desc";
    $result = mysql_query($query, $conn);
    $row = mysql_fetch_row($result);
    $message_count = $row[0];
    $page_count = ceil($message_count / $page_size);
    $offset = ($page - 1) * $page_size;
    $result = mysql_query("select * from wdzx_navigation_submit order by id desc limit $offset,$page_size");
}
?>

<table align="center" border="1" >
    <tr>
        <th>名称</th>
        <th>网址</th>
        <th>联系人QQ</th>
        <th>省份</th>
        <th>年份</th>
        <th>logo地址</th>
        <th>状态</th>
        <th>操作</th>
            <!--<th>添加时间</th>-->
    </tr>
    <?php while ($row = mysql_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['url']; ?></td>
            <td><?php echo $row['link_qq']; ?></td>
            <td><?php echo $row['province']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['logo_url']; ?></td>
            <td><a href="?id=<?php echo $row['id']; ?>"><?php echo $row['fstatus'] == 0 ? "未审核" : "已审核"; ?></a></td>
            <td><a style="color:red" href="?del=tok&id=<?php echo $row['id']; ?>" onclick="condel();">删除</a></td>
        </tr>

        <?php
    }
    ?>

</table>
<div style="width:1000px;margin:0 auto;padding:0">
    当前页码：<?php echo $page; ?>/<?php echo $page_count; ?>
    记录条数：<?php echo $message_count; ?>

    <?php
    if ($page != 1) {
        echo "<a href=?page=1>首页</a> | ";
        echo "<a href=?page=" . ($page - 1) . ">上一页</a>   ";
    }
    ?>         

    <?php
    if ($page < $page_count) {
        echo "<a href=?page=" . ($page + 1) . ">下一页</a> | ";
        echo "<a href=?page=" . $page_count . ">尾页</a>";
    }
    mysql_close($conn);
    ?>
</div>
<script type="text/javascript">

    function condel() {
        alert('删除成功');
        window.location.reload()
    }


</script>
<?php include '../common/footer.php'; ?>