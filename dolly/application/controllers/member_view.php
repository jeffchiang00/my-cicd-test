 <style>
    body {
        position: absolute !important;
    }
    footer {
        position: absolute !important;
        bottom: 0px !important;
    }
 </style>    
    <form id="frm_member">
    <input type="hidden" name="member_type" value="<?PHP echo $member_data['member_type']?>">
    <div class="memberNow">
		<div class="memberNowChange">
        	<div class="memberNowChangeA"><a href="#">ACCOUNT</a></div>
            <div class="memberNowChangeB"><a href="#">HISTORY</a></div>
   		</div>
        <div class="memberNowLogOut"><a href="#">LOG OUT</a></div>
    </div>
    
    <!--購物車頁面-->
    <div class="cartPage reCartPageTop">
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
                        	<input name="first_name" value="<?PHP echo $member_data['first_name']?>" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="cartSAPos2_in">
                        	<input name="last_name" value="<?PHP echo $member_data['last_name']?>" type="text" class="cartFormBoxS" />
                        </div>
                        <div class="cartFormTitle cartSAPos3">E-mail address<span class="typeRed">*</span></div>
                        <div class="cartSAPos3_in">
                        	<input name="email" value="<?PHP echo $member_data['email']?>" type="text" class="cartFormBoxL" />
                        </div>
                        <div class="edit_pwd"><a href="javascript:void(0)">編輯密碼</a></div>
                        <div class="cartFormTitle cartSAPos4 pwd_view">Password<span class="typeRed">*</span></div>
                        <div class="cartFormTitle cartSAPos5 pwd_view">Confirm Password<span class="typeRed">*</span></div>
                        <div class="cartSAPos4_in pwd_view">
                            <input name="pwd" type="password" class="cartFormBoxS" />
                        </div>
                        <div class="cartSAPos5_in pwd_view">
                            <input name="pwd2" type="password" class="cartFormBoxS" />
                        </div>
                        <div class="clearDiv"></div>
                        <?PHP if ($member_data['member_type']==''):?>
                        <div class="cartSAfbBtn" style=""><a href="#">Connect FB</a></div>
                        <div class="clearDiv"></div>
                        <?PHP endif;?>
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

        </ul>
        <!--表單步驟結束-->
	</div>
    <div class="memberPage">
    	<div class="memberPageHistoryTitle">
        	<ul>
            	<li>DATE</li>
                <li class="HTbig">ORDER</li>
                <li>AMOUNT</li>
                <li>STATUS</li>
            </ul>
        </div>
        <?PHP foreach($member_order as $order):?>
		<div class="memberPageHistoryList">
       		<ul>
            	<li class="HTLsmall"><?PHP echo ($order['createtime'])?></li>
                <a href="<?PHP echo SITE_URL . $language_sort[0][0]?>/order_detail?orderid=<?PHP echo $order['member_order_id']?>"><li class="HTLbig typeBlue"><?PHP echo $order['member_order_id']?></li></a>
                <li>NT <?PHP echo number_format($order['total_amount'])?></li>
                <li class="typeOrange"><?PHP echo $order['status']?></li>
            </ul>
        </div>
        <?PHP endforeach;?>
    </div>
    </form>

    <style>
    .cartSABox{height:auto; padding-bottom:20px;}
    .cartSAfbBtn{float:none; margin:40px auto;}
    .memberPage{display:none;}
    .edit_pwd{float:left; margin:34px 10px;}
    .edit_pwd a{color: #595656;}
    .edit_pwd a:hover{color:#75c9c7;}
    .pwd_view{display:none;}
    @media screen and (max-width:480px){
        .cartSABox{height:auto; padding-bottom:10px;}
        .cartSAfbBtn{margin-top:20px;}
    }
    </style>
    <script src="<?PHP echo SITE_URL?>assets/js/tw_city.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/js/china_city.js"></script>
    <script src="<?PHP echo SITE_URL?>assets/js/jquery.form.min.js"></script>
    <script>
    $(function(){
        cart_flow.set_addr_init();

        <?PHP if ($addr = json_decode($member_data["member_addr"])):?>
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
        
        <?PHP endif;?>

        $('#frm_member').ajaxForm({
            beforeSubmit: function(arr, $form, options) {

                if ($('input[name="first_name"]').val()==""){
                    site.echo('請輸入FIRST NAME');
                    return false;
                }
                if ($('input[name="last_name"]').val()==""){
                    site.echo('請輸入LAST NAME');
                    return false;
                }
                if ($('input[name="email"]').val()==""){
                    site.echo('請輸入EMAIL');
                    return false;
                }
                if (!($('input[name="pwd"]').val()=="" && $('input[name="pwd2"]').val()=="")){
                    if ($('input[name="pwd"]').val()==""){
                        site.echo('請輸入密碼');
                        return false;
                    }
                    if ($('input[name="pwd2"]').val()==""){
                        site.echo('請輸入確認密碼');
                        return false;
                    }
                    if ($('input[name="pwd2"]').val()!=$('input[name="pwd"]').val()){
                        site.echo('請確認兩組密碼相同');
                        return false;
                    }
                }
                var obj = {};
                obj.shipping_country = $('.shipping select[name="shipping"] option:selected').text();
                obj.shipping_province = $('.shipping select[name="province"]').val();
                obj.shipping_city = $('.shipping select[name="city"]').val();
                obj.shipping_area = $('.shipping select[name="area"]').val();
                obj.shipping_address = $('.shipping input[name="address"]').val();
                obj.shipping_zipcode = $('.shipping input[name="zipcode"]').val();
                obj.shipping_mobile = $('.shipping input[name="mobile"]').val();
                obj.shipping_tel = $('.shipping input[name="tel"]').val();
                var json = JSON.stringify(obj);
                arr.push({name:'purchase_form', value:json});
            },
            url: '<?PHP echo SITE_URL . $_SESSION['lang']?>/ajax/member_save',
            type: 'post',
            dataType: 'script'
        });

        $('.cartCheck a').on('click',function(e){
            e.preventDefault();
            $('#frm_member').submit();
        })

        $('.cartSAfbBtn a').on('click',function(e){
            e.preventDefault();
            FB.login(function(response) {
                if (response.authResponse) {
                    //console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        $('input[name="member_type"]').val('fb');
                        site.echo('連結成功，請儲存。');
                        return true;
                    });
                } 
                else {
                    console.log('User cancelled login or did not fully authorize.');
                     return false;
                }
            }, {scope: 'public_profile, email'});
        })

        $('.memberNowChangeA').on('click',function(e){
            e.preventDefault();
            $('.cartPage').show();
            $('.memberPage').hide();
        })

        $('.memberNowChangeB').on('click',function(e){
            e.preventDefault();
            $('.cartPage').hide();
            $('.memberPage').show();
        })

        $('.edit_pwd a').on('click',function(e){
            e.preventDefault();
            $('.edit_pwd').hide();
            $('.pwd_view').show();
        })
    })
    </script>
