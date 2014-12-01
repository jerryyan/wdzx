<?php
include '../common/admin_header.php';
include 'page.php';
$page_size = 20; //每页数量
$p = isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : 1;
$url = $_SERVER['PHP_SELF'] . "?p=";
$offset = ($p - 1)*$page_size;
$sql = "select * from wdzx_navigation_links where `level`=5  order by id desc limit $offset,$page_size";
$dh_list = db_fetch_arrays($sql, $conn);
$total = db_fetch_array("select count(id) as total from wdzx_navigation_links where `level`=5", $conn);
$subPages = new Page();
?>
<div id="problem-confirm" title="问题地址操作" style="display: none;">
    <p>地址：<textarea id='praddress' style="vertical-align: top;height: 100px;width: 250px"></textarea></p>
</div>
<table align="center" border="1" style="min-width:1000px; " >
    <tr>
        <th>名称</th>
        <th>网址</th>     
        <th>省份</th>
        <th>问题地址</th>
        <th>操作</th>          
    </tr>
    <?php foreach ($dh_list as $v) { ?>
        <tr>
            <td><?php echo $v['name']; ?></td>
            <td><?php echo $v['url']; ?></td>
            <td><?php echo $v['province']; ?></td>
            <td><?php echo $v['problem']; ?></td>
            <td style="text-align:center;"><a style="cursor:pointer;" class="problem" id="<?php echo $v['id'] . "#" . $v['problem']; ?>"><?php echo empty($v['problem']) ? "添加" : "修改"; ?></a></td>
        </tr>

        <?php
    }
    ?>
</table>
<div style="width:900px;margin: 0 auto;"><?php $subPages->fenye($page_size, $total['total'], $p, 5, $url, 2); ?></div>
<script type="text/javascript">
    $(".problem").click(function () {       
        var data = $(this).attr("id");
        var strs = new Array();
        strs = data.split("#");
        if (strs[1] !== "") {
            $("#praddress").val(strs[1]);
        }
        $("#problem-confirm").dialog({
            resizable: false,
            height: 250,
            width: 300,
            modal: true,
            buttons: {
                "确定": function () {
                    var newaddress = $("#praddress").val();
                    $.ajax({
                        type: "post",
                        url: 'admin_dbdo.php',
                        dataType: "json",
                        data: {id: strs[0], do: 'problem', address: newaddress},
                        success: function (msg) {
                            if (msg === 1) {
                                alert("操作成功");
                                location.reload();
                            } else {
                                alert("操作成功，请联系管理员！");
                            }
                        }
                    });
                },
                "取消": function () {
                    $(this).dialog("close");
                    $("#praddress").val("");
                }
            }
        });
    });
</script>
<?php
include '../common/footer.php';
