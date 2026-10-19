<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta property="fb:app_id" content="1720065518209265">
<meta property="fb:admins" content="1531802340" />
<meta property="og:type" content="website" />
<?php
/*
if(preg_match("/\/dolly\/tw\/news\/post\//i", $_SERVER['REQUEST_URI'], $matches)){
    print "A match was found:". $matches[0];
    print "<br>" . $_SERVER['REQUEST_URI'];
} else {
    print "A match was not found.";
}
*/

if(preg_match("/\/dolly\/tw\/news\/post\//i", $_SERVER['REQUEST_URI'], $matches)){
    echo "<meta property='og:title' content='" . nl2br($title) . "'>";
    //ereg_replace("[0-9]","",$string)-->取文字 eregi_replace(">[^<>]+<","><", $string);
    echo "<meta property='og:description' content='" . trim(strip_tags($template_content)) . "'>";
    echo "<meta property='og:image' content='" . IMG_URL . $row['cover_img'] . "'>";
} else {
    echo "<meta property='og:title' content='home'>";
    echo "<meta property='og:description' content='home'>";
    echo "<meta property='og:image' content='http://huli.tw/zb/img/img01.png'>";
}

//preg_match() 函数用于进行正则表达式匹配，成功返回 1 ，否则返回 0 。
   // if( = ){
   //   echo "<meta name='og:title' content='Z>B小遊戲'>";
   //   echo "<meta name='og:description' content='你真的分的清楚Z跟B哪個比較大嗎？趕快來挑戰！'>";
   //   echo "<meta name='og:image' content='http://huli.tw/zb/img/img01.png'>";
   // }
?>






<title>Dolly Website</title>

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

<!-- font awesome -->
<link href="<?PHP echo SITE_URL?>assets/css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/bootstrap.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/animate.css" />
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/set.css" />

<!-- gallery -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/blueimp-gallery.min.css">

<!-- favicon -->
<link rel="shortcut icon" href="<?PHP echo SITE_URL?>assets/img/favicon.jpg" type="image/x-icon">
<link rel="icon" href="<?PHP echo SITE_URL?>assets/img/favicon.jpg" type="image/x-icon">
<link rel="apple-touch-icon" href="<?PHP echo SITE_URL?>assets/img/favicon57.png"> <!-- 57×57px -->
<link rel="apple-touch-icon" sizes="72×72" href="<?PHP echo SITE_URL?>assets/img/favicon72.png"> <!-- 72×72px ipad-->
<link rel="apple-touch-icon" sizes="114×114" href="<?PHP echo SITE_URL?>assets/img/favicon114.png"> <!-- 114×114px iphone4-->

<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/style.css">


</head>

<body>


<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1720065518209265',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  FB.ui(
   {
    method: 'share',
    href: 'https://developers.facebook.com/docs/'
  }, function(response){});
</script>



<!-- Header Starts -->
<div id="home" class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-default navbar-fixed-top menu" role="navigation" id="top-nav">
          <div class="container">
            <div class="navbar-header">
              <!-- Logo Starts -->
              <a class="navbar-brand" target="_self" href="<?PHP echo SITE_URL?>"><img src="<?PHP echo SITE_URL?>assets/img/logo.png" alt="logo"></a>
              <!-- #Logo Ends -->


              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>
            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right scroll">
                 <li><a id="dollipop" style="cursor:pointer;">DOLLIPOP</a></li>
                 <li><a id="about" style="cursor:pointer;">ABOUT</a></li>
                 <li><a id="product" style="cursor:pointer;">PRODUCT</a></li>
                 <li><a class="contact" style="cursor:pointer;">CONTACT</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->
          </div>
        </div>
      </div>
    </div>




    <?PHP echo @$content_view;?>





<!-- Footer Starts -->
<div class="footer text-center spacer col-xs-12">
  <?php if($_SERVER['REQUEST_URI'] == "/dolly/tw/dollipop" || $_SERVER['REQUEST_URI'] == "/dolly/tw/faq"){
      echo "<div class='col-xs-12'>";
      echo "<p><a href='" . SITE_URL . "tw/faq'>FAQ</a></p>";
      echo "</div>";
    } 
    else {}
    ?>
 
  <div class="col-xs-12">
      <a target="_blank" href="https://www.facebook.com/dollycrazylab/?fref=ts" style="margin-left: 8px;"><img class="socialicon fb" src="<?PHP echo SITE_URL?>assets/img/icon-fb.png"></a>
      <a target="_blank" href="https://www.youtube.com/channel/UCxgZd7OuYxa6giJz_W1rheQ"><img class="socialicon yt" src="<?PHP echo SITE_URL?>assets/img/icon-youtube.png"></a>
      <a target="_blank" href="https://www.instagram.com/dolly_shouwu0623/"><img class="socialicon ig" src="<?PHP echo SITE_URL?>assets/img/icon-ig.png"></a>
  </div>
  

  <div class="col-xs-12">
    <p class="mt20">Copyright 2016 Dolly. All rights reserved.</p>
  </div>
</div>
<!-- # Footer Ends -->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>


<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->    
</div>



<!-- jquery -->
<script src="<?PHP echo SITE_URL?>assets/js/jquery-1.8.3.js"></script>

<!-- wow script -->
<script src="<?PHP echo SITE_URL?>assets/js/wow.min.js"></script>


<!-- boostrap -->
<script src="<?PHP echo SITE_URL?>assets/js/bootstrap.js" type="text/javascript" ></script>

<!-- jquery mobile -->
<script src="<?PHP echo SITE_URL?>assets/js/touchSwipe.min.js"></script>
<script src="<?PHP echo SITE_URL?>assets/js/respond.js"></script>

<!-- gallery -->
<script src="<?PHP echo SITE_URL?>assets/js/jquery.blueimp-gallery.min.js"></script>


<!-- custom script -->
<script src="<?PHP echo SITE_URL?>assets/js/script.js"></script>


<script>
$(document).ready(function(){     
  $(".watch_border").mouseenter(function(){
      $(this).css('border-color','#EC94BC'); 
      $(this).children(".imdolly1").animate({
        marginTop:"0px"
      },"fast");
  });
  $(".watch_border").mouseleave(function(){
      $(this).css('border-color','#ffffff'); 
      $(this).children(".imdolly1").animate({
        marginTop:"-70px"
      },"fast");
  });

  $(".watch_border2").mouseenter(function(){
      $(this).css('border-color','#EC94BC'); 
      $(this).children(".imdolly1").animate({
        marginTop:"0px"
      },"fast");
  });
  $(".watch_border2").mouseleave(function(){
      $(this).css('border-color','rgb(123, 123, 123)'); 
      $(this).children(".imdolly1").animate({
        marginTop:"-70px"
      },"fast");
  });

  //MENU變色
  if (location.pathname == "/dolly/tw/videos"){
    $('#videos').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/news"){
    $('#news').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/dollipop"){
    $('#dollipop').parent('li').addClass("active");
  }
  //CONOTACT
  $('#about').click(function(){ $('html,body').animate({scrollTop:$('.move_to_about').offset().top}, 1000); });
  $('#product').click(function(){ $('html,body').animate({scrollTop:$('.move_to_product').offset().top}, 1000); });
  if (location.pathname == "/dolly/tw" || location.pathname == "/dolly/tw/"){
    $('.contact').click(function(){ $('html,body').animate({scrollTop:$('.move_to_contact').offset().top}, 1000); });
    $('#news').click(function(){ $('html,body').animate({scrollTop:$('.move_to_news').offset().top}, 1000); });
    $('#videos').click(function(){ $('html,body').animate({scrollTop:$('.move_to_videos').offset().top}, 1000); });
    $('#dollipop').click(function(){ $('html,body').animate({scrollTop:$('.move_to_dollipop').offset().top}, 1000); });
  }
  else{
    $('.contact').attr("href","http://gapure.com/dolly/tw?x=contact");
    $('#news').attr("href","http://gapure.com/dolly/tw/news");
    $('#videos').attr("href","http://gapure.com/dolly/tw/videos");
    $('#dollipop').attr("href","http://gapure.com/dolly/tw/dollipop");
  }
  b = window.location.search;
  if (b == '?x=contact'){
    $(document).ready(function(){
      $('html,body').animate({scrollTop:$('.move_to_contact').offset().top}, 1000); 
    });
  }
 

  //LIST頁分類變色
  if (location.pathname == "/dolly/tw/news" || location.pathname == "/dolly/tw/videos"){
    $('.color_pink').css('borderBottom','3px solid #EC94BC');
  }
  else if (location.pathname == "/dolly/tw/news/hotnews" || location.pathname == "/dolly/tw/videos/class1"){
    $('.color1').css('borderBottom','3px solid #b7e0df');
  }
  else if (location.pathname == "/dolly/tw/news/stories" || location.pathname == "/dolly/tw/videos/class2"){
    $('.color2').css('borderBottom','3px solid #BE77E8');
  }
  else if (location.pathname == "/dolly/tw/news/reports" || location.pathname == "/dolly/tw/videos/class3"){
    $('.color3').css('borderBottom','3px solid #e1e8f6');
  }

  //news_viewmore置中
  adj_width = $('.news_viewmore').parent('div').width() / 2;
  $('.news_viewmore').css('left', adj_width-110);
 


  //讓VIDEO MORE跟前面一樣高
  video_height = $('.effect-oscar:first').height();
  $('.video_more').height(video_height);
  //VIEWMORE置中
  video_more_amt = video_height/2 - 30;
  $('.video_more_a').css('marginTop',video_more_amt);

  //watch_button跳出
  windows_width = $(window).width();
  youtube_popout_iframe_width = windows_width * 0.6;
  $('.youtube_popout_iframe').css('width',youtube_popout_iframe_width);
  iframe_height = youtube_popout_iframe_width * 0.575 ;
  $('.youtube_popout_iframe').height(iframe_height);
  $('.youtube_popout_iframe').css('marginTop','100px');
  $('.watch_button').click(function(){
    a = "https://www.youtube.com/embed/JwVi4GuYct4?rel=0&autoplay=1";
    $(".youtube_popout .youtube_popout_iframe").attr("src",a);
    $('.youtube_popout').fadeIn();
  });
  $('.youtube_popout').click(function(){
    $('.youtube_popout').fadeOut();
    $(".youtube_popout .youtube_popout_iframe").attr("src","");
  });

  
  

  //NEWS youtube跳出
  $(".viewmore").click(function(){
     x = $(this).find("figcaption");
     y = x.find(".youtube_url").text();
     z = "https://www.youtube.com/embed/" + y + "?rel=0&autoplay=1";
     $(".news_youtube_popout .youtube_popout_iframe").attr("src",z);
     $(".news_youtube_popout").fadeIn();
  });

  $(".news_youtube_popout").click(function(){
      $(".news_youtube_popout").fadeOut();
      $(".news_youtube_popout .youtube_popout_iframe").attr("src","");
  });

  //第一個新聞加上ACTIVE
  $('div.item').first().addClass('active');
  //NEWS LIST 調整高度
  postbody_h = $(".postbody").height();
  nextprenews_paddingtop = (postbody_h - 30)/2;
  $(".prenews").css("paddingTop",nextprenews_paddingtop);
  $(".nextnews").css("paddingTop",nextprenews_paddingtop);
  
  //IOS ANDROID切換
  $("#android").click(function(){
    $("#android").addClass("active");
    $("#ios").removeClass("active");
    $("#ios_div").fadeOut(function(){
      $("#android_div").fadeIn();
    });
    
  });
  $("#ios").click(function(){
    $("#ios").addClass("active");
    $("#android").removeClass("active");
    $("#android_div").fadeOut(function(){
      $("#ios_div").fadeIn();       
    });
  });
  //ABOUT
  $('.about_block').children('div').mouseenter(function(){
        $(this).children('div').children('.question').hide();
        $(this).children('div').children('.ans').show();
  });
  $('.about_block').children('div').mouseleave(function(){
        $(this).children('div').children('.ans').hide();
        $(this).children('div').children('.question').show();
  });

  //調整dollipop BTN剛進來的顏色
  $('.btn-pink').css({'background':'#EC94BC','color':'#fff'});

  $('.btn-pink').click(function(){
     $('.btn-pink').css({'background':'#EC94BC','color':'#fff'});
     $('.btn-purple').css({'background':'#fff','color':'#d7a2d7'});
     $('.btn-green').css({'background':'#fff','color':'#5abfb5'});
     $('.faq_content1').show();
     $('.faq_content2').hide();
     $('.faq_content3').hide();

     $('.dollipop1').css('background-image', 'url(<?php echo SITE_URL; ?>assets/img/dollipop-01.png)');
     $('.dollipop1').find('h2').first().text('Dollipop');
     $('.dollipop1').find('h2').first().next().text('醫美級美白保濕面膜');
     $('.dollipop2').css('background-image', 'url(<?php echo SITE_URL; ?>assets/img/dollipop-02.png)');
     $('.dollipop2').find('h2').first().text('極致美白');
     $('.dollipop2').find('h2').first().next().text('獨特柔軟面膜材質能緊密包覆肌膚');
     $('.dollipop2').find('h2').first().next().next().text('促進美白、保濕精華滲透肌底');
     $('.dollipop2').find('h2').first().next().next().next().text('有效解決暗沈、乾燥、缺乏彈性等問題');
     $('.dollipop2').find('h2').first().next().next().next().next().text('使肌膚重現亮白光澤');
     $('.dollipop3').css('background-image', 'url(<?php echo SITE_URL; ?>assets/img/dollipop-03.png)');
     $('.dollipop3').find('h2').first().text('透薄、服貼');
     $('.dollipop3').find('h2').first().next().text('選用輕薄且吸收力好的蠶絲材質');
     $('.dollipop3').find('h2').first().next().next().text('觸感如絲綢般光滑');
     $('.dollipop3').find('h2').first().next().next().next().text('給肌膚更呵護的面膜SPA體驗');
     $('.dollipop4').css('background-image', 'url(<?php echo SITE_URL; ?>assets/img/dollipop-04.png)');
     $('.dollipop4').find('h2').first().text('長效保濕');
     $('.dollipop4').find('h2').first().next().text('天然鎖水精華，有效舒緩不適');
     $('.dollipop4').find('h2').first().next().next().text('避免乾燥脫皮，保持肌膚彈性');
     $('.dollipop5').css('background-image', 'url(<?php echo SITE_URL; ?>assets/img/dollipop-05.png)');
     $('.dollipop5').find('h2').first().text('給妳最純淨的呵護');
  });
  $('.btn-green').click(function(){
     $('.btn-green').css({'background':'#5abfb5','color':'#fff'});
     $('.btn-pink').css({'background':'#fff','color':'#EC94BC'});
     $('.btn-purple').css({'background':'#fff','color':'#d7a2d7'});
     $('.faq_content1').hide();
     $('.faq_content2').show();
     $('.faq_content3').hide();
     
     $('.dollipop1').css('background-image', 'url(http://oeimg2.cache.oeeee.com/201311/08/527c4cca3c54f.jpg)');
     $('.dollipop1').find('h2').first().text('Dolly禮物盒');
     $('.dollipop1').find('h2').first().next().text('Dolly禮物盒敘述2');
     $('.dollipop2').css('background-image', 'url(http://oeimg2.cache.oeeee.com/201311/08/527c4cca3c54f.jpg)');
     $('.dollipop2').find('h2').first().text('Dolly禮物盒');
     $('.dollipop2').find('h2').first().next().text('Dolly禮物盒敘述2');
     $('.dollipop3').css('background-image', 'url(http://oeimg2.cache.oeeee.com/201311/08/527c4cca3c54f.jpg)');
     $('.dollipop3').find('h2').first().text('Dolly禮物盒');
     $('.dollipop3').find('h2').first().next().text('Dolly禮物盒敘述2');
     $('.dollipop4').css('background-image', 'url(http://oeimg2.cache.oeeee.com/201311/08/527c4cca3c54f.jpg)');
     $('.dollipop4').find('h2').first().text('Dolly禮物盒');
     $('.dollipop4').find('h2').first().next().text('Dolly禮物盒敘述2');
     $('.dollipop5').css('background-image', 'url(http://oeimg2.cache.oeeee.com/201311/08/527c4cca3c54f.jpg)');
     $('.dollipop5').find('h2').first().text('Dolly禮物盒');
     $('.dollipop5').find('h2').first().next().text('Dolly禮物盒敘述2');
  });
  $('.btn-purple').click(function(){
     $('.btn-purple').css({'background':'#d7a2d7','color':'#fff'});
     $('.btn-pink').css({'background':'#fff','color':'#EC94BC'});
     $('.btn-green').css({'background':'#fff','color':'#5abfb5'});
     $('.faq_content1').hide();
     $('.faq_content2').hide();
     $('.faq_content3').show();
  });

  //調整ABOUT BTN剛進來的顏色
  $('.change_makeup').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
  $('.change_makeup').click(function(){
      $('.change_makeup').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
      $('.change_dolly').css({'border-bottom':'0px','color':'#666'});
      $('.change_dolly_div').fadeOut("fast",function(){
          $('.change_makeup_div').fadeIn("fast");
      });
  });
  $('.change_dolly').click(function(){
      $('.change_dolly').css({'border-bottom':'2px solid #b7e0df','color':'#b7e0df'});
      $('.change_makeup').css({'border-bottom':'0px','color':'#666'});
      $('.change_makeup_div').fadeOut("fast",function(){
          $('.change_dolly_div').fadeIn("fast");
      });
  });

  //dollipop滾動換圖
  $('.dollipop0').mouseenter(function(){
    $(window).scroll(function(){
        //$('html, body').scrollTop(0);   
        $(".dollipop0-1").fadeIn();
        $(".dollipop_h4title2").fadeIn();
    }); 
  });//navbar

  
  $("#about").parent().mouseenter(function(){
    $("#about").text("品牌介紹");
  });
  $("#about").parent().mouseleave(function(){
    $("#about").text("ABOUT");
  });
  $("#news").parent().mouseenter(function(){
    $("#news").text("最新消息");
  });
  $("#news").parent().mouseleave(function(){
    $("#news").text("NEWS");
  });
  $("#videos").parent().mouseenter(function(){
    $("#videos").text("影片");
  });
  $("#videos").parent().mouseleave(function(){
    $("#videos").text("VIDEOS");
  });
  $("#dollipop").parent().mouseenter(function(){
    $("#dollipop").text("朵莉帕");
  });
  $("#dollipop").parent().mouseleave(function(){
    $("#dollipop").text("DOLLIPOP");
  });
  $(".contact").parent().mouseenter(function(){
    $(".contact").text("聯絡我們");
  });
  $(".contact").parent().mouseleave(function(){
    $(".contact").text("CONTACT");
  });
  $("#product").mouseenter(function(){
    $("#product").text("產品");
  });
  $("#product").mouseleave(function(){
    $("#product").text("PRODUCT");
  });

  $(".fb").mouseenter(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon2-fb.png");
  });
  $(".fb").mouseleave(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon-fb.png");
  });
  $(".yt").mouseenter(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon2-youtube.png");
  });
  $(".yt").mouseleave(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon-youtube.png");
  });
  $(".ig").mouseenter(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon2-ig.png");
  });
  $(".ig").mouseleave(function(){
    $(this).attr("src","http://gapure.com/dolly/assets/img/icon-ig.png");
  });

});
</script>

</body>
</html>