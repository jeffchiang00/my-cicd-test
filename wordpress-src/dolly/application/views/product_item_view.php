<?PHP //print_r($product_item)?>
<input type="hidden" name="product_id" value="<?PHP echo $product_id?>">
<input type="hidden" name="price" value="<?PHP echo $price?>">
<div class="prodPage">
    <div class="prodBox">
        <div class="prodImgAll">
            <div class="prodImgAllBigImg">
                <ul>
                    <?PHP if ($product_item[0]['gallery']!==false):?>
                        <?PHP foreach($product_item[0]['gallery'] as $img):?>
                        <li><img src="<?PHP echo IMG_URL . $img['filename']?>" width="450" height="450"/></li>
                        <?PHP endforeach;?>
                    <?PHP endif;?>
                </ul>
            </div>
            <ul>
                <?PHP if ($product_item[0]['gallery']!==false):?>
                    <?PHP foreach($product_item[0]['gallery'] as $img):?>
                <li><a href="#"><img src="<?PHP echo IMG_URL . $img['filename']?>" /></a></li>
                    <?PHP endforeach;?>
                <?PHP endif;?>
            </ul>
        </div>
        <div class="prodForm">
            <div class="prodFormTitle">
                <div class="prodFormTitleA"><?PHP echo $title?></div>
                <div class="prodFormTitleB"><?PHP echo $subtitle?></div>
            </div>
            <div class="prodFormLogo">
                <?PHP if ($brand_logo!==false):?>
                <img src="<?PHP echo IMG_URL . $brand_logo?>" style="width:auto;" />
                <?PHP endif;?>
            </div>
            <div class="prodFormMoney">NT$<span class="prodFormMoneyBig"><?PHP echo number_format($price)?></span></div>
            
            <!-- <div class="prodFormColor">
                <div class="prodFormColorBall_black prodFormColorBallOver"><a href="#">Black</a></div>
                <div class="prodFormColorBall_brown"><a href="#">Brown</a></div>
                <div class="clearDiv"></div>
            </div> -->
            <style>
                .prodFormColor{text-align:center;}
                
                .color_btn .circle{background-color:#fff; width:10px; height:10px;margin:10px;border-radius: 10px; visibility: hidden;}
                .color_btn:hover>.circle{ visibility:visible;}
                .color_btn.active>.circle{ visibility:visible;}
            </style>
            <div class="prodFormColor" style="text-align:center;">
                <?PHP $idx = 0;?>
                <?PHP foreach($product_item as $color):?>
                <div class="color_btn <?PHP echo $idx==0?'active':''?>" style="background:url('<?PHP echo IMG_URL . $color['color_img']?>') center center no-repeat; background-size:cover;">
                    <div class="circle"><input type="hidden" name="color_id" value="<?PHP echo $color['color_id']?>"></div>
                </div>
                <?PHP $idx++;?>
                <?PHP endforeach;?>
            </div>
            <div class="prodFormSizeL">
            <select name="" class="prodFormBox p_size">
              <option value="">SIZE</option>
            </select>
            </div>
            <div class="prodFormSizeR">
                <select name="" class="prodFormBox p_qty">
                <option value="0">ITEMS</option>
                </select>
            </div>
            <div class="clearDiv"></div>
            <div class="prodFormBtn"><a href="#">ADD TO CART</a></div>
			<div class="prodFormBtn2"><a href="<?PHP echo SITE_URL . 'tw/bag'?>">結帳</a></div>
            <div class="prodFormLine"></div>
            <div class="prodFormInfo prodFormLineNone">
                <?PHP echo $description;?>
            </div>
        </div>
        <div class="clearDiv">
        </div>
        <div class="prodBottomLine">
        </div>
        <!-- <div class="prodShare">
            <ul>
                <li><a href="#"><img src="<?PHP echo SITE_URL?>assets/images/prod/share_fb.png" width="100" height="100"></a></li>
                <li><a href="#"><img src="<?PHP echo SITE_URL?>assets/images/prod/share_tiwtter.png" width="100" height="100"></a></li>
                <li><a href="#"><img src="<?PHP echo SITE_URL?>assets/images/prod/share_sin.png" width="100" height="100"></a></li>
            </ul>
        </div> -->
    </div>
    <?PHP echo $template_content;?>
	
	<div class="prodBox">
	<div id="disqus_thread"></div><!--DISQUES-->
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'gapure'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
		
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
	
    <div class="prodBottomBox">
    </div>
</div>
<div class="PageBottomShadow">
</div>
<!--其它相關-->
<?PHP if ($recommand!==false):?>
<div class="newsPageReladte">RELATED</div>
<div class="newsPageReladteList">
    <ul>
        <?PHP $idx=0;?>
        <?PHP foreach($recommand as $item):?>
        <li class="<?PHP echo $idx>0?'newsPageListNone':''?>"><a href="<?PHP echo SITE_URL . $_SESSION['lang']?>/product/item/<?PHP echo $item['id']?>" class="newsPageRelatedBr"><img src="<?PHP echo IMG_URL . $item['filename']?>"></a>
        <div class="nlistTitle fontBold"><?PHP echo nl2br($item['title'])?></div>
        </li>
        <?PHP $idx++;?>
        <?PHP endforeach;?>
    </ul>
    <div class="clearDiv"></div>
</div>
<?PHP endif;?>
<style>

.prodImgAllBigImg{
    overflow-x:hidden !important;
}
@media screen and (max-width: 480px){
    .prodImgAllBigImg{
        overflow-x:scroll;
    }
}
</style>
<script>
var product_item = $.parseJSON('<?PHP echo json_encode($product_item)?>');
$(function(){
    product.color_id = 0;
    product.cart_process = '<?PHP echo SITE_URL . $_SESSION['lang'] . '/ajax/add2cart'?>';
    product.img_url = '<?PHP echo IMG_URL?>';
    product.init();
})

var product = {
    color_id:'',
    cart_process:'',
    img_url:'',
    init:function(){
        //this.set_gallery();
        this.set_size_qty();
        this.set_add2cart();
        this.set_color_click();
    },
    set_gallery:function(){
        $('.prodImgAll ul li a').on('click',function(e){
            e.preventDefault();
            var img = $(this).find('img').attr('src');
            var target = $('.prodImgAllBigImg img');
            target.attr('src',img);
        })

        var img_count = $('.prodImgAllBigImg li').length;
        $('.prodImgAllBigImg ul').css('width',img_count * 150 + '%');

        // $('.prodImgAllBigImg li').swipe({
        //     //Generic swipe handler for all directions
        //     swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
        //         var idx = $(this).index();
        //         switch (direction){
        //             case 'left':
                        
        //                 break;
        //             case 'right':
        //                 if (idx==0) return false;
        //                 break;
        //         }
        //     },
        //     //Default is 75px, set to 0 for demo so any distance triggers swipe
        //     //threshold:0
        // })
        console.log($(window).innerWidth())
        if ($(window).innerWidth()<=320){
            Draggable.create(".prodImgAllBigImg", {type:"scrollLeft", edgeResistance:0.5, throwProps:true});
        }
    },
    set_size_qty:function(){
        var p_size = $('.p_size');
        p_size[0].options.length=1
        var p_qty = $('.p_qty');
        var color_id = parseInt(this.color_id);
        var items = product_item[color_id]['items'];
        for(i=0;i<items.length;i++){
            var disabled = (items[i].qty=='0')?'disabled':'';
            var option = $('<option value="' + items[i].size + '" ' + disabled + '>' + items[i].size + '</option>');
            p_size.append(option);
        }

        p_size.on('change',function(){
            p_qty.empty();
            p_qty.append('<option value="0">ITEMS</option>')
            var size_idx = $(this)[0].selectedIndex;
            if (size_idx==0) return false;
            var size_qty = parseInt(items[size_idx-1].qty);
            var max_qty = size_qty>10?10:size_qty;
            for(i=1;i<=max_qty;i++){
                var option = $('<option value="' + i + '">' + i + '</option>');
                p_qty.append(option);
            }
        }).trigger('change');
    },
    set_add2cart:function(){
        var process_url = this.cart_process;
        var btn = $('.prodFormBtn a');
        btn.on('click',function(e){
            e.preventDefault();
            if ($('.p_size').val()==''){
                site.echo('請選擇尺寸');
                return false;
            }
            if ($('.p_qty').val()=='0'){
                site.echo('請選擇數量');
                return false;
            }
            btn.off('click');
            var p_id = $('input[name="product_id"]').val();
            var p_color = $('.color_btn.active input[name="color_id"]').val();
            var p_price = $('input[name="price"]').val();
            var p_size = $('.p_size').val();
            var p_qty = $('.p_qty').val();
            var q = 'p_id=' + p_id + '&p_color=' + p_color + '&p_price=' + p_price + '&p_size=' + p_size + '&p_qty=' + p_qty + '';
            $.post(process_url,q,function(data){
                product.set_add2cart();
                site.echo('已經加入購物車');
                $('.btn_shop').addClass('hasCartItem')
                $('.btn_shop a').off('click')
            })
        })
    },
    set_color_click:function(){
        $('.color_btn').each(function(){
            $(this).on('click',function(){
                if ($(this).hasClass('active')) return false;
                $('.color_btn').removeClass('active');
                $(this).addClass('active');
                product.color_id = $(this).index();
                product.set_size_qty();
                product.change_gallery();
            })
        })
    },
    change_gallery:function(){
        var gallery = product_item[product.color_id]['gallery'];
        var img = product.img_url + gallery[0]['filename'];
        var target = $('.prodImgAllBigImg img');
        target.attr('src',img);
        $('.prodImgAll li').remove();
        for(i=0;i<gallery.length;i++){
            $('.prodImgAll>ul').append('<li><a href="#"><img src="' + product.img_url + gallery[i]['filename'] + '"></a></li>');
            $('.prodImgAll>.prodImgAllBigImg>ul').append('<li><img src="' + product.img_url + gallery[i]['filename'] + '" width="450" height="450"></li>');
        }
        product.set_gallery();
    }
}
</script>