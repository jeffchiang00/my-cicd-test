<style>
figure.effect-oscar{
  overflow: hidden;
}
.postmd4{padding: 15px;}
@media (max-width: 767px) {
  div.post_body, .grid, .postmd4{padding: 0px;}
}

</style>
<?php 
$type_id = substr($_SERVER['PHP_SELF'], -1);
if(is_numeric($type_id) == true){
  $old = "type_old/" . $type_id;
}
else $old = "old";
?>




<!-- works -->
<div class="clearfix grid col-md-12 mh700">
    <div class="container post_body"> 
        <div class="col-md-12 mt155 mb30">
          <div class="row">
              <div class="col-md-6 col-md-offset-3 catogory text-center">
                  <span class="color_pink"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos">ALL</a></span>
                  <span class="color1"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/1">MAKEUP</a></span>
                  <span class="color2"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/2">DRAWING</a></span>
                  <span class="color3"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/3">SO CRAZY</a></span>
                  <span class="color4"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/4">LIVE</a></span>
                  <span class="color5"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/5">LIFESTYLE</a></span>
                  <span class="color6"><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/type/6">HAIR</a></span>
              </div>
              <div class="col-md-3">
                <div class="row text-right catogory">
                  <span><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/">新→舊</a></span>
                  <span><a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/<?php echo $old; ?>">舊→新</a></span>
                </div>
              </div>
            </div>
        </div>

      <?PHP 
        $idx = 0;
        foreach($rs as $row){
            $article_date = strtotime($row['article_date']);
            $title = nl2br($row['title_tw']);   
      ?>
      <div class="col-md-4 postmd4">
        <a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/videos/post/<?PHP echo $row['id'] ?>"><figure class="effect-oscar  wowload fadeIn">
            <div class="figure_black"></div>
            <img src="<?PHP echo IMG_URL . $row['cover_img']?>" alt="img01"/>
            <figcaption class="pop_out">
                
                <h2><?PHP echo date('M',$article_date) . " " .  date('d',$article_date)?></h2>
                <hr class="colorpost<?php echo $row['small_type_id']; ?>"></hr>
                <h2><?PHP echo $title?></h2>
                <p class="youtube_url"><?php echo $row['youtube_url'];?></p> 
                          
            </figcaption>
        </figure></a>
      </div>
     <?php  $idx++; } ?>

     <div class="news_youtube_popout">
        <div>
          <iframe class="youtube_popout_iframe" frameborder="0" allowfullscreen></iframe>
        </div>
      </div> 



    </div> 
</div>
<div class="col-md-12" style="height:70px;">

</div>

<script src="<?PHP echo SITE_URL?>assets/js/jquery.infinitescroll.js"></script>
<script>
$(document).ready(function(){     
    $('.container').infinitescroll({
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
      navSelector : "#next:last",
      nextSelector : "a#next:last",
      //nextSelector: "div.navigation a:first",
      //navSelector: "div.navigation",
      //contentSelector: null, // rename to pageFragment
      extraScrollPx: 150,
      itemSelector: ".col-md-4",
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
    
/*
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
    <?PHP endif;?>*/
})
</script>
<!-- works -->


