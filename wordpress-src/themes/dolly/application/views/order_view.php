    <?PHP //print_r($order_detail)?>
    <?PHP $purchase_form = json_decode($order_detail['master']['purchase_form']);?>
    <div class="cartPage">
        <div class="cartTitle">THANKS FOR YOUR ORDER</div>
        <div class="cartBoxBottom"></div>
        <!--表單步驟開始-->
        <ul>
            <li style="display:block !important;">
                <div class="cartStepE">
                	<div class="cartSEorder">ORDER：<?PHP echo $order_detail['master']['member_order_id']?></div>
                	<div class="cartOpenBorder"></div>
                    <div class="cartSEBox">
                    	<!--連絡基本資料-->
                    	<div class="cartSEbasic">
                        	<div class="cartSEbasicName"><?PHP echo $order_detail['master']['first_name']?> <?PHP echo $order_detail['master']['last_name']?></div>
                            <div class="cartSEbasicMail"><?PHP echo $order_detail['master']['email']?></div>
                            <div class="cartSEbasicPhone"><?PHP echo @$purchase_form->shipping_mobile?></div>
                            <div class="clearDiv"></div>
                        </div>
                        <div class="cartSEbasicT">SHIPPING</div>
                    	<div class="cartSEbasicAdd">
                            <?PHP echo $purchase_form->shipping_country . ' ' . 
                            $purchase_form->shipping_province . ' ' . 
                            $purchase_form->shipping_city . ' ' . 
                            $purchase_form->shipping_area . ' ' . 
                            $purchase_form->shipping_address ?>
                        </div>
                        <div class="cartSEbasicLine"></div>
                        <div class="cartSEbasicT">BILLING</div>
                    	<div class="cartSEbasicAdd">
                            <?PHP echo $purchase_form->billing_country . ' ' . 
                            $purchase_form->billing_province . ' ' . 
                            $purchase_form->billing_city . ' ' . 
                            $purchase_form->billing_area . ' ' . 
                            $purchase_form->billing_address ?>
                        </div>
                        <!--訂單號碼-->
                    </div>
                    <div class="cartOpenBorderS5"></div>
                	
                    <!--購買的清單-->
                    <div class="cartSEList">
                    	<ul>
                            <?PHP foreach($order_detail['detail'] as $item):?>
                            <li>
                                <div class="cartLimg">
                                    <img src="<?PHP echo IMG_URL . $item['filename']?>" width="100" height="100">
                                </div>
                                <h3>
                                    <?PHP echo $item['title']?><br>
                                    COLOR:<?PHP echo $item['color_title']?><br>
                                    SIZE:<?PHP echo $item['size']?>
                                </h3>
                                <h4>
                                    <?PHP echo $item['qty'];?>
                                </h4>
                                <h5>NT <?PHP echo number_format($item['product_price'])?></h5>
                                <div class="clearDiv">
                                </div>
                            </li>
                            <?PHP endforeach;?>
                            <div class="clearDiv"></div>
                        </ul>
                        <div class="cartSEListMoney">
                        	<h1>NT <span class="BigMoney"><?PHP echo number_format($order_detail['master']['total_amount'] - $order_detail['master']['shipping'])?></span></h1>
                            <h2>SUB</h2>
                            <div class="clearDiv"></div>
                        </div>
                        
                        <div class="cartSEListShipping">
                        	<h1>NT <span class="ShippingMoney"><?PHP echo number_format($order_detail['master']['shipping'])?></span></h1>
                            <h2>FREIGHT</h2>
                            <div class="clearDiv"></div>
                        </div>
                        
                        <div class="cartOpenBorderS5"></div>
                        
                        <div class="cartSEListTotal">
                        	<h1>NT <span class="TotalMoney"><?PHP echo number_format($order_detail['master']['total_amount'])?></span></h1>
                            <h2>TOTAL</h2>
                            <div class="clearDiv"></div>
                        </div>
                    </div>
                </div>
                
                
            	<div class="cartBoxBottom"></div>
                <div class="cartCloseCheck">
                	<div class="cartClose"><a href="#">Close</a></div>
                    <div class="cartCheck"><a href="#">Check</a></div>
                </div>
            </li>
        
        </ul>
        <!--表單步驟結束-->
	</div>