<?php include '../common/admin_header.php'; ?>
<?php
if (!empty($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
} else {
    echo "<script>alert('没有id');</script>";
    exit();
}
$pt = db_fetch_array("SELECT * FROM wdzx_navigation_links where id=$id;", $conn);
empty($_REQUEST["name"]) ? $name = "" : $name = $_REQUEST["name"];
empty($_REQUEST["url"]) ? $url = "" : $url = $_REQUEST["url"];
empty($_REQUEST["initial"]) ? $initial = "" : $initial = $_REQUEST["initial"];
empty($_REQUEST["level"]) ? $level = "" : $level = $_REQUEST["level"];
empty($_REQUEST["province"]) ? $province = "" : $province = $_REQUEST["province"];
empty($_REQUEST["is_hot"]) ? $is_hot = 0 : $is_hot = $_REQUEST["is_hot"];
$time = date("Y-m-d H:i:s");
if ($name != '' && $url != '' && $initial != '' && $level != '' && $province != '') {
    $is_name = db_fetch_array("SELECT name FROM wdzx_navigation_links where id!={$id} and name='$name';", $conn);
    if (!empty($is_name)) {
        echo "<script>alert('网站名称已存在，请重新填写');widndow.location.href;</script>";
    } else {
        if ($level != 5) {
            mysql_query("update wdzx_navigation_links set name='$name',url='$url',initial='$initial',level=$level,province='$province',is_hot=$is_hot, where id=$id", $conn);
        } else {
            mysql_query("update wdzx_navigation_links set name='$name',url='$url',initial='$initial',level=$level,province='$province',problem_time='$time' where id=$id", $conn);
        }
        echo "<script>alert('修改成功');window.location.href='admin_list.php';</script>";
    }
}
?>
<div class="subline"></div>
<div class="w1000" style="margin-top: 60px; padding-bottom: 70px">
    <div class="left subtable">
        <form action="admin_edit.php" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <table width="510" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>网站名称：</td>
                    <td width="401"><input name="name" id="name" type="text" class="subinput" value="<?php echo $pt['name']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>URL：</td>
                    <td width="401"><input name="url" id="url" type="text" class="subinput" value="<?php echo $pt['url']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>


                <tr>
                    <td width="109" class="tbtitle"><span>*</span>首字母：</td>
                    <td width="401"><input name="initial" id="initial" type="text" class="subinput" value="<?php echo $pt['initial']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>是否推荐：</td>
                    <td width="401">
                        <select id="is_hot" name="is_hot">
                            <option value="0" <?php if ($pt['is_hot'] == 0) {
    echo 'selected';
} ?>>不推荐</option>
                            <option value="1" <?php if ($pt['is_hot'] == 1) {
    echo 'selected';
} ?>>推荐</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>级别：</td>
                    <td width="401">
                        <select id="level" name="level">
                            <option value="1" <?php if($pt['level']==1){ echo "selected='selected'"; } ?>>活跃平台</option>
                            <option value="2" <?php if($pt['level']==2){ echo "selected='selected'"; } ?>>人气平台</option>
                            <option value="3" <?php if($pt['level']==3){ echo "selected='selected'"; } ?>>成长平台</option>
                            <option value="4" <?php if($pt['level']==4){ echo "selected='selected'"; } ?>>新平台</option>
                            <option value="5" <?php if($pt['level']==5){ echo "selected='selected'"; } ?>>问题平台</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>省份：</td>
                    <td width="401"><input name="province" id="province" type="text" class="subinput" value="<?php echo $pt['province']; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>


                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="subbtn" value="提交申请" /><input
                            name="" type="reset" class="subbtn" value="重新输入" /></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="left zs">1.带有 <span>*</span> 的为必填项，请认真填写。<br />
        2.网站简介和logo地址为选填项，但需注意，只有填 写了网站简介才有机会申请图文链接；只有填写了
        logo地址才有机会申请图片链接，但最终的链接类型 还取决于本站的设置。<br />
        3.申请链接请先在贵站的首页做好本站的友情链接。<br />
        4.本站只与PR>=2的网站交换链接，不符合条件者请 勿提交</div>
    <div class="clear"></div>
</div>
<?php include '../common/footer.php'; ?>