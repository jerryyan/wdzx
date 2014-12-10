<?php
include '../common/admin_header.php';
$sql = "select * from wdzx_navigation_submit order by id desc";
$dh_list = db_fetch_arrays($sql, $conn);

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

<div id="dialog-confirm" title="删除该记录？" style="display: none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>您确认删除该记录?</p>
</div>
<table align="center" border="1" style="min-width:1000px;border-collapse:collapse;" cellpadding="3" cellspacing="0" >
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
            <td><?php echo $row['fstatus'] == 0 ? "<a style='cursor:pointer;' class='ischeck' id={$row['id']}>未审核</a>" : "已审核"; ?></td>
            <td><a href="admin_submit_edit.php?id=<?php echo $row['id']; ?>" >修改</a>&nbsp;&nbsp;<a style="color:red;cursor:pointer;" class='del' id="<?php echo $row['id']; ?>" >删除</a></td>
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
    $(".ischeck").click(function () {
         var data = $(this).attr("id");
        $.ajax({
            type: "post",
            url: 'admin_dbdo.php',
            dataType: "json",
            data: {id: data, doing: 'ischeck'},
            success: function (msg) {
                if (msg === 1) { 
                    alert("审核成功！");
                  window.location.href="admin_submit_list.php?page=<?php echo $page; ?>";
                } else {
                    alert("审核失败，请联系管理员！");
                }
            }
        });
    });


    $(".del").click(function () {
        var data = $(this).attr("id");
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "确定": function () {
                    $.ajax({
                        type: "post",
                        url: 'admin_del.php',
                        dataType: "json",
                        data: {id: data, del: 'submitlist'},
                        success: function (msg) {
                            if (msg === 1) {
                                alert("删除成功");                              
                              location.reload();
                            } else {
                                alert("删除失败，请联系管理员！");
                            }
                        }
                    });
                },
                "取消": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
</script>
<?php
include '../common/footer.php';
