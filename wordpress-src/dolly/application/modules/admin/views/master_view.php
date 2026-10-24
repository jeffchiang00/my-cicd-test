<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- <link rel="shortcut icon" href="<?PHP echo SITE_URL?>assets/admin/css/icon.ico" type="image/x-icon" /> -->
    <link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/admin/css/pure-min.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/admin/css/theme.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL;?>assets/admin/css/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL;?>assets/admin/css/font-awesome/css/font-awesome-ie7.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL;?>assets/admin/css/font-awesome-4.2.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL;?>assets/admin/css/jquery-ui.css">
    <link rel="stylesheet" href="<?PHP echo SITE_URL;?>assets/admin/css/style.css">
    <script src="<?PHP echo SITE_URL?>assets/admin/js/jquery-1.11.0.min.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/admin/js/jquery-ui.min.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/admin/js/jquery.form.min.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/admin/js/ckeditor/ckeditor.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/admin/js/ckeditor/adapters/jquery.js"></script>
    <script src="<?PHP echo SITE_URL;?>assets/admin/js/jquery.fileupload.js"></script>
    <script src="<?PHP echo SITE_URL;?>assets/admin/js/jquery.autosize.js"></script>
    <script src="<?PHP echo SITE_URL;?>assets/admin/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/admin/css/jquery.Jcrop.css">
    <script src="<?PHP echo SITE_URL?>assets/admin/js/site.js"></script>
    <title>
        <?PHP echo (!isset($page_title))?ADMIN_SITE_TITLE:$page_title;?>
    </title>
    <script>
    $(function(){
        <?PHP if (strlen($menu_selected)):?>
        $("#menu").find(".<?PHP echo $menu_selected?>").addClass("pure-menu-selected");
        <?PHP endif;?>
    });
    </script>

</head>

<body>
    <div id="layout">
        <!-- Menu toggle -->
        <a href="#menu" id="menuLink" class="menu-link">
            <!-- Hamburger icon -->
            <span></span>
        </a>
        <div id="menu">
            <div class="pure-menu pure-menu-open">
                <a class="pure-menu-heading" href="<?PHP echo ADMIN_URL;?>">
                    <?PHP echo SITE_TITLE;?>
                </a>
                <ul>
                    <?PHP foreach($menu as $menu_item):?>
                    <li class="<?PHP echo $menu_item['url']?>">
                        <a href="<?PHP echo ADMIN_URL?>module/<?PHP echo $menu_item['url']?>"><?PHP echo $menu_item['title']?></a>
                        <?PHP if(count($menu_item['sub'])):?>
                        <i class="icon-chevron-right icon-right"></i>
                        <ul class="pure-menu-children">
                            <?PHP foreach($menu_item['sub'] as $sub):?>
                            <li><a href="<?PHP echo ADMIN_URL?>module/<?PHP echo $menu_item['url']?>/<?PHP echo $sub['url']?>"><?PHP echo $sub['title']?></a></li>
                            <?PHP endforeach;?>
                        </ul>
                        <?PHP endif;?>
                    </li> 
                    <?PHP endforeach;?>
                    <!-- <li class="accounts">
                        <a href="<?PHP echo ADMIN_URL?>module/accounts">帳號管理</a>
                    </li>
                    <li class="index">
                        <a href="<?PHP echo ADMIN_URL?>module/index_banner">首頁管理</a>
                    </li> 
                    <li class="news">
                        <a href="<?PHP echo ADMIN_URL?>module/article">文章管理</a>
                        <i class="icon-chevron-right icon-right"></i>
                        <ul class="pure-menu-children">
                            <li><a href="<?PHP echo ADMIN_URL?>article/news">新聞列表</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>article/story">故事列表</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>article/press">媒體報導列表</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>article/privacy">隱私權頁面</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>article/guide">使用條款</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>article/faq">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="product">
                        <a href="<?PHP echo ADMIN_URL?>product/list">商品管理</a>
                        <i class="icon-chevron-right icon-right"></i>
                        <ul class="pure-menu-children">
                            <li><a href="<?PHP echo ADMIN_URL?>product/list">商品列表</a></li>
                            <li><a href="<?PHP echo ADMIN_URL?>product/brand">品牌</a></li>
                        </ul>
                    </li>
                    <li class="member">
                        <a href="<?PHP echo ADMIN_URL?>member">會員管理</a>
                    </li>
                    <li class="member">
                        <a href="<?PHP echo ADMIN_URL?>purchase">訂單管理</a>
                    </li>-->
                    <li class=" menu-item-divided">
                        <a href="<?PHP echo ADMIN_URL?>logout">登出</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="main">
            <div class="content">
                <?PHP echo @$content_view;?>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="<?PHP echo SITE_URL?>assets/admin/js/ui.js"></script>
</html>
