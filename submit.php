<?php
include 'common/header.php';
$name = isset($_REQUEST["name"]) && !empty($_REQUEST['name']) ? $_REQUEST['name'] : "";
$url = isset($_REQUEST["url"]) && !empty($_REQUEST['url']) ? $_REQUEST['url'] : "";
$logo_url = isset($_REQUEST["logo_url"]) && !empty($_REQUEST['logo_url']) ? $_REQUEST['logo_url'] : "";
$link_qq = isset($_REQUEST["link_qq"]) && !empty($_REQUEST['link_qq']) ? $_REQUEST['link_qq'] : "";
$summary = isset($_REQUEST["summary"]) && !empty($_REQUEST['summary']) ? $_REQUEST['summary'] : "";
$province = isset($_REQUEST["province"]) && !empty($_REQUEST['province']) ? $_REQUEST['province'] : "";
$year = isset($_REQUEST["year"]) && !empty($_REQUEST['year']) ? $_REQUEST['year'] : "";
$addtime = time();
if (($name != '') && ($url != '') && ($summary != '')) {
    $sql = "insert into wdzx_navigation_submit(name,url,logo_url,link_qq,summary,province,year,add_time) values('{$name}','{$url}','{$logo_url}','{$link_qq}','{$summary}','{$province}','{$year}', $addtime)";
    $ret = mysql_query($sql, $conn);
    if ($ret)
        echo "<script>alert('提交成功！请等待审核');</script>";
    //echo $sql;
}
?>

<div class="subline"></div>
<div class="w1000" style="margin-top: 60px; padding-bottom: 70px">
    <div class="left subtable">
        <form action="submit.php" method="post" onsubmit="return checkinfo();">
            <table width="510" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="109" class="tbtitle"><span>*</span>网站名称：</td>
                    <td width="401"><input name="name" id="name" type="text" class="subinput" placeholder="如：网贷中心" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：网贷中心</td>
                </tr>
                <tr>
                    <td class="tbtitle"><span>*</span>网站地址：</td>
                    <td><input name="url" id="url" type="text" class="subinput" placeholder="如：http://www.wdzx.com" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="lr">如：http://www.wdzx.com</td>
                </tr>
                <tr>
                    <td class="tbtitle">LOGO地址：</td>
                    <td><input name="logo_url" id="logo_url" type="text" class="subinput" placeholder="如：http://www.wdzx.com/static/image/common/logo.png" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="lr">如：http://www.wdzx.com/static/image/common/logo.png</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>省份：</td>
                    <td width="401"><input name="province" id="province" type="text" class="subinput" placeholder="如：广东" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="lr">如：广东</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>上线年份：</td>
                    <td width="401"><input name="year" id="year" type="text" class="subinput" placeholder="如：2014-06-26" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="lr">如：2014-06-26</td>
                </tr>

                <tr>
                    <td width="109" class="tbtitle"><span>*</span>联系人QQ：</td>
                    <td width="401"><input name="link_qq" id="link_qq" type="text" class="subinput" placeholder="如：12345678" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="lr">如：12345678</td>
                </tr>

                <tr>
                    <td class="tbtitle">网站简介：</td>
                    <td><textarea name="summary" id="summary" cols="" rows="" class="subwb" placeholder="如：网站简介...." ></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" class="subbtn" value="提交申请" />
                        <input type="reset" class="subbtn" value="重新输入" /></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        function checkinfo() {
            var name = document.getElementById('name').value;
            var url = document.getElementById('url').value;
            var province = document.getElementById('province').value;
            var year = document.getElementById('year').value;
            var link_qq = document.getElementById('link_qq').value;
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
<?php include 'common/footer.php'; ?>