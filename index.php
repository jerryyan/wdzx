<?php
include 'common/header.php';
empty($_REQUEST["province"]) ? $province = "" : $province = $_REQUEST["province"];
empty($_REQUEST["initial"]) ? $initial = "" : $initial = $_REQUEST["initial"];
$szm = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$sql = "select * from wdzx_navigation_links  where 1=1 ";
$sql1 = "select count(*) as total from wdzx_navigation_links  where 1=1";
if ($province != '') {
    $sql .= " and province='$province'";
    $sql1 .= " and province='$province'";
}
if ($initial != '') {
    $sql .= " and initial='$initial'";
    $sql1 .= " and initial='$initial'";
}


for ($i = 1; $i <= 5; $i++) {
    $result = db_fetch_array($sql1 . " and level=$i", $conn);
    $total[$i] = $result['total'];
}
$re = db_fetch_array($sql1, $conn);
$total['all'] = $re['total'];

include 'admin/page.php';
$page_size = 30; //每页数量
$p = isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : 1;
$url = $_SERVER['PHP_SELF'] . "?province=" . $province . "&initial=" . $initial . "&p=";

$offset = $p - 1;

foreach ($total as $k => $v) {
    if ($k != 'all') {
        $level = " and level=$k";
    } else {
        $level = " and 2=2 ";
    }
    if ($v > $page_size) {
        $limit = " limit $offset,$page_size";
    } else {
        $limit = " and 3=3";
    }
    $rr = $sql . $level . $limit;
    $dh_list[$k] = db_fetch_arrays($rr, $conn);
}
$subPages = new Page();
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
        <?php $province_list = db_fetch_arrays("SELECT province,COUNT(*) AS total FROM wdzx_navigation_links GROUP BY province ORDER BY total DESC;", $conn); ?>
        <div class="left cllist"><span>地区分类：</span>&nbsp;
            <a href="?initial=<?php echo $initial; ?>&p=<?php echo $p; ?>" <?php if ($province == "") { ?>class="current"<?php } ?>>全部</a>
            <?php foreach ($province_list as $value) { ?>
                <a href="?province=<?php echo $value["province"]; ?>&initial=<?php echo $initial; ?>&p=<?php echo $p; ?>" <?php if ($province == $value["province"]) { ?>class="current"<?php } ?>><?php echo $value["province"]; ?>(<?php echo $value["total"]; ?>)</a>
            <?php } ?>.


        </div>
        <div class="clear"></div>

        <div class="clline"></div>
        <div class="cllist2"><span>字母查找：</span>&nbsp;
            <a href="?province=<?php echo $province; ?>&p=<?php echo $p; ?>" <?php if ($initial == '') { ?>class="current"<?php } ?>>全</a>

            <?php foreach ($szm as $s) { ?>
                <a href="?initial=<?php echo $s; ?>&province=<?php echo $province; ?>&p=<?php echo $p; ?>" <?php if ($initial == $s) { ?>class="current"<?php } ?>><?php echo $s; ?></a>
            <?php } ?>
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
                <!--<span style="position:absolute ;top:285px;left:30px;font-size:12px;color:red;">个</span>--><?php //echo $row[0];      ?>
        </ul>
        <div class="left conlist" id="level_0">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext">
                <?php foreach ($dh_list['all'] as $dh) { ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a> </li>

                <?php } ?>
            </ul>

            <div class="clear"></div>
            <div class="page_list">
                <?php
                if ($total['all'] > $page_size) {
                    $subPages->fenye($page_size, $total['all'], $p, 5, $url, 2);
                }
                ?>
            </div>
        </div>

        <div class="left conlist" id="level_1" style="display:none;">
            <div class="clear"></div>
            <div class="clline"></div>
            <ul class="conlisttext">
                <?php foreach ($dh_list[1] as $dh) { ?>
                    <li><a href="admin_edit.php?id=<?php echo $dh['id']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a></li>
                <?php } ?>
            </ul>  
            <div class="clear"></div>
            <div class="page_list">
                <?php
                if ($total['1'] > $page_size) {
                    $subPages->fenye($page_size, $total['1'], $p, 5, $url, 2);
                }
                ?>
            </div>
        </div>
    </div>

    <div class="left conlist" id="level_2" style="display:none;">
        <div class="clear"></div>
        <div class="clline"></div>
        <ul class="conlisttext">
            <?php
            foreach ($dh_list[2] as $dh) {           
                ?>
                <li><a href="<?php echo $dh['url']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
              <div class="page_list">
                <?php
                if ($total['1'] > $page_size) {
                    $subPages->fenye($page_size, $total['1'], $p, 5, $url, 2);
                }
                ?>
            </div>
    </div>

    <div class="left conlist" id="level_3" style="display:none;">
        <div class="clear"></div>
        <div class="clline"></div>
        <ul class="conlisttext">
            <?php
            foreach ($dh_list[3] as $dh) {
          
                ?>
                <li><a href="<?php echo $dh['url']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
              <div class="page_list">
                <?php
                if ($total['1'] > $page_size) {
                    $subPages->fenye($page_size, $total['1'], $p, 5, $url, 2);
                }
                ?>
            </div>
    </div>

    <div class="left conlist" id="level_4" style="display:none;">
        <div class="clear"></div>
        <div class="clline"></div>
        <ul class="conlisttext">
            <?php
            foreach ($dh_list[4] as $dh) {          
                ?>
                <li><a href="<?php echo $dh['url']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
              <div class="page_list">
                <?php
                if ($total['1'] > $page_size) {
                    $subPages->fenye($page_size, $total['1'], $p, 5, $url, 2);
                }
                ?>
            </div>
    </div>

    <div class="left conlist" id="level_5" style="display:none;">
        <div class="clear"></div>
        <div class="clline"></div>
        <ul class="conlisttext">
            <?php
            $rev_dh_list = array_reverse($dh_list[5]);
            foreach ($rev_dh_list as $dh) {          
                ?>
                <li><a style="color:red;" href="<?php echo $dh['url']; ?>" target="_blank"><font size="3px;"><?php echo $dh['name']; ?></font></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
              <div class="page_list">
                <?php
                if ($total['1'] > $page_size) {
                    $subPages->fenye($page_size, $total['1'], $p, 5, $url, 2);
                }
                ?>
            </div>
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
</script>
<?php include 'common/footer.php'; ?>