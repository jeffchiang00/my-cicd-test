
    <!--最新消息內頁-->
    <div class="newsPage">
	    <div class="newsPageHead">
	        <div class="newsPageHeadTime"><?PHP echo strtoupper(date('M',$article_date));?></div>
	        <div class="newsPageHeadDay"><?PHP echo date('d',$article_date)?></div>
	        <div class="newsPageHeadTag"><?PHP echo $type_title;?></div>
	        <div class="newsPageHeadTitle"><?PHP echo nl2br($title);?></div>
	        <div class="newsPageHeadTitleLine"></div>
	    </div>
        <?PHP echo @$template_content;?>
        <div class="newsPageNow">
            <div class="newsPageNowPrev"><?PHP echo $prev_title[0]?></div>
            <div class="newsPageNowNext"><?PHP echo $next_title[0]?></div>
            <div class="newsPageNowBack"><a href="<?PHP echo SITE_URL . $_SESSION['lang'] . '/article'?>">Back</a></div>
            <div class="newsPageNowLTitle"><?PHP echo $prev_title[1]?></div>
            <div class="newsPageNowRTitle"><?PHP echo $next_title[1]?></div>
        </div>
        <div class="newsForCode">
            <div class="newsForCodeCont">
                <div id="disqus_thread"></div>
                    <script>
                    /**
                    * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
                    */
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');

                    s.src = '//gapure.disqus.com/embed.js';

                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            </div>
        </div>
    </div>
    <div class="PageBottomShadow"></div>
    <?PHP if ($recommand!==false):?>
    <div class="newsPageReladte">RELATED</div>
    <div class="newsPageReladteList">
        <ul>
            <?PHP $idx=0;?>
            <?PHP foreach($recommand as $item):?>
            <li class="<?PHP echo $idx>0?'newsPageListNone':''?>"><a href="<?PHP echo SITE_URL . $_SESSION['lang']?>/article/post/<?PHP echo $item['id']?>" class="newsPageRelatedBr"><img src="<?PHP echo IMG_URL . $item['cover_img']?>"></a>
            <div class="nlistTitle fontBold"><?PHP echo nl2br($item['title'])?></div>
            </li>
            <?PHP $idx++;?>
            <?PHP endforeach;?>
        </ul>
    	<div class="clearDiv"></div>
	</div>
    <?PHP endif;?>