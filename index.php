<?php
include 'common/header.php';
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
$sql.=" order by problem_time asc,id asc";
$dh_list_all = array();
$dh_list = array();
$dh_list1 = array();
$dh_list2 = array();
$dh_list3 = array();
$dh_list4 = array();
$dh_list5 = array();
$result = mysql_query($sql, $conn);
while ($row = mysql_fetch_array($result)) {
    $dh_list_all[] = $row;
}
foreach ($dh_list_all as $v) {
    switch ($v['level']) {
        case 1:
            $dh_list1[] = $v;
            break;
        case 2:
            $dh_list2[] = $v;
            break;
        case 3:
            $dh_list3[] = $v;
            break;
        case 4:
            $dh_list4[] = $v;
            break;
        default:
            $dh_list5[] = $v;
    }
    if ($key != '' || $v['level'] != 5) {
        $dh_list[] = $v;
    }
}

$json_string = json_encode($dh_list);
$json_string1 = json_encode($dh_list1);
$json_string2 = json_encode($dh_list2);
$json_string3 = json_encode($dh_list3);
$json_string4 = json_encode($dh_list4);
$json_string5 = json_encode(array_reverse($dh_list5));

$resultnames = mysql_query("SELECT * FROM wdzx_navigation_links", $conn);
while ($row = mysql_fetch_array($resultnames)) {
    $names[] = $row['name'];
}
$json_names = json_encode($names);
?>
<div class="tt">

    <div class="ptlist">	    
        <ul>
            <?php
            $dh_level1 = db_fetch_arrays("select * from wdzx_navigation_links where is_hot=1", $conn);
            $i = 0;
            foreach ($dh_level1 as $dh) {
                ?>	
                <li><a href="<?php echo $dh['url']; ?>" target="_blank" <?php if ($i == 7) { ?>style="border-right:1px solid #cecece"<?php } ?>><img src="images/logo/<?php echo $dh['id']; ?>.png" width="124" height="74" /></a></li>
                <?php
                $i++;
            }
            ?>
            <li style="display:none;"><a href="#" style="border-right:1px solid #cecece"><img src="images/tj_25.jpg" width="124" height="74" /></a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="w1000 mt10">
    <div class="ptlisttitle left">网贷平台导航</div>
    <div class="login"><a href="submit.php">申请加入导航</a></div>

    <ul class="left subcloumn">
        <li><a href="http://www.wdzx.com/about.php?mod=contact">实地考察</a></li>
        <li><a href="http://www.wdzx.com/about.php?mod=contact">视频采访</a></li>
        <li><a href="http://www.wdzx.com/about.php?mod=contact">网贷培训</a></li>
        <li><a href="http://www.wdzx.com/about.php?mod=contact">广告合作</a></li>      
        <li><a href="http://qq.ip138.com/idsearch/" target="_blank">身份证查询</a></li>
        <li><a href="http://www.beianbeian.com/" target="_blank">ICP备案查询</a></li>
        <li><a href="http://www.nacao.org.cn/" target="_blank">组织机构代码查询</a></li>
        <li><a href="http://shixin.court.gov.cn/" target="_blank">老赖黑名单查询</a></li>
        <li><a href="http://gsxt.saic.gov.cn/" target="_blank">工商信息查询</a></li>
    </ul>
    <div class="search_box">
        <label id="kw">关键字：</label>      
        <input id="keywords" type="text" placeholder="请输入平台名称" value="<?php
        if (!empty($key)) {
            echo $key;
        }
        ?>" >
        <input type="button" value="" class="search_ico" />       
    </div>
    <div class="clear"></div>
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

    </div>
    <div class="content">
        <div id="noic">
            提示：
            <img src="images/verify.png">:已入驻
            <img src="images/inspect.png">:已考察
            <img src="images/problem.png">:问题平台
        </div>
        <ul class="left tbalist" style="position:relative;">
            <li onmousemove="level_show(0)"><a href="#" class="current" id="type_0">所有平台</a></li>
            <li onmousemove="level_show(1)"><a href="#" id="type_1">活跃平台</a></li>
            <li onmousemove="level_show(2)"><a href="#" id="type_2">人气平台</a></li>
            <li onmousemove="level_show(3)"><a href="#" id="type_3">成长平台</a></li>
            <li onmousemove="level_show(4)"><a href="#" id="type_4">新平台</a></li>
            <li onmousemove="level_show(5)"><a href="#" id="type_5">问题平台</a></li>
                <!--<span style="position:absolute ;top:285px;left:30px;font-size:12px;color:red;">个</span>--><?php //echo $row[0];                                          ?>
        </ul>
        <div class="left conlist" id="level_0">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext" id="conlisttext_0">
            </ul>
            <div class="clear"></div>
            <div id="pagination_0" class="pagination">
            </div>
        </div>

        <div class="left conlist" id="level_1" style="display:none;">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext" id="conlisttext_1">
            </ul>
            <div class="clear"></div>
            <div id="pagination_1" class="pagination">
            </div>
        </div>

        <div class="left conlist" id="level_2" style="display:none;">
            <div class="clear"></div>

            <div class="clline"></div>
            <ul class="conlisttext" id="conlisttext_2">
            </ul>
            <div class="clear"></div>
            <div id="pagination_2" class="pagination">
            </div>
        </div>

        <div class="left conlist" id="level_3" style="display:none;">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext" id="conlisttext_3">
            </ul>
            <div class="clear"></div>
            <div id="pagination_3" class="pagination">
            </div>
        </div>

        <div class="left conlist" id="level_4" style="display:none;">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext" id="conlisttext_4">
            </ul>
            <div class="clear"></div>
            <div id="pagination_4" class="pagination">
            </div>
        </div>

        <div class="left conlist" id="level_5" style="display:none;">
            <div class="clear"></div>       
            <div class="clline"></div>             
            <ul class="conlisttext" id="conlisttext_5">
            </ul>
            <div class="clear"></div>
            <div id="pagination_5" class="pagination">
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>
<form name="paginationoptions" style="display: none">
    <p><label for="items_per_page">Number of items per page</label><input type="text" value="40" name="items_per_page" id="items_per_page" class="numeric"/></p>
    <p><label for="num_display_entries">Number of pagination links shown</label><input type="text" value="5" name="num_display_entries" id="num_display_entries" class="numeric"/></p>
    <p><label for="num">Number of start and end points</label><input type="text" value="2" name="num_edge_entries" id="num_edge_entries" class="numeric"/></p>
    <p><label for="prev_text">"Previous" label</label><input type="text" value="Prev" name="prev_text" id="prev_text"/></p>
    <p><label for="next_text">"Next" label</label><input type="text" value="Next" name="next_text" id="next_text"/></p>
    <input type="button" id="setoptions" value="Set options" />
</form>
<script type="text/javascript">
    function level_show(id) {
        for (var i = 0; i < 6; i++) {
            $("#level_" + i).hide();
            $("#type_" + i).attr("class", "");
        }

        $("#level_" + id).show();
        $("#type_" + id).attr("class", "current");
    }

    var members =<?php print_r($json_string); ?>;
    var members1 =<?php print_r($json_string1); ?>;
    var members2 =<?php print_r($json_string2); ?>;
    var members3 =<?php print_r($json_string3); ?>;
    var members4 =<?php print_r($json_string4); ?>;
    var members5 =<?php print_r($json_string5); ?>;

    function pageselectCallback(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            if (members[i][8] === "5") {
                newcontent += "<li><a style='color:red;'><font size='3px;'>" + members[i][1] + "</font></a>";
            } else {
                newcontent += "<li><a href='" + members[i][2] + "' target='_blank'><font size='3px;'>" + members[i][1] + "</font></a>";
            }
            if (members[i][10] !== "" && members[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members[i][10] + "','_blank')></i>";
            }
            if (members[i][11] !== "" && members[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members[i][11] + "','_blank')></i>";
            }
            if (members[i][12] !== "" && members[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_0').html(newcontent);
        return false;
    }
    function pageselectCallback1(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members1.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            newcontent += "<li><a href='" + members1[i][2] + "'  target='_blank'><font size='3px;'>" + members1[i][1] + "</font></a>";
            if (members1[i][10] !== "" && members1[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members1[i][10] + "','_blank')></i>";
            }
            if (members1[i][11] !== "" && members1[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members1[i][11] + "','_blank')></i>";
            }
            if (members1[i][12] !== "" && members1[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members1[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_1').html(newcontent);
        return false;
    }

    function pageselectCallback2(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members2.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            newcontent += "<li><a href='" + members2[i][2] + "'  target='_blank'><font size='3px;'>" + members2[i][1] + "</font></a>";
            if (members2[i][10] !== "" && members2[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members2[i][10] + "','_blank')></i>";
            }
            if (members2[i][11] !== "" && members2[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members2[i][11] + "','_blank')></i>";
            }
            if (members2[i][12] !== "" && members2[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members2[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_2').html(newcontent);
        return false;
    }
    function pageselectCallback3(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members3.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            newcontent += "<li><a href='" + members3[i][2] + "'  target='_blank'><font size='3px;'>" + members3[i][1] + "</font></a>";
            if (members3[i][10] !== "" && members3[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members3[i][10] + "','_blank')></i>";
            }
            if (members3[i][11] !== "" && members3[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members3[i][11] + "','_blank')></i>";
            }
            if (members3[i][12] !== "" && members3[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members3[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_3').html(newcontent);
        return false;
    }

    function pageselectCallback4(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members4.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            newcontent += "<li><a href='" + members4[i][2] + "'  target='_blank'><font size='3px;'>" + members4[i][1] + "</font></a>";
            if (members4[i][10] !== "" && members4[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members4[i][10] + "','_blank')></i>";
            }
            if (members4[i][11] !== "" && members4[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members4[i][11] + "','_blank')></i>";
            }
            if (members4[i][12] !== "" && members4[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members4[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_4').html(newcontent);
        return false;
    }

    function pageselectCallback5(page_index, jq) {
        var items_per_page = $('#items_per_page').val();
        var max_elem = Math.min((page_index + 1) * items_per_page, members5.length);
        var newcontent = '';
        for (var i = page_index * items_per_page; i < max_elem; i++)
        {
            newcontent += "<li><a> <font size='3px;'>" + members5[i][1] + "</font></a>";
            if (members5[i][10] !== "" && members5[i][10] !== null) {
                newcontent += "<i class='inspect' onclick=window.open('" + members5[i][10] + "','_blank')></i>";
            }
            if (members5[i][11] !== "" && members5[i][11] !== null) {
                newcontent += "<i class='problem' onclick=window.open('" + members5[i][11] + "','_blank')></i>";
            }
            if (members5[i][12] !== "" && members5[i][12] !== null) {
                newcontent += "<i class='verify' onclick=window.open('" + members5[i][12] + "','_blank')></i>";
            }
            newcontent += "</li>";
        }
        $('#conlisttext_5').html(newcontent);
        return false;
    }


    function getOptionsFromForm() {
        var opt = {callback: pageselectCallback};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }

    function getOptionsFromForm1() {
        var opt = {callback: pageselectCallback1};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }

    function getOptionsFromForm2() {
        var opt = {callback: pageselectCallback2};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }

    function getOptionsFromForm3() {
        var opt = {callback: pageselectCallback3};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }
    function getOptionsFromForm4() {
        var opt = {callback: pageselectCallback4};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }
    function getOptionsFromForm5() {
        var opt = {callback: pageselectCallback5};
        $("input:text").each(function () {
            opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
        });
        var htmlspecialchars = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;"}
        $.each(htmlspecialchars, function (k, v) {
            opt.prev_text = opt.prev_text.replace(k, v);
            opt.next_text = opt.next_text.replace(k, v);
        })
        return opt;
    }

    $(document).ready(function () {
        var optInit = getOptionsFromForm();
        var optInit1 = getOptionsFromForm1();
        var optInit2 = getOptionsFromForm2();
        var optInit3 = getOptionsFromForm3();
        var optInit4 = getOptionsFromForm4();
        var optInit5 = getOptionsFromForm5();
        $("#pagination_0").pagination(members.length, optInit);
        $("#pagination_1").pagination(members1.length, optInit1);
        $("#pagination_2").pagination(members2.length, optInit2);
        $("#pagination_3").pagination(members3.length, optInit3);
        $("#pagination_4").pagination(members4.length, optInit4);
        $("#pagination_5").pagination(members5.length, optInit5);
    });
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
            window.location.href = "index.php?key=" + key;
        } else {
            window.location.href = "index.php";
        }
    });

</script>
<?php include 'common/footer.php'; ?>