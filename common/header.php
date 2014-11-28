<?php include 'db.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P2P网贷平台导航_网贷平台排名_网贷中心P2P平台</title>
<meta name="keywords" content="网贷平台排名 p2p平台排名 p2p导航 网贷平台哪个好 网贷平台导航 网贷平台评级" />
<meta name="description" content="网贷平台排名 p2p平台排名 p2p导航 网贷平台哪个好 网贷平台导航 网贷平台评级" />
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.2/jquery-ui.min.css"/>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery-ui-1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
            // 设置为主页
            function SetHome(obj, vrl) {
                try {
                    obj.style.behavior = 'url(#default#homepage)';
                    obj.setHomePage(vrl);
                }
                catch (e) {
                    if (window.netscape) {
                        try {
                            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        }
                        catch (e) {
                            alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage', vrl);
                    } else {
                        alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入：" + vrl + "点击确定。");
                    }
                }
            }
            // 加入收藏 兼容360和IE6
            function shoucang(sTitle, sURL)
            {
                try
                {
                    window.external.addFavorite(sURL, sTitle);
                }
                catch (e)
                {
                    try
                    {
                        window.sidebar.addPanel(sTitle, sURL, "");
                    }
                    catch (e)
                    {
                        alert("加入收藏失败，请使用Ctrl+D进行添加");
                    }
                }
            }
        </script> 
</head>

<body>
<div id="header">
  <div class="w1000">
    <div class="swsy left"><a href="javascript:void(0)" onclick="SetHome(this, window.location)">把网贷中心设为主页</a></div>
    <div class="swsy right"><a href="javascript:void(0)" onclick="shoucang(this, window.location)">加入收藏夹</a></div>
    <p class="left" style="display:none"><strong>网贷指数：</strong>成交 <span>1118.9</span>&nbsp;&nbsp;利率 <span>13.37</span>&nbsp;&nbsp;人气 <span>1.42</span></p>
    <div class="clear"></div>
  </div>
</div>
<div class="w1000 top">
  <div class="logo left"><a href="/"><img src="images/logo_07.jpg" width="235" height="64" /></a></div>
  <div class="search right">
    <ul class="left">
      <li><a href="http://www.wdzx.com/" target="_blank">新闻</a></li>
      <li><a href="http://www.wdzx.com/portal.php?mod=list&catid=18" target="_blank">数据</a></li>
      <li><a href="http://www.wdzx.com/portal.php?mod=list&catid=14" target="_blank">视频</a></li>
      <li><a href="http://www.wdzx.com/plugin/dianping.html" target="_blank">评级</a></li>
      <li><a href="http://bbs.wdzx.com/forum.php" target="_blank">社区</a></li>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>