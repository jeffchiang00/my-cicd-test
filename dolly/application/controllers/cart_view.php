	<style>
    
	.cartPageNow ul li a.active{
		background:#000; border:2px solid #000;margin-left:0px; margin-top:0px;
	}
    .cartPageNow ul li a:hover { display:block; width:6px; height:6px; background:#979797; margin-left:2px; margin-top:2px;border:0px; cursor:default;}
    /*標題*/
    .cartPage ul li a .cartPtitle,.cartPage ul li a:hover .cartPtitle,.cartPage ul li.CPOver .cartPtitle { 
        width:100%; height:20px; padding-top:20px; color:#888;
        font-size:12px; font-family:Arial,"微軟正黑體"; text-align:center; line-height:20px;
    }

    /*鉛筆*/
    .cartPage ul li a .cartPpen,.cartPage ul li a:hover .cartPpen,.cartPage ul li.CPOver .cartPpen { 
        width:20px; height:20px; margin:0 auto; margin-top:5px;
        opacity:.1;        
    }
    .cartPage ul li>a{cursor: default;}

    .cartSDBox ul{width:140px; margin:0 auto;}
    .cartSDBox ul li{margin-right: 0;}
	</style>
    <div class="cartPageNow">
    	<ul>
        	<li><a href="#" class="active">Step1</a></li>
        	<li><a href="#">Step2</a></li>
            <li><a href="#">Step3</a></li>
            <li><a href="#">Step4</a></li>
            <li><a href="#">Step5</a></li>
        </ul>
    </div>
    <form id="checkout_form">
    <input type="hidden" name="member_type" value="">
    <div class="cartPage">
        <div class="cartTitle">CHECK OUT</div>
        <div class="cartBoxBottom"></div>
        <!--表單步驟開始-->
        <ul>
        	<!--Step01-->
            <li class="CPOver">
                <a href="#"><div class="cartPtitle">ACCOUNT</div>
                <div class="cartPpen"></div></a>
                
                <div class="cartStepA">
                	<div class="cartOpenBorder"></div>
                    <div class="cartSABox">
                    	<div class="cartFormTitle cartSAPos1">First name<span class="typeRed">*</span></div>
                        <div class="cartFormTitle cartSAPos2">Last name<span class="typeRed">*</span></div>
                        <div class="cartSAPos1_in">
                        	<input name="reg_first_name" type="text" class="cartFormBoxS" value="<?PHP echo $_SESSION[SITE_MEMBER_FIRST_NAME]?>" />
                        </div>
                        <div class="cartSAPos2_in">
                        	<input name="reg_last_name" type="text" class="cartFormBoxS" value="<?PHP echo $_SESSION[SITE_MEMBER_LAST_NAME]?>" />
                        </div>
                        <div class="cartFormTitle cartSAPos3">E-mail address<span class="typeRed">*</span></div>
                        
                        <div class="cartSAPos3_in">
                        	<input name="reg_email" type="text" class="cartFormBoxL" value="<?PHP echo $_SESSION[SITE_MEMBER_EMAIL]?>" />
                        </div>
                        <div class="cartFormTitle cartSAPos4">Password<span class="typeRed">*</span></div>
                        <div class="cartFormTitle cartSAPos5">Confirm Password<span class="typeRed">*</span></div>
                        <div class="cartSAPos4_in">
                        	<input name="reg_pwd" type="password" class="cartFormBoxS" />
                        </div>
                        <div class="cartSAPos5_in">
                        	<input name="reg_pwd2" type="password" class="cartFormBoxS" />
                        </div>
                        <div class="clearDiv"></div>
                        <div class="cartSAfbBtn" style="float:none; margin:0 auto; margin-top:20px;"><a href="#">Connect FB</a></div>
                        <div class="cartSAorLine">or</div>
                        <div class="clearDiv"></div>
                        <div class="cartSALoginBtn" style="margin:0 auto;"><a href="#">LOG IN</a></div>
                        <div class="clearDiv"></div>
                	</div>
                </div>
                
                <div class="cartBoxBottom"></div>
                <div class="cartCloseCheck">
                	<div class="cartClose"><a href="#">Close</a></div>
                    <div class="cartCheck"><a href="#">Check</a></div>
                </div>
            </li>
            
            
            <!--Step02-->
            <li class="shipping">
                <a href="#"><div class="cartPtitle">SHIPPING</div>
                <div class="cartPpen"></div></a>
                
                <div class="cartStepB">
                	<div class="cartOpenBorder"></div>
                	<div class="cartSBBox">
                    	<!--<div class="cartFormTitle cartSBCPos1">Address<span class="typeRed">*</span></div>-->
                        <div class="cartSBCPos2_in">
                        	<select name="shipping" class="cartFormBoxSdrop">
                            <?PHP foreach($shipping_data as $row):?>
                            <option value="<?PHP echo $row['price']?>"><?PHP echo $row['title']?></option>
                            <?PHP endforeach;?>
                        	</select>
                        </div>
                        <div class="cartSBCPos3_in">
                        	<input type="text" name="zipcode" class="cartFormBoxS" placeholder="ZIPCODE" />
							<select name="province" class="cartFormBoxSdrop">
                        	<option value="">PROVINCE</option>
                        	</select>
                        </div>
                        <div class="cartSBCPos2_in">
                            <select name="city" class="cartFormBoxSdrop">
                        	<option value="">CITY</option>
                        	</select>
                        </div>
                        <div class="cartSBCPos3_in">
                        	<select name="area" class="cartFormBoxSdrop">
                        	<option value="">DISTRICT</option>
                        	</select>
                        </div>

                        <div class="cartSBCPos1_in">
                        	<input name="address" type="text" class="cartFormBoxL" placeholder="ADDRESS" />
                        </div>
                        
                        <div class="cartFormTitle cartSBCPos4">Mobile<span class="typeRed">*</span></div>
                        <div class="cartFormTitle cartSBCPos5">Phone</div>
                        <div class="cartSBCPos4_in">
                            <input name="mobile" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="cartSBCPos5_in">
                            <input name="tel" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="clearDiv"></div>
                    </div>
                </div>
                
            	<div class="cartBoxBottom"></div>
                <div class="cartCloseCheck">
                	<div class="cartClose"><a href="#">Close</a></div>
                    <div class="cartCheck"><a href="#">Check</a></div>
                </div>
            </li>
            
            
            <!--Step03-->
            <li class="billing">
                <a href="#"><div class="cartPtitle">BILLING	</div>
                <div class="cartPpen"></div></a>
                
                <div class="cartStepC">
                	<div class="cartOpenBorder"></div>
                	<div class="cartSCBox">
                    	<div class="cartSCInfo"><a href="#">COPY FROM SHIPPING INFOMATION</a></div>
                    	<!--<div class="cartFormTitle cartSBCPos1">Address<span class="typeRed">*</span></div>-->
                        <div class="cartSBCPos2_in">
                        	<select name="shipping" class="cartFormBoxSdrop">
                            <?PHP foreach($shipping_data as $row):?>
                            <option value="<?PHP echo $row['price']?>"><?PHP echo $row['title']?></option>
                            <?PHP endforeach;?>
                        	</select>
                        </div>
                        <div class="cartSBCPos3_in">
                            <input type="text" name="zipcode" class="cartFormBoxS" placeholder="ZIPCODE" />
                            <select name="province" class="cartFormBoxSdrop">
                            <option value="">PROVINCE</option>
                            </select>
                        </div>
                        <div class="cartSBCPos2_in">
                            <select name="city" class="cartFormBoxSdrop">
                            <option value="">CITY</option>
                            </select>
                        </div>
                        <div class="cartSBCPos3_in">
                            <select name="area" class="cartFormBoxSdrop">
                            <option value="">DISTRICT</option>
                            </select>
                        </div>

                        <div class="cartSBCPos1_in">
                        	<input name="address" type="text" class="cartFormBoxL" placeholder="ADDRESS" />
                        </div>
                        
                        <div class="cartFormTitle cartSBCPos4">Mobile<span class="typeRed">*</span></div>
                        <div class="cartFormTitle cartSBCPos5">Phone</div>
                        <div class="cartSBCPos4_in">
                        	<input name="mobile" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="cartSBCPos5_in">
                        	<input name="tel" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="clearDiv"></div>
                    </div>
                </div>
                
            	<div class="cartBoxBottom"></div>
                <div class="cartCloseCheck">
                	<div class="cartClose"><a href="#">Close</a></div>
                    <div class="cartCheck"><a href="#">Check</a></div>
                </div>
            </li>
            
            
            <!--Step04-->
            <li class="payment">
                <a href="#"><div class="cartPtitle">PAYMENT</div>
                <div class="cartPpen"></div></a>
                
                <div class="cartStepD">
                	<div class="cartOpenBorder"></div>
                    <div class="cartSDBox">
                   		<ul>
                        	<li>
                            <input name="" type="radio" value="" class="inputClear" id="radioBox1" checked="checked"/>
                            <label for="radioBox1"><span class="cartSDBoxCheckBox">
                            <span class="cartSDBoxCheckBoxOn"></span>
                            </span>CREDIT CARD</label>
                            </li>
                        </ul>
                        <div class="clearDiv"></div>
                    </div>
                </div>
                
            	<div class="cartBoxBottom"></div>
                <div class="cartCloseCheck">
                	<div class="cartClose"><a href="#">Close</a></div>
                    <div class="cartCheck"><a href="#">Check</a></div>
                </div>
            </li>
            
            
            <!--Step05-->
            <li class="summary">
                <a href="#"><div class="cartPtitle">SUMMARY</div>
                <div class="cartPpen"></div></a>
                <div class="cartStepE">
                	<div class="cartOpenBorder"></div>
                    
                    <div class="cartSEBox">
                    	<!--連絡基本資料-->
                    	<div class="cartSEbasic">
                        	<div class="cartSEbasicName">IAN MA</div>
                            <div class="cartSEbasicMail">ian20.ma@gmail.com</div>
                            <div class="cartSEbasicPhone">0920225120</div>
                            <div class="clearDiv"></div>
                        </div>
                        <div class="cartSEbasicT">SHIPPING</div>
                    	<div class="cartSEbasicAdd"> No.3, Aly. 5, Ln. 53, Sec. 5, Nanjing E. Rd., Songshan Dist., Taipei City 105, Taiwan (R.O.C.)</div>
                        <div class="cartSEbasicLine"></div>
                        <div class="cartSEbasicT">BILLING</div>
                    	<div class="cartSEbasicAdd"> No.3, Aly. 5, Ln. 53, Sec. 5, Nanjing E. Rd., Songshan Dist., Taipei City 105, Taiwan (R.O.C.)</div>
                        <!--訂單號碼-->
                    </div>
                    <div class="cartOpenBorderS5"></div>
                	<!--<div class="cartSEorder">ORDER：A20140876001Q</div>-->
                    <!--購買的清單-->
                    <div class="cartSEList">
                    	<ul>
                            <?PHP foreach($cart as $item):?>
                            <li>
                                <div class="cartLimg">
                                    <img src="<?PHP echo IMG_URL . $item['filename']?>" width="100" height="100">
                                </div>
                                <h3>
                                    <div class="texeC">
                                        <span><span class="textCC">
                                        <?PHP echo $item['title']?> <?PHP echo $item['color_title']?> <div class="blueText"><?PHP echo $item['size']?></div>
                                        </span></span></div>
                                </h3>
                                <h4>
                                    <?PHP echo $item['qty'];?>
                                    <!-- <select name="qty" class="bagShopListN">
                                        <?PHP for($i=1;$i<=$item['max_qty'];$i++):?>
                                        <option value="<?PHP echo $i?>" <?PHP echo ($i==$item['qty']?'selected':'')?>><?PHP echo $i?></option>
                                        <?PHP endfor;?>
                                    </select> -->
                                </h4>
                                <h5>NT <?PHP echo number_format($item['product_price'])?></h5>
                                <!-- <h6><a href="#"><input type="hidden" name="rowid" value="<?PHP echo $item['rowid']?>">Close</a></h6> -->
                                <div class="clearDiv">
                                </div>
                            </li>
                            <?PHP endforeach;?>
                            <div class="clearDiv"></div>
                        </ul>
                        <div class="cartSEListMoney">
                        	<h1>NT <span class="BigMoney"><?PHP echo number_format($this->cart->total());?><input type="hidden" name="subtotal" value="<?PHP echo $this->cart->total();?>"></span></h1>
                            <h2>SUB</h2>
                            <div class="clearDiv"></div>
                        </div>
                        
                        <div class="cartSEListShipping">
                        	<h1>NT <span class="ShippingMoney">1000</span><input type="hidden" name="shipping" value=""></h1>
                            <h2>FREIGHT</h2>
                            <div class="clearDiv"></div>
                        </div>
                        
                        <div class="cartOpenBorderS5"></div>
                        
                        <div class="cartSEListTotal">
                        	<h1>NT <span class="TotalMoney">1000</span></h1>
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
    </form>
    <script src="<?PHP echo SITE_URL?>assets/js/tw_city.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/js/china_city.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/js/jquery.form.min.js"></script>
<script>
	$(function(){
        member.login_process = '<?PHP echo SITE_URL . $_SESSION['lang']?>/ajax/member_login';
        member.email_check_process = '<?PHP echo SITE_URL . $_SESSION['lang']?>/ajax/check_email';
		member.init();
        cart_flow.init();
        <?PHP if (isset($_SESSION[SITE_MEMBER_EMAIL]) && $_SESSION[SITE_MEMBER_EMAIL]!=''):?>
        member.first_name = '<?PHP echo $_SESSION[SITE_MEMBER_FIRST_NAME]?>';
        member.last_name = '<?PHP echo $_SESSION[SITE_MEMBER_LAST_NAME]?>';
        member.email = '<?PHP echo $_SESSION[SITE_MEMBER_EMAIL]?>';
        $('.cartPage li:eq(0)>div:not(".cartBoxBottom,.cartStepE")').hide();
        $('.cartPage li:eq(1)>div').show();
        cart_flow.step_focus($('.cartPage li:eq(1)'));
        $('.cartPage.reCartPageTop li:eq(0)').show();

        $('.cartClose a:eq(1)').off('click').on('click',function(e){
            e.preventDefault();
            history.back();
        });
        <?PHP endif;?>

        $('#checkout_form').ajaxForm({
            beforeSubmit: function(arr, $form, options) {
                var obj = {};
                obj.shipping_country = $('.shipping select[name="shipping"] option:selected').text();
                obj.shipping_province = $('.shipping select[name="province"]').val();
                obj.shipping_city = $('.shipping select[name="city"]').val();
                obj.shipping_area = $('.shipping select[name="area"]').val();
                obj.shipping_address = $('.shipping input[name="address"]').val();
                obj.shipping_zipcode = $('.shipping input[name="zipcode"]').val();
                obj.shipping_mobile = $('.shipping input[name="mobile"]').val();
                obj.shipping_tel = $('.shipping input[name="tel"]').val();
                obj.billing_country = $('.billing select[name="shipping"] option:selected').text();
                obj.billing_province = $('.billing select[name="province"]').val();
                obj.billing_city = $('.billing select[name="city"]').val();
                obj.billing_area = $('.billing select[name="area"]').val();
                obj.billing_address = $('.billing input[name="address"]').val();
                obj.billing_zipcode = $('.billing input[name="zipcode"]').val();
                obj.billing_mobile = $('.billing input[name="mobile"]').val();
                obj.billing_tel = $('.billing input[name="tel"]').val();
                var json = JSON.stringify(obj);
                arr.push({name:'purchase_form', value:json});
            },
            url: '<?PHP echo SITE_URL . $_SESSION['lang']?>/ajax/checkout',
            type: 'post',
            dataType: 'script'
        });

        <?PHP if ($addr = json_decode($member_data["member_addr"])):?>
        //shipping
        $('.shipping select[name="shipping"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_country?>'){
                $(this).attr("selected","selected");
                $('.shipping select[name="shipping"]').trigger('change');
            }
        })
        $('.shipping select[name="province"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_province?>'){
                $(this).attr("selected","selected");
                $('.shipping select[name="province"]').trigger('change');
            }
        })
        $('.shipping select[name="city"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_city?>'){
                $(this).attr("selected","selected");
                $('.shipping select[name="city"]').trigger('change');
            }
        })
        $('.shipping select[name="area"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_area?>'){
                $(this).attr("selected","selected");
                $('.shipping select[name="area"]').trigger('change');
            }
        })
        
        $('.shipping input[name="zipcode"]').val('<?PHP echo $addr->shipping_zipcode?>')
        $('.shipping input[name="address"]').val('<?PHP echo $addr->shipping_address?>')
        $('.shipping input[name="mobile"]').val('<?PHP echo $addr->shipping_mobile?>')
        $('.shipping input[name="tel"]').val('<?PHP echo $addr->shipping_tel?>')
        //billing
        $('.billing select[name="shipping"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_country?>'){
                $(this).attr("selected","selected");
                $('.billing select[name="shipping"]').trigger('change');
            }
        })
        $('.billing select[name="province"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_province?>'){
                $(this).attr("selected","selected");
                $('.billing select[name="province"]').trigger('change');
            }
        })
        $('.billing select[name="city"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_city?>'){
                $(this).attr("selected","selected");
                $('.billing select[name="city"]').trigger('change');
            }
        })
        $('.billing select[name="area"] option').each(function(){
            if($(this).val()=='<?PHP echo $addr->shipping_area?>'){
                $(this).attr("selected","selected");
                $('.billing select[name="area"]').trigger('change');
            }
        })
        
        $('.billing input[name="zipcode"]').val('<?PHP echo $addr->shipping_zipcode?>')
        $('.billing input[name="address"]').val('<?PHP echo $addr->shipping_address?>')
        $('.billing input[name="mobile"]').val('<?PHP echo $addr->shipping_mobile?>')
        $('.billing input[name="tel"]').val('<?PHP echo $addr->shipping_tel?>')
        <?PHP else:?>
        <?PHP endif;?>
	})

</script>
