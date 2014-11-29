<?php
include '../common/admin_header.php';
empty($_REQUEST["province"]) ? $province = "" : $province = $_REQUEST["province"];
empty($_REQUEST["initial"]) ? $initial = "" : $initial = $_REQUEST["initial"];

$szm = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$sql = "select * from wdzx_navigation_links  where 1=1 ";

if ($province != '') {
    $sql .= " and province='$province'";
}
if ($initial != '') {
    $sql .= " and initial='$initial'";
}
$dh_list = db_fetch_arrays($sql, $conn);
?>



<div id="dialog-confirm" title="删除该记录？" style="display: none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>您确认删除该记录?</p>
</div>

<div class="tt2">
    <div class="column">
        <?php $province_list = db_fetch_arrays("SELECT province,COUNT(*) AS total FROM wdzx_navigation_links GROUP BY province ORDER BY total DESC;", $conn); ?>
        <div class="left cllist"><span>地区分类：</span>&nbsp;
            <a href="?initial=<?php echo $initial; ?>" <?php if ($province == "") { ?>class="current"<?php } ?>>全部</a>
            <?php foreach ($province_list as $value) { ?>
                <a href="?province=<?php echo $value["province"]; ?>&initial=<?php echo $initial; ?>" <?php if ($province == $value["province"]) { ?>class="current"<?php } ?>><?php echo $value["province"]; ?>(<?php echo $value["total"]; ?>)</a>
            <?php } ?>
        </div>
        <div class="clear"></div>

        <div class="clline"></div>
        <div class="cllist2"><span>字母查找：</span>&nbsp;
            <a href="?province=<?php echo $province; ?>" <?php if ($initial == '') { ?>class="current"<?php } ?>>全</a>

            <?php foreach ($szm as $s) { ?>
                <a href="?initial=<?php echo $s; ?>&province=<?php echo $province; ?>" <?php if ($initial == $s) { ?>class="current"<?php } ?>><?php echo $s; ?></a>
            <?php } ?>
            <div class="cler"></div>

            <div class="clear"></div>
        </div>
        <a href="admin_add.php">加入导航</a>
    </div>
    <div class="content">
        <ul class="left tbalist">
            <li onmousemove="level_show(0)"><a href="#" class="current" id="type_0">所有平台</a></li>
            <li onmousemove="level_show(1)"><a href="#" id="type_1">活跃平台</a></li>
            <li onmousemove="level_show(2)"><a href="#" id="type_2">人气平台</a></li>
            <li onmousemove="level_show(3)"><a href="#" id="type_3">成长平台</a></li>
            <li onmousemove="level_show(4)"><a href="#" id="type_4">新平台</a></li>
            <li onmousemove="level_show(5)"><a href="#" id="type_5">问题平台</a></li>
        </ul>
        <div class="left conlist" id="level_0">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext">
                <?php foreach ($dh_list as $dh) { ?>
                <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>

                <?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_1" style="display:none;">
            <ul class="conlisttext">
                <?php
                foreach ($dh_list as $dh) {
                    if ($dh["level"] != 1) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
<?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_2" style="display:none;">
            <ul class="conlisttext">
                <?php
                foreach ($dh_list as $dh) {
                    if ($dh["level"] != 2) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a><span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
<?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_3" style="display:none;">
            <ul class="conlisttext">
                <?php
                foreach ($dh_list as $dh) {
                    if ($dh["level"] != 3) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
<?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_4" style="display:none;">
            <ul class="conlisttext">
                <?php
                foreach ($dh_list as $dh) {
                    if ($dh["level"] != 4) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
<?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_5" style="display:none;">
            <ul class="conlisttext">
                <?php
                foreach ($dh_list as $dh) {
                    if ($dh["level"] != 5) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="inspect" id="<?php echo $dh['id']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
<?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    <!--
    function level_show(id) {
        for (var i = 0; i < 6; i++) {
            $("#level_" + i).hide();
            $("#type_" + i).attr("class", "");
        }

        $("#level_" + id).show();
        $("#type_" + id).attr("class", "current");
    }
    //-->

    $(".conlisttext").children('li').mouseover(function () {
        $(this).children('.doing').css("display", "inline-block");
    });
    $(".conlisttext").children('li').mouseout(function () {
        $(this).children('.doing').css("display", "none");
    });
    $(".kc3").click(function () {
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
                        data: {id: data, del: 'list'},
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
<?php include '../common/footer.php'; ?>