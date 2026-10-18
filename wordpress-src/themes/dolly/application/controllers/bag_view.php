<style>
.footer {
    position: absolute !important;
}
</style>
<div class="bagPage">
    <div class="bagTitle">
        SHOPPING BAG
    </div>
    <div class="bagBoxBottom">
    </div>
    <!--表單步驟開始-->
    <div class="bagList">
        <div class="bagListName">
            <h3>ITMES</h3>
            <h4></h4>
            <h5>NUM</h5>
            <h6>PRICE</h6>
        </div>
        <div class="bagBorder">
        </div>
        <!--購買的清單-->
        <div class="bagShopList">
            <ul>
                <?PHP foreach($cart as $item):?>
                <li>
                    <div class="bagSLimg">
                        <img src="<?PHP echo IMG_URL . $item['filename']?>" width="100" height="100">
                    </div>
                    <h3>
                        <div class="texeC">
                            <span><span class="textCC">
                                <?PHP echo $item['title']?> 
                                COLOR:<?PHP echo $item['color_title']?> 
                                SIZE:<?PHP echo $item['size']?>
                            </span></span>
                        </div>
                    </h3>
                    <h4>
                        <select name="qty" class="bagShopListN">
                            <?PHP for($i=1;$i<=$item['max_qty'];$i++):?>
                            <option value="<?PHP echo $i?>" <?PHP echo ($i==$item['qty']?'selected':'')?>><?PHP echo $i?></option>
                            <?PHP endfor;?>
                        </select>
                    </h4>
                    <h5>NT <?PHP echo number_format($item['product_price'])?></h5>
                    <h6><a href="#"><input type="hidden" name="rowid" value="<?PHP echo $item['rowid']?>">Close</a></h6>
                    <div class="clearDiv">
                    </div>
                </li>
                <?PHP endforeach;?>
                <div class="clearDiv">
                </div>
            </ul>
            <div class="bagShopListMoney">
                <h1>NT <span class="bagBigMoney"><?PHP echo number_format($this->cart->total());?></span></h1>
                <h2>SUB</h2>
                <div class="clearDiv">
                </div>
            </div>
        </div>
    </div>
    <div class="cartBoxBottom">
    </div>
    <div class="cartCloseCheck">
        <div class="cartBack">
            <a href="#">Close</a>
        </div>
        <div class="cartCheck">
            <a href="<?PHP echo SITE_URL . $_SESSION['lang'] . '/cart'?>">Check</a>
        </div>
    </div>
    <!--表單步驟結束-->
</div>

<script>
    $(function(){
        cart.process = '<?PHP echo SITE_URL . $_SESSION['lang'] . '/ajax/update_cart'?>';
        cart.init();
    })
    var cart = {
        process:'',
        init:function(){
            this.set_delete_item();
            this.set_change_qty();
        },
        set_delete_item:function(){
            $('.bagShopList ul li h6 a').on('click',function(e){
                e.preventDefault();
                var rowid = $(this).children('input').val();
                cart.update_qty(rowid,0);
            })
        },
        set_change_qty:function(){
            $('.bagShopList ul li h4 select[name="qty"]').on('change',function(){
                var rowid = $(this).parents('li').find('h6 a input').val();
                var qty = $(this).val();
                cart.update_qty(rowid,qty);
            })
        },
        update_qty:function(rowid,qty){
            var process = this.process;
            $.post(process,'rowid=' + rowid + '&qty=' + qty,function(){
                location.reload();
            })
        }
    }
</script>