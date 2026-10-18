
<?php 
  if($_SERVER['PHP_SELF'] == "/dolly/index.php/tw/news/class1"){
    $old = "class1_old";
  }
  else if ($_SERVER['PHP_SELF'] == "/dolly/index.php/tw/news/class2"){
    $old = "class2_old";
  }
  else if ($_SERVER['PHP_SELF'] == "/dolly/index.php/tw/news/class3"){
    $old = "class3_old";
  }
  else{
    $old = "old";
}

?>






<div class="newsList">
  <div class="col-md-12 mt155 mb30">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 catogory text-center">
          <span class="color_pink"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news">ALL</a></span>
          <span class="color1"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/class1">NEWS</a></span>
          <!--span class="color2"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/class2">STORIES</a></span-->
          <span class="color3"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/class3">EVENTS</a></span>
      </div>
      <div class="col-md-3">
        <div class="row catogory text-right">
           <span><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/">新→舊</a></span>
           <span><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/<?php echo $old; ?>">舊→新</a></span>
         </div>
      </div>
    </div>
  </div>

    <ul>
        <?PHP 
        $idx = 0;
        foreach($rs as $row){
            switch($idx){
                case 0:
                    $li_class = 'bigNews';
                    $img_class = 'nlistImgBig';
                    break;
                case 3:
                    $li_class = 'bigNews';
                    $img_class = 'nlistImgBig';
                    break;
                case 4:
                    $li_class = 'deHeight';
                    $img_class = 'nlistImg';
                    break;
                case 5:
                    $li_class = 'deHeight deWidth';
                    $img_class = 'nlistImg';
                    break;
                default:
                    $li_class = '';
                    $img_class = 'nlistImg';
                    break;
            }

            if (!$is_page_1){
                $li_class = '';
                $img_class = 'nlistImg';
            }

            $article_date = strtotime($row['article_date']);

            switch($language_sort[0][0]){
                case 'en':
                    $title = nl2br($row['title_en']);
                    break;
                case 'tw':
                    $title = nl2br($row['title_tw']);
                    break;
                case 'cn':
                    $title = nl2br($row['title_cn']);
                    break;
            }
        ?>
        <li class="<?PHP echo $li_class?>">
            <a class="post_list_border_bottom<?PHP echo $row['small_type_id'];?>" href="<?PHP echo SITE_URL?>tw/news/post/<?PHP echo $row['id']?>">
                <div class="<?PHP echo $img_class?>"><img src="<?PHP echo IMG_URL . $row['cover_img']?>" /></div>
                <table border="0" class="post_list_table mt20">
                  <tbody>
                    <tr>
                      <td class="text-center month"><?PHP echo strtoupper(date('M',$article_date))?></td>
                      <td rowspan="2" class="title"><?PHP echo $title?></td>
                    </tr>
                    <tr><td class="text-center date"><?PHP echo date('d',$article_date)?></td></tr>
                    
                  </tbody>
                </table>

              
            </a>
        </li>
        <?PHP
            $idx++;
        }
        ?>

    </ul>
</div>

<div class="col-xs-12" style="height:70px;">

</div>
<script src="<?PHP echo SITE_URL?>assets/js/jquery.infinitescroll.js"></script>
<script>
$(function(){
    $('.newsList ul').infinitescroll({
      debug:true,
      loading: {
        finished: undefined,
        finishedMsg: "",
        img: "",
        msg: null,
        msgText: "",
        selector: null,
        speed: 'fast',
        start: undefined
      },
      state: {
        isDuringAjax: false,
        isInvalidPage: false,
        isDestroyed: false,
        isDone: false, // For when it goes all the way through the archive.
        isPaused: false,
        currPage: 1
      },
      behavior: undefined,
      binder: $(window), // used to cache the selector for the element that will be scrolling
      nextSelector: "div.navigation a:first",
      navSelector: "div.navigation",
      //contentSelector: null, // rename to pageFragment
      extraScrollPx: 150,
      itemSelector: ".newsList ul li",
      animate: false,
      pathParse: undefined,
      dataType: 'html',
      appendCallback: true,
      bufferPx: 40,
      errorCallback: function () { },
      infid: 0, //Instance ID
      pixelsFromNavToBottom: undefined,
      path: undefined, // Can either be an array of URL parts (e.g. ["/page/", "/"]) or a function that accepts the page number and returns a URL
      maxPage:undefined // to manually control maximum page (when maxPage is undefined, maximum page limitation is not work)
    });

    $('.btn_mainMenuW:eq(2)').addClass('active');

    <?PHP if (isset($news_tag_idx)):?>
    $(".newsTag li").removeClass("newsTagOver");
    $(".newsTag li:eq(<?PHP echo $news_tag_idx?>)").addClass("newsTagOver")
    $(".newsTag li span").hide();
    $(".newsTag li.newsTagOver span").css({
      'display':'block',
      'height':'3px',
      'margin-top':'-3px'
    });
    <?PHP endif;?>
})
</script>


<!-- works

<div class="clearfix grid col-md-12 mh700">
    <div class="container"> 
      <?PHP 
        $idx = 0;
        foreach($rs as $row){
            $article_date = strtotime($row['article_date']);
            $title = nl2br($row['title_tw']);   
      ?>
      <div class="col-md-4" style="padding:15px;">
        <a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/news/post/<?PHP echo $row['id'] ?>"><figure class="effect-oscar  wowload fadeIn">
            <img src="<?PHP echo IMG_URL . $row['cover_img']?>" alt="img01"/>
            <figcaption class="pop_out">      
                <h2><?PHP echo date('M',$article_date) . " " .  date('d',$article_date)?></h2>
                <hr class="colorpost<?php echo $row['small_type_id']; ?>"></hr>
                <h2><?PHP echo $title?></h2>        
            </figcaption>
        </figure></a>
      </div>
     <?php } ?>

     <div class="news_youtube_popout">
        <div>
          <iframe class="youtube_popout_iframe" frameborder="0" allowfullscreen></iframe>
        </div>
      </div> 

    
  
    
 
    

    </div> 
</div>
works -->


