<?php
include '../common/admin_header.php';
empty($_REQUEST["province"]) ? $province = "" : $province = $_REQUEST["province"];
empty($_REQUEST["initial"]) ? $initial = "" : $initial = $_REQUEST["initial"];
$key = isset($_GET['key']) && !empty($_GET['key']) ? trim($_GET['key']) : "";
$szm = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$sql = "select * from wdzx_navigation_links  where 1=1 ";

if ($province != '') {
    $sql .= " and province='$province'";
}
if ($initial != '') {
    $sql .= " and initial='$initial'";
}
if ($key != '') {
    $sql.= " and  name like '%$key%'";
}
$dh_list = db_fetch_arrays($sql, $conn);

$resultnames = mysql_query("SELECT * FROM wdzx_navigation_links", $conn);
while ($row = mysql_fetch_array($resultnames)) {
    $names[] = $row['name'];
}
$json_names = json_encode($names);
?>



<div id="dialog-confirm" title="删除该记录？" style="display: none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>您确认删除该记录?</p>
</div>

<div id="inspect-confirm" title="考察地址操作" style="display: none;">
    <p>地址：<textarea id='inaddress' style="vertical-align: top;height: 100px;width: 250px"></textarea></p>
</div>

<div id="verify-confirm" title="入驻网贷中心地址操作" style="display: none;">
    <p>地址：<textarea id='verifyaddress' style="vertical-align: top;height: 100px;width: 250px"></textarea></p>
</div>

<div class="tt2">
    <div class="column">
        <?php $province_list = db_fetch_arrays("SELECT province,COUNT(*) AS total FROM wdzx_navigation_links GROUP BY province ORDER BY total DESC;", $conn); ?>
        <div class="left cllist"><span>地区分类：</span>
            <a href="?initial=<?php
            echo $initial;
            if ($key != "") {
                echo "&key=" . $key;
            }
            ?>" <?php if ($province == "") { ?>class="current"<?php } ?>>全部</a>
               <?php foreach ($province_list as $value) { ?>
                <a href="?province=<?php echo $value["province"]; ?><?php
                if ($initial != "") {
                    echo "&initial=" . $initial;
                }if ($key != "") {
                    echo "&key=" . $key;
                }
                ?>" <?php if ($province == $value["province"]) { ?>class="current"<?php } ?>><?php echo $value["province"]; ?>(<?php echo $value["total"]; ?>)</a>
               <?php } ?>
        </div>
        <div class="clear"></div>

        <div class="clline"></div>
        <div class="cllist2"><span>字母查找：</span>
            <a href="?province=<?php
            echo $province;
            if ($key != "") {
                echo "&key=" . $key;
            }
            ?>" <?php if ($initial == '') { ?>class="current"<?php } ?>>全</a>

            <?php foreach ($szm as $s) { ?>
                <a href="?initial=<?php echo $s; ?><?php
                if ($province != "") {
                    echo "&province=" . $province;
                }if ($key != "") {
                    echo "&key=" . $key;
                }
                ?>" <?php if ($initial == $s) { ?>class="current"<?php } ?>><?php echo $s; ?></a>
               <?php } ?>
            <div class="cler"></div>
            <div class="clear"></div>
        </div>
        <a href="admin_add.php">加入导航</a>

    </div>
    <div id="noic" style="display:inline-block;float: left;">
        提示：点击名称：修改平台信息
        <img src="../images/verify.png">:入驻网贷中心平台地址操作
        <img src="../images/inspect.png">:平台考擦地址操作
        <i class="kc3_ii"></i>:删除平台
    </div>
    <div class="search_box">
        <label id="kw">关键字：</label>      
        <input id="keywords" type="text" placeholder="请输入平台名称" value="<?php
        if (!empty($key)) {
            echo $key;
        }
        ?>" >
        <input type="button" value="" class="search_ico" />       
    </div>
    <div class="content">
        <ul class="left tbalist">
            <li class="pingtai" id="0"><a href="#" class="current" id="type_0">所有平台</a></li>
            <li class="pingtai" id="1"><a href="#" id="type_1">活跃平台</a></li>
            <li class="pingtai" id="2"><a href="#" id="type_2">人气平台</a></li>
            <li class="pingtai" id="3"><a href="#" id="type_3">成长平台</a></li>
            <li class="pingtai" id="4"><a href="#" id="type_4">新平台</a></li>
            <li class="pingtai" id="5"><a href="#" id="type_5">问题平台</a></li>
        </ul>
        <div class="left conlist" id="level_0">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext">
                <?php foreach ($dh_list as $dh) { ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i> <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>

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
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i>  <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
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
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a><span class='doing'> <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i>  <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
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
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'>  <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i> <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
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
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'>  <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i> <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="left conlist" id="level_5" style="display:none;">
            <ul class="conlisttext">
                <?php
                $rev_dh_list = array_reverse($dh_list);
                foreach ($rev_dh_list as $dh) {
                    if ($dh["level"] != 5) {
                        continue;
                    }
                    ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> <span class='doing'> <i class="verify" id="<?php echo $dh['id'] . "#" . $dh['verify']; ?>"></i>  <i class="inspect" id="<?php echo $dh['id'] . "#" . $dh['inspect']; ?>"></i><i class="kc3" id="<?php echo $dh['id']; ?>"></i></span></li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">

    var availableTags =<?php echo $json_names; ?>;
    $("#keywords").autocomplete({
        source: availableTags
    });

    $('#keywords').keypress(function (e) {
        if (e.keyCode === 13) {
            $(".search_ico").click();
        }
    });
    $(".search_ico").click(function () {
        var key = $.trim($("#keywords").val());
        if (key !== "") {
            window.location.href = "admin_list.php?key=" + key;
        } else {
            window.location.href = "admin_list.php";
        }
    });



    $(".pingtai").mousemove(function () {
        var id = $(this).attr("id");
        for (var i = 0; i < 6; i++) {
            $("#level_" + i).hide();
            $("#type_" + i).attr("class", "");
        }

        $("#level_" + id).show();
        $("#type_" + id).attr("class", "current");

    });

    $(".conlisttext").children('li').mouseover(function () {
        $(this).children('.doing').css("display", "inline-block");
    });
    $(".conlisttext").children('li').mouseout(function () {
        $(this).children('.doing').css("display", "none");
    });

    $(".inspect").click(function () {
        var data = $(this).attr("id");
        var strs = new Array();
        strs = data.split("#");
        if (strs[1] !== "") {
            $("#inaddress").val(strs[1]);
        }
        $("#inspect-confirm").dialog({
            resizable: false,
            height: 250,
            width: 300,
            modal: true,
            buttons: {
                "确定": function () {
                    var newaddress = $("#inaddress").val();
                    $.ajax({
                        type: "post",
                        url: 'admin_dbdo.php',
                        dataType: "json",
                        data: {id: strs[0], doing: 'inspect', address: newaddress},
                        success: function (msg) {
                            if (msg === 1) {
                                alert("操作成功");
                                location.reload();
                            } else {
                                alert("操作失败，请联系管理员！");
                            }
                        }
                    });
                },
                "取消": function () {
                    $(this).dialog("close");
                    $("#inaddress").val("");
                }
            }
        });
    });


    $(".verify").click(function () {
        var data = $(this).attr("id");
        var strs = new Array();
        strs = data.split("#");
        if (strs[1] !== "") {
            $("#verifyaddress").val(strs[1]);
        }
        $("#verify-confirm").dialog({
            resizable: false,
            height: 250,
            width: 300,
            modal: true,
            buttons: {
                "确定": function () {
                    var newaddress = $("#verifyaddress").val();
                    $.ajax({
                        type: "post",
                        url: 'admin_dbdo.php',
                        dataType: "json",
                        data: {id: strs[0], doing: 'verify', address: newaddress},
                        success: function (msg) {
                            if (msg === 1) {
                                alert("操作成功");
                                location.reload();
                            } else {
                                alert("操作失败，请联系管理员！");
                            }
                        }
                    });
                },
                "取消": function () {
                    $(this).dialog("close");
                    $("#verifyaddress").val("");
                }
            }
        });
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