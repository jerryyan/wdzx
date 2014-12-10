<?php
include '../common/admin_header.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = "select * from wdzx_navigation_submit where id=" . $_REQUEST["id"];
    $submitrow = db_fetch_array($sql, $conn);
} else { 
        $id = $_POST["id"];
        $name = $_POST['name'];
        $url = $_POST['url'];
        $province = $_POST['province'];
        $addtime = time();
        if (($name != '') && ($url != '') && ($province != '')) {
            $sql = "update wdzx_navigation_submit set name='$name',url='$url',province='$province' where id=$id";
            $ret = mysql_query($sql, $conn);
            if ($ret)
                echo "<script>alert('修改成功');window.location.href='admin_submit_list.php'</script>";
        }   
        exit();
}
?>

<div class="subline"></div>
<div class="w1000" style="margin-top: 60px; padding-bottom: 70px">
    <div class="left subtable">
        <form action="admin_submit_edit.php" method="post" onsubmit="return checkinfo();">
            <input name="id"  type="hidden"   value="<?php echo $submitrow['id']; ?>" /></td>
            <table width="510" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="109" class="tbtitle"><span>*</span>网站名称：</td>
                    <td width="401"><input name="name" id="name" type="text" class="subinput"  value="<?php echo $submitrow['name']; ?>" /></td>
                </tr>               
                <tr>
                    <td class="tbtitle"><span>*</span>网站地址：</td>
                    <td><input name="url" id="url" type="text" class="subinput" value="<?php echo $submitrow['url']; ?>" /></td>
                </tr>             
                <tr>
                    <td width="109" class="tbtitle"><span>*</span>省份：</td>
                    <td width="401"><input name="province" id="province" type="text" class="subinput" value="<?php echo $submitrow['province']; ?>" /></td>
                </tr>         
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" class="subbtn" value="提交修改" />

                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        function checkinfo() {
            var name = document.getElementById('name').value;
            var url = document.getElementById('url').value;
            var province = document.getElementById('province').value;
            if (name == '' || url == '' || province == '' || year == '' || link_qq == '') {
                alert('*号为必填项');
                return false;
            }
        }

        $(function () {
            $("#year").datepicker();

        });
    </script>
    <div class="left zs">1.带有 <span>*</span> 的为必填项，请认真填写。<br />
        2.网站简介和logo地址为选填项，但需注意，只有填 写了网站简介才有机会申请图文链接；只有填写了
        logo地址才有机会申请图片链接，但最终的链接类型 还取决于本站的设置。<br />
        3.申请链接请先在贵站的首页做好本站的友情链接。<br />
        4.本站只与PR>=2的网站交换链接，不符合条件者请 勿提交</div>
    <div class="clear"></div>
</div>
<?php include '../common/footer.php'; ?>