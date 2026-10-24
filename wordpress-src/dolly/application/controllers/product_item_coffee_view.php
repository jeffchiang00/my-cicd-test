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
                <?PHP $idx = 0;?>
                <?PHP foreach($product_item as $color):?>
                <div class="color_btn <?PHP echo $idx==0?'active':''?>" style="display:none;background:url('<?PHP echo IMG_URL . $color['color_img']?>') center center no-repeat; background-size:cover;">
                    <div class="circle"><input type="hidden" name="color_id" value="<?PHP echo $color['color_id']?>"></div>
                </div>
                <?PHP $idx++;?>
                <?PHP endforeach;?>
            </div>
            <div class="prodFormLogo">
                <?PHP if ($brand_logo!==false):?>
                <img src="<?PHP echo IMG_URL . $brand_logo?>" style="width:auto;" />
                <?PHP endif;?>
            </div>
            <div class="prodFormMoney">
                NT$<span class="prodFormMoneyBig"><?PHP echo number_format($price)?></span>
            </div>
            <div class="prodFormSelect">
                <div class="prodFormSelectL">
                    <div class="prodFormSelectTitle">
                        風 味
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">花 香</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">柑 橋</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">蜂 蜜</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">堅 果</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">焦 糖</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                    <div class="prodFormSelectShow">
                        <span class="prodFormSelectShowT">巧克力</span>
                        <ul>
                            <li class="SelectOver">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                </div>
                <div class="prodFormSelectC">
                </div>
                <div class="prodFormSelectR">
                    <div class="prodFormSelectTitle">
                        自 訂
                    </div>
                    <div class="prodFormSelectUL">
                        <ul>
                            <li><a href="#">更多花果香</a></li>
                            <li class="SelectULOver"><a href="#">預設風味</a></li>
                            <li class="nobgline"><a href="#">更多蜂蜜香</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="prodFormInfo">
                <?PHP echo $description;?>
            </div>
            <div class="prodFormBtn">
                <a href="#">ADD TO CART</a>
            </div>
			<div class="prodFormBtn2">
                <a href="http://gapure.com/ming/tw/bag">結帳</a>
            </div>
        </div>
        <div class="clearDiv">
        </div>
        <div class="prodBottomLine">
        </div>
    </div>
    <?PHP echo $template_content;?>
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
        //this.set_size_qty();
        this.set_add2cart();
        //this.set_color_click();
        $('.prodFormSelectUL ul').empty();
        if (product_item[product.color_id]['items'][1]){
            $('.prodFormSelectUL ul').append('<li><a href="1">'+product_item[product.color_id]['items'][1].size+'</a><input type="hidden" class="p_size" value="'+product_item[product.color_id]['items'][1].size+'"></li>');
        }
        if (product_item[product.color_id]['items'][0]){
            $('.prodFormSelectUL ul').append('<li class="SelectULOver"><a href="0">'+product_item[product.color_id]['items'][0].size+'</a><input type="hidden" class="p_size" value="'+product_item[product.color_id]['items'][0].size+'"></li>');
        }
        if (product_item[product.color_id]['items'][2]){
            $('.prodFormSelectUL ul').append('<li class="nobgline"><a href="2">'+product_item[product.color_id]['items'][2].size+'</a><input type="hidden" class="p_size" value="'+product_item[product.color_id]['items'][2].size+'"></li>');
        }
        $('.prodFormSelectUL ul li a').off('click').on('click',function(e){
            e.preventDefault();
            var idx = $(this).attr('href');
            $('.prodFormSelectUL ul li').removeClass('SelectULOver');
            $(this).parent().addClass('SelectULOver');
            product.set_coffee_taste(idx);
        })

        $('.prodFormSelectUL ul li:eq(1) a').trigger('click');
    },
    set_coffee_taste:function(idx){
        var taste = product_item[product.color_id]['items'][idx].coffee_taste;
        taste = taste.split(',');
        $('.prodFormSelectShow').each(function(index){
            $(this).find('li').removeClass('SelectOver');
            for (i=0;i<=taste[index];i++){
                $(this).find('li:eq('+i+')').addClass('SelectOver');
            }
        })
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
            var p_size = $('li.SelectULOver .p_size').val();
            var p_qty = 1;//$('.p_qty').val();
            var q = 'p_id=' + p_id + '&p_color=' + p_color + '&p_price=' + p_price + '&p_size=' + p_size + '&p_qty=' + p_qty + '';
            //console.log(q);return;
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
            $('.prodImgAll ul').append('<li><a href="#"><img src="' + product.img_url + gallery[i]['filename'] + '"></a></li>');
        }
        product.set_gallery();
    }
}
</script>