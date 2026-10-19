<!-- #Header Starts -->
<div class="col-md-12">
      <div class="row text-center" style="overflow:hidden;">
        <video class="hidden-xs hidden-sm" loop="loop" autoplay="autoplay" style="margin-top:2px;width: 100%;">
          <source src="<?PHP echo SITE_URL?>assets/img/demo.mp4" type="video/mp4">
        </video>
        <img class="hidden-lg hidden-md altimg" src="<?PHP echo SITE_URL?>assets/img/altimg.jpg">
        <div class="abs w100p h100p home_video"> 
          <div class="watch" style="margin-left:-110px;">
             <a class="watch_button" href="#"><div class="watch_border">
                <div class="imdolly1">
                  <img src="<?PHP echo SITE_URL?>assets/img/imdolly.png">
                  <img style="margin-top:20px;" src="<?PHP echo SITE_URL?>assets/img/imdolly_white.png">
                </div>
             </div></a>
          </div>
                <div class="youtube_popout">
                  <div>
                    <iframe class="youtube_popout_iframe" frameborder="0" allowfullscreen></iframe>
                    <div class="closex"></div>
                  </div>
                </div>
        </div>
      </div>
</div>


<div class="col-md-12 text-center slider move_to_news">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <h2 class="pink news_title">NEWS</h2>
            <hr class="news_hr">
  <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <a class="inlineblock news_viewmore" href="<?PHP echo SITE_URL?>tw/news"><div class="watch_border2 text-center">
          <div class="imdolly1">
            <img src="<?PHP echo SITE_URL?>assets/img/more.png"><br>
            <img style="margin-top:20px;" src="<?PHP echo SITE_URL?>assets/img/more_gray.png">
          </div>
        </div></a>
          
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            
            <?PHP 
              foreach($rs as $row){
            ?>
            <div class="item">
              <table border="0" class="news_table" style="margin-top:70px;height: 270px;">
                  <?php $article_date = strtotime($row['article_date']);$small_type_name = $row['small_type_name']; ?>
                  <tr>
                    <td class="news_table_td1"><div class="news_day"><?PHP echo strtoupper(date('M',$article_date));?> <?PHP echo date('d',$article_date)?></div></td>
                    <td rowspan="2" style="padding-left:30px;border-left:2px solid #7a7a7a;"><a href="<?PHP echo SITE_URL?>news/post/<?php echo $row['id']; ?>"><h2><?php echo $row['title_tw']; ?></h2></a></td>
                  </tr>
                  <tr><td class="text-left" style="padding-top: 9px;"><span class="news_small_type color_bg<?PHP echo $row['small_type_id'];?>"><?PHP echo $small_type_name;?></span></td></tr>
              </table>
            </div>
            <?php } ?>
          </div>  
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a> 
      </div>
</div>
<!-- Cirlce Starts
<div class="col-md-12 home1 text-center">
      <img class="wowload fadeInUp animated" height="116" src="<?PHP echo SITE_URL?>assets/img/dolly/news_black.png" />
      <h3 class="fs14 pd40 wowload fadeInUp animated">最新消息： 《 守屋教你化HONEY仿妝 》</h3>
</div>
#Cirlce Ends -->




<!-- works -->
<div class=" clearfix grid col-md-12 move_to_videos">
  <div class="row"> 
    <?PHP 
      foreach($rs2 as $row2){
        $article_date = strtotime($row2['article_date']);
        $title = nl2br($row2['title_tw']); 
    ?>
    <div class="col-md-4">
      <div class="row">
        <figure class="effect-oscar  wowload fadeIn">
              <img src="<?PHP echo IMG_URL . $row2['cover_img']?>" alt="$title"/>
              <a class="viewmore"><figcaption class="pop_out">
                    <h2><?PHP echo date('M',$article_date) . " " .  date('d',$article_date)?></h2>
                    <hr class="colorpost<?php echo $row2['small_type_id']; ?>"></hr>
                    <h2><?PHP echo $title?></h2>
                    <p class="youtube_url"><?php echo $row2['youtube_url'];?></p>  
              </figcaption></a>
          </figure>
      </div>
    </div>
    <?php } ?>

      <div class="news_youtube_popout">
        <div>
          <iframe class="youtube_popout_iframe" frameborder="0" allowfullscreen></iframe>
        </div>
      </div> 
     <div class="col-md-12 bg_white">
      <div class="row text-center">
            <a class="inlineblock" href="<?PHP echo SITE_URL?>tw/videos"><div class="watch_border2 text-center">
              <div class="imdolly1">
                <img src="<?PHP echo SITE_URL?>assets/img/more.png"><br>
                <img style="margin-top:20px;" src="<?PHP echo SITE_URL?>assets/img/more_gray.png">
              </div>
            </div></a>
      </div> 
      </div>
    </div> 
</div>
<!-- works -->

<!-- About Starts -->
<div class="highlight-info col-md-12 move_to_dollipop">
  <div class="overlay spacer row">
    <div class="container text-center">
      <h2 class="titleh2">挖 。 掘</h2>
      <p class="fs16">welcome to dolly’s Dream House</p>
      <p class="fs16">一起打開dolly夢幻小屋的門，開啟變美的旅程吧!</p>
      <div class="text-center mt50">
          <a class="inlineblock" href="<?PHP echo SITE_URL?>tw/dollipop"><div class="watch_border text-center">
                  <div class="imdolly1">
                    <img src="<?PHP echo SITE_URL?>assets/img/dollipop.png">
                    <img style="margin-top:20px;" src="<?PHP echo SITE_URL?>assets/img/dollipop_white.png">
                  </div>
          </div></a>
      </div>
    </div>
  </div>
</div>
<!-- About Ends -->





<!-- Cirlce Starts -->
<div class="col-md-12 home1 text-center">
  <h2 class="titleh2 text-center wowload fadeInUp">ADD DOLLY TO YOUR PHONE</h2>
  <p class="wowload fadeInUp">把守屋加到你的手機裡面吧!</p>
          <div id="ios" class="watch_border3 inlineblock text-center activebtn wowload fadeInUp">
              <h4>iOS</h4>
          </div>
          <div id="android" class="watch_border3 inlineblock text-center wowload fadeInUp">
              <h4>Android</h4>
          </div>
  <div id="ios_div" class="container">
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor1.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor2.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor3.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor4.png">
      </div>
  </div>

  <div id="android_div" class="container">
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor1.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor2.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor3.png">
      </div>
      <div class="col-md-3 col-xs-6 mt50">
        <img class="w100p" src="<?PHP echo SITE_URL?>assets/img/tutor4.png">
      </div>
  </div>

  <!--div class="process">
  <h3 class="text-center wowload fadeInUp">Process</h3>
  <ul class="row text-center list-inline  wowload bounceInUp">
      <li>
            <span><i class="fa fa-history"></i><b>Research</b></span>
        </li>
        <li>
            <span><i class="fa fa-puzzle-piece"></i><b>Plan</b></span>
        </li>
        <li>
            <span><i class="fa fa-database"></i><b>Develop</b></span>
        </li>
        <li>
            <span><i class="fa fa-magic"></i><b>Integration</b></span>
        </li>        
        <li>
            <span><i class="fa fa-cloud-upload"></i><b>Deliver</b></span>
        </li>
    </ul>
  </div-->
</div>
<!-- #Cirlce Ends -->



<!-- About Starts -->
<div class="highlight-contact col-md-12 text-center">
  <div class="overlay spacer row">
    
    <!--p class="wowload fadeInUp">喜歡DOLLY嗎?趕快跟我聯絡吧!</p-->
      <div class="col-md-7 col-md-offset-1">


        <div class="col-md-4 row text-left wowload fadeInUp keepbtm">
          <h2 class="titleh2 wowload fadeInUp">CONTACT</h2>
          <h4>★</h4>
          <p class="contactp">歡迎任何合作洽談或邀稿，來信請附上企劃書、品牌或產品的詳細介紹，我將會儘快回覆訊息並竭誠地為您服務。</a></p>
         
        </div>


      

        <div class="col-md-6 col-xs-10 col-xs-offset-1 row wowload fadeInUp">
          <form class="form-horizontal text-left move_to_contact">
            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="inputname" placeholder="Name" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="email" class="form-control" id="inputemail" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="inputphone" placeholder="Phone" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <textarea rows="4" class="form-control" id="inputmessage" placeholder="Message" required></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-12 text-center">
                <button style="width:125px;" type="submit" class="btn btn-dolly">SEND</button>
              </div>
            </div>
          </form>
        </div>

        
        </div>



      </div>
</div>
<!-- About Ends -->