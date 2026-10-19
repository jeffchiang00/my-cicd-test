<div class="col-md-2 prenews mt160 hidden-xs hidden-sm">
    <table border="0">
        <tr>
            <td class="text-right"><?PHP echo $prev_title[1]?></td>
        </tr>
    </table>
</div>

<div class="col-md-8 postbody mt160">
        <div class="mb100 floatleft">
            <table border="0" class="floatleft newsPage">
                <tr><td class="newsPageHeadTime"><?PHP echo strtoupper(date('M',$article_date));?></td><td class="newsPageHeadTag color_bg<?PHP echo $small_type_id;?>"><?PHP echo $type_title;?></td><td rowspan="2"><div class="newsPageHeadTitleLine"></div></td></tr>
                <tr><td class="newsPageHeadDay"><?PHP echo date('d',$article_date)?></td><td></td></tr>
            </table>
            <div class="newsPageHeadTitle"><?PHP echo nl2br($title);?></div>
        </div>
        

        <?php
        //var_dump(empty($youtube_url));
            if(empty($youtube_url) == false){
                echo "<iframe class='youtube_videos_iframe' style='width:100%;' src='https://www.youtube.com/embed/" . $youtube_url . "' frameborder='0' allowfullscreen></iframe>";
            }
        ?>
        

        <?PHP echo @$template_content;?>

        <table border="0" style="margin:15px;clear:both;">
        <tr>
            <td><div class="fb-share-button" data-href="<?PHP echo SITE_URL . 'tw/news/post/' . $id; ?>" data-layout="button_count" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">分享</a></div>
            </td>
            <td class="hidden-lg hidden-md" style="padding-left:20px;"><a href="http://line.naver.jp/R/msg/text/?<?PHP echo SITE_URL . 'tw/news/post/' . $id; ?>"><img height="22" src="<?PHP echo SITE_URL?>assets/img/line.png"></a></td>
        </tr>
    </table>
        
        
</div>

<div class="col-md-2 nextnews mt160 hidden-xs hidden-sm">
    <table border="0">
        <tr>
            <td><?PHP echo $next_title[1]?></td>
        </tr>
    </table>
</div>

<div class="col-md-8 col-md-offset-2 text-center">
    <h4>RELATED</h4>
</div>

<div class="clearfix grid col-md-12">

    <div class="row"> 
        <?PHP if ($recommand!==false):?>
                    <?PHP
                        foreach($recommand as $row):
                    ?>
                <div class="col-md-4">
                    <div class="row">
                        <a href="<?PHP echo SITE_URL?>tw/<?PHP echo $post_type; ?>/post/<?PHP echo $row['id'] ?>"><figure class="effect-oscar  wowload fadeIn">
                          <div class="figure_black"></div>
                          <img src="<?PHP echo IMG_URL . $row['cover_img']?>" alt="img01"/>
                          <figcaption class="pop_out">
                              <h2><?PHP echo date('M',$article_date) . " " .  date('d',$article_date)?></h2>
                              <hr class="colorpost<?php echo $row['small_type_id']; ?>"></hr>
                              <h2><?PHP echo $row['title_tw']?></h2>
                              <p class="youtube_url"><?php echo $row['youtube_url'];?></p> 
                          </figcaption>
                        </figure></a>
                    </div>
                </div>
                    <?PHP endforeach;?>
        <?PHP endif;?>
    </div>
</div>
