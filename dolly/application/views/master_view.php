

<meta charset="UTF-8" />

<title>Dolly Website</title>

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>


<!-- bootstrap -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/bootstrap.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/animate.css" />
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/set.css" />

<!-- gallery -->
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/blueimp-gallery.min.css">

<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/css/news.css">

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
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/zh_TW/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

function share(){
    FB.ui({
    method: 'share_open_graph',
    action_type: 'og.likes',
    action_properties: JSON.stringify({
      object:'https://developers.facebook.com/docs/',
    })
  }, function(response){
    // Debug response (optional)
    console.log(response);
  });
}
    
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
                 <li><a id="about" href="<?PHP echo SITE_URL?>tw/about" style="cursor:pointer;">ABOUT</a></li>
                 <li><a id="news" style="cursor:pointer;">NEWS</a></li>
                 <li><a id="videos" style="cursor:pointer;">VIDEOS</a></li>
                 <li><a id="dollipop" style="cursor:pointer;">DOLLIPOP</a></li>
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
 
  <!--div class="col-xs-12">
      <a target="_blank" href="https://www.facebook.com/dollyshouwu0623" style="margin-left: 8px;"><img class="socialicon fb" src="<?PHP echo SITE_URL?>assets/img/icon-fb.png"></a>
      <a target="_blank" href="https://www.youtube.com/channel/UCxgZd7OuYxa6giJz_W1rheQ"><img class="socialicon yt" src="<?PHP echo SITE_URL?>assets/img/icon-youtube.png"></a>
      <a target="_blank" href="https://www.instagram.com/dolly_shouwu0623/"><img class="socialicon ig" src="<?PHP echo SITE_URL?>assets/img/icon-ig.png"></a>
  </div-->
  

  <div class="col-xs-12">
    <p class="mt20">Copyright 2020 Dolly. All rights reserved.</p>
  </div>
</div>
<!-- # Footer Ends -->
<a class="gototop"><i class="fa fa-angle-up  fa-3x"></i></a>


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
$(window).resize(function() {
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
    $('.gototop').click(function(){ $('html,body').animate({scrollTop:$('body').offset().top}, 1000); });
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
  //分類變色
  if (location.pathname == "/dolly/tw/videos" ){
    $('#videos').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/news"){
    $('#news').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/dollipop"){
    $('#dollipop').parent('li').addClass("active");
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
  var viewportwidth = window.innerWidth;
  var viewportheight = window.innerHeight;
  windows_width = $(window).width();
  if(viewportwidth <= 767){
    youtube_popout_iframe_width = windows_width;
  }
  else{
    youtube_popout_iframe_width = windows_width * 0.6;
  }
  
  $('.youtube_popout_iframe').css('width',youtube_popout_iframe_width);
  iframe_height = youtube_popout_iframe_width * 0.58125 ;
  $('.youtube_popout_iframe').height(iframe_height);
  middlevideo = (viewportheight - iframe_height)/2;
  $('.youtube_popout_iframe').css('marginTop',middlevideo);
  $('.closex').css('top',middlevideo-50);
  $('.watch_button').click(function(){
    a = "https://www.youtube.com/embed/gnUqymhWR3M?rel=0&autoplay=1";
    $(".youtube_popout .youtube_popout_iframe").attr("src",a);
    $('.youtube_popout').fadeIn();
  });
  $('.youtube_popout').click(function(){
    $('.youtube_popout').fadeOut();
    $(".youtube_popout .youtube_popout_iframe").attr("src","");
  });

  //VIDEOS 影片寬高
  iframe_videos_height = $('.youtube_videos_iframe').width() * 0.575 ;
  $('.youtube_videos_iframe').height(iframe_videos_height);


  
  

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
    $("#android").addClass("activebtn");
    $("#ios").removeClass("activebtn");
    $("#ios_div").fadeOut(function(){
      $("#android_div").fadeIn();
    });
    
  });
  $("#ios").click(function(){
    $("#ios").addClass("activebtn");
    $("#android").removeClass("activebtn");
    $("#android_div").fadeOut(function(){
      $("#ios_div").fadeIn();       
    });
  });
  //ABOUT
  $('.about_block').children('div').mouseenter(function(){
        $(this).children('div').children('.question').hide();
        $(this).children('div').children('p').show();
        adj_ans_height = (173 - $(this).children('div').children('p').height())/2;
        $(this).children('div').css('marginTop',adj_ans_height);
  });
  $('.about_block').children('div').mouseleave(function(){
        $(this).children('div').children('p').hide();
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
  });
  $('.btn-green').click(function(){
     $('.btn-green').css({'background':'#5abfb5','color':'#fff'});
     $('.btn-pink').css({'background':'#fff','color':'#EC94BC'});
     $('.btn-purple').css({'background':'#fff','color':'#d7a2d7'});
     $('.faq_content1').hide();
     $('.faq_content2').show();
     $('.faq_content3').hide();
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
  $('.change5').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
  $('.change5').click(function(){
      $('.change5').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
      $('.change6').css({'border-bottom':'0px','color':'#666'});
      $('.change6_div').fadeOut("fast",function(){
          $('.change5_div').fadeIn("fast");
      });
  });
  $('.change6').click(function(){
      $('.change6').css({'border-bottom':'2px solid #b7e0df','color':'#b7e0df'});
      $('.change5').css({'border-bottom':'0px','color':'#666'});
      $('.change5_div').fadeOut("fast",function(){
          $('.change6_div').fadeIn("fast");
      });
  });
  //調整影片縮圖高度
    adjheight = $("figure.effect-oscar").width() * 0.648;
    $("figure.effect-oscar").height(adjheight);

   

  $("#about").parent().mouseenter(function(){
    $("#about").text("關於朵莉");
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
  $("p.address").mouseenter(function(){
    $("p.address").text("台北市中山區松江路123號");
  });
  $("p.address").mouseleave(function(){
    $("p.address").text("No.123 SongKiang RD, ZongShan Dist, Taipei 104, Taiwan");
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

$(document).ready(function(){

  //表單提教
  $('.form-horizontal').submit(function(){
            $('.thx').fadeIn('fast', function() {
                  var count = 5;
                  setInterval(function() {
                      count--;
                      if (count <= 0) $('.thx').fadeOut(function(){
                        $('#inputname').val("");
                        $('#inputemail').val("");
                        $('#inputphone').val("");
                        $('#inputmessage').val("");
                      });
                  }, 1000); 
            });
  });

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
    $('.gototop').click(function(){ $('html,body').animate({scrollTop:$('body').offset().top}, 1000); });
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
  //分類變色
  if (location.pathname == "/dolly/tw/videos" ){
    $('#videos').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/news"){
    $('#news').parent('li').addClass("active");
  }
  else if (location.pathname == "/dolly/tw/dollipop"){
    $('#dollipop').parent('li').addClass("active");
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
  var viewportwidth = window.innerWidth;
  var viewportheight = window.innerHeight;
  windows_width = $(window).width();
  if(viewportwidth <= 767){
    youtube_popout_iframe_width = windows_width;
  }
  else{
    youtube_popout_iframe_width = windows_width * 0.6;
  }
  
  $('.youtube_popout_iframe').css('width',youtube_popout_iframe_width);
  iframe_height = youtube_popout_iframe_width * 0.58125 ;
  $('.youtube_popout_iframe').height(iframe_height);
  middlevideo = (viewportheight - iframe_height)/2;
  $('.youtube_popout_iframe').css('marginTop',middlevideo);
  $('.closex').css('top',middlevideo-50);
  $('.watch_button').click(function(){
    a = "https://www.youtube.com/embed/gnUqymhWR3M?rel=0&autoplay=1";
    $(".youtube_popout .youtube_popout_iframe").attr("src",a);
    $('.youtube_popout').fadeIn();
  });
  $('.youtube_popout').click(function(){
    $('.youtube_popout').fadeOut();
    $(".youtube_popout .youtube_popout_iframe").attr("src","");
  });

  //VIDEOS 影片寬高
  iframe_videos_height = $('.youtube_videos_iframe').width() * 0.575 ;
  $('.youtube_videos_iframe').height(iframe_videos_height);


  
  

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
    $("#android").addClass("activebtn");
    $("#ios").removeClass("activebtn");
    $("#ios_div").fadeOut(function(){
      $("#android_div").fadeIn();
    });
    
  });
  $("#ios").click(function(){
    $("#ios").addClass("activebtn");
    $("#android").removeClass("activebtn");
    $("#android_div").fadeOut(function(){
      $("#ios_div").fadeIn();       
    });
  });
  //ABOUT
  $('.about_block').children('div').mouseenter(function(){
        $(this).children('div').children('.question').hide();
        $(this).children('div').children('p').show();
        adj_ans_height = (173 - $(this).children('div').children('p').height())/2;
        $(this).children('div').css('marginTop',adj_ans_height);
  });
  $('.about_block').children('div').mouseleave(function(){
        $(this).children('div').children('p').hide();
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
  });
  $('.btn-green').click(function(){
     $('.btn-green').css({'background':'#5abfb5','color':'#fff'});
     $('.btn-pink').css({'background':'#fff','color':'#EC94BC'});
     $('.btn-purple').css({'background':'#fff','color':'#d7a2d7'});
     $('.faq_content1').hide();
     $('.faq_content2').show();
     $('.faq_content3').hide();
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
  $('.change5').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
  $('.change5').click(function(){
      $('.change5').css({'border-bottom':'2px solid #EC94BC','color':'#EC94BC'});
      $('.change6').css({'border-bottom':'0px','color':'#666'});
      $('.change6_div').fadeOut("fast",function(){
          $('.change5_div').fadeIn("fast");
      });
  });
  $('.change6').click(function(){
      $('.change6').css({'border-bottom':'2px solid #b7e0df','color':'#b7e0df'});
      $('.change5').css({'border-bottom':'0px','color':'#666'});
      $('.change5_div').fadeOut("fast",function(){
          $('.change6_div').fadeIn("fast");
      });
  });
  //調整影片縮圖高度
    adjheight = $("figure.effect-oscar").width() * 0.648;
    $("figure.effect-oscar").height(adjheight);

   

  $("#about").parent().mouseenter(function(){
    $("#about").text("關於朵莉");
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
  $("p.address").mouseenter(function(){
    $("p.address").text("台北市中山區松江路123號");
  });
  $("p.address").mouseleave(function(){
    $("p.address").text("No.123 SongKiang RD, ZongShan Dist, Taipei 104, Taiwan");
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