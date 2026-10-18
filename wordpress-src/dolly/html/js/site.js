


var site = {
	init:function(){
		this.set_lang_click_off();
        this.news_page_middle();
	},
	set_lang_click_off:function(){
		$('.btn_lang ul li a').off('click').on('click',function(){
			location = $(this).attr('href');
		});
	},
	echo:function(msg){
		swal(msg);
	},
    news_page_middle:function(){
        $('.newsBPage').each(function(){
            var newsBPage = $(this)
            newsBPage.find('.newsBimg img').load(function(){
                var left = newsBPage.find('.newsBimg').height();
                var right = newsBPage.find('.newsBText').height();
                var max_height = left>right?left:right;
                newsBPage.find('.newsBimg,.newsBText,.newsBTextCC').height(max_height);
            })
        })
    }
}

var member = {
    email:'',
    first_name:'',
    last_name:'',
    mobile:'',
    login_process:'',
    email_check_process:'',
	init:function(){
		$('.cartSAfbBtn a').off('click').on('click',function(e){
            e.preventDefault();
			member.fb_login();
		})

        $('.cartSALoginBtn a').on('click',function(e){
            e.preventDefault();
            $('.btn_member a').trigger('click');
        })

        $('.cartStepA .cartSAfbBtn a').off('click').on('click',function(e){
            e.preventDefault();
            member.fb_connect();
        })
	},
	fb_connect:function(){

		FB.login(function(response) {
			if (response.authResponse) {
				//console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
                    $('input[name="reg_first_name"]').val(response.first_name);
                    $('input[name="reg_last_name"]').val(response.last_name);
                    $('input[name="reg_email"]').val(response.email);
                    $('input[name="member_type"]').val('fb');
                    return true;
				});
			} 
			else {
				console.log('User cancelled login or did not fully authorize.');
                 return false;
			}
		}, {scope: 'public_profile, email'});
	},
    fb_login:function(){
        if( navigator.userAgent.match('CriOS') )
            location = 'https://www.facebook.com/dialog/oauth?client_id=790759917638719&redirect_uri='+ document.location.href +'&scope=email,public_profile';
        else{
            FB.login(function(response) {
                if (response.authResponse) {
                    FB.api('/me', function(response) {
                        var q = '';
                        q += '&member_type=fb';
                        q += '&email=' + response.email;
                        $.post(member.login_process,q,function(data){
                            if (data=='0'){
                                site.echo('登入失敗');
                            }
                            else{
                                location.reload();
                            }
                        })
                    });
                } 
                else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {scope: 'public_profile, email'});
        }
    },
    login:function(){
        if ($('input[name="login_email"]').val()==""){
            site.echo('請輸入EMAIL');
            return false;
        }
        if ($('input[name="login_pwd"]').val()==""){
            site.echo('請輸入密碼');
            return false;
        }
        var remember_login = $('.memberLoginCheckBoxOn').css('opacity')
        var q = '';
        q += '&member_type=email';
        q += '&email=' + $('input[name="login_email"]').val();
        q += '&pwd=' + $('input[name="login_pwd"]').val();
        q += '&remember_login=' + remember_login;
        $.post(member.login_process,q,function(data){
            if (data=='0'){
                site.echo('登入失敗');
            }
            else{
                location.reload();
            }
        })
    },
    forget:function(){
        if ($('input[name="member_email"]').val()==""){
            site.echo('請輸入EMAIL');
            return false;
        }
        var q = '';
        q += '&email=' + $('input[name="member_email"]').val();
        $.post(member.login_process,q,function(data){
            if (data=='0'){
                site.echo('EMAIL不存在');
            }
            else{
                site.echo('新密碼已經寄到信箱' + $('input[name="member_email"]').val());
            }
        })
    },
    logout:function(){

    }
}

var cart_flow = {
    init:function(){
        $('.cartPage>ul>li>div:not(".cartBoxBottom")').hide();
        $('.cartPage>ul>li:eq(0)>div').show();
        $('.cartCheck a').on('click',function(e){
            e.preventDefault();
            cart_flow.next_step()
        });
        $('.cartCheck a:first').off('click').on('click',function(e){
            e.preventDefault();
            cart_flow.check_email();
        });
        $('.cartCheck a:last').off('click').on('click',function(e){
            e.preventDefault();
            cart_flow.checkout();
        });

        $('.cartClose a').on('click',function(e){
            e.preventDefault();
            cart_flow.prev_step();
        });
        $('.cartClose a:first').off('click').on('click',function(e){
            e.preventDefault();
            history.back();
        });

        this.set_addr_init();
        $('body').css('height','auto');
    },
    check_email:function(){
        console.log('check email')
        if (member.email == ''){
            if ($('input[name="reg_first_name"]').val()==""){
                site.echo('請輸入FIRST NAME');
                return false;
            }
            if ($('input[name="reg_last_name"]').val()==""){
                site.echo('請輸入LAST NAME');
                return false;
            }
            if ($('input[name="reg_email"]').val()==""){
                site.echo('請輸入EMAIL');
                return false;
            }
            if ($('input[name="reg_pwd"]').val()==""){
                site.echo('請輸入密碼');
                return false;
            }
            if ($('input[name="reg_pwd2"]').val()==""){
                site.echo('請輸入確認密碼');
                return false;
            }
            if ($('input[name="reg_pwd2"]').val()!=$('input[name="reg_pwd"]').val()){
                site.echo('請確認兩組密碼相同');
                return false;
            }
            $.post(member.email_check_process,'email='+$('input[name="reg_email"]').val(),function(data){
                if (data=='0'){
                    member.email = $('input[name="reg_email"]').val()
                    member.first_name = $('input[name="reg_first_name"]').val()
                    member.last_name = $('input[name="reg_last_name"]').val()
                    cart_flow.next_step()
                }
                else{
                    site.echo($('input[name="reg_email"]').val() + '已經註冊');
                    return false;
                }
            })
        }
        else{
            cart_flow.next_step()
        }
    },
    check_step:function(){
        var step_now = $('.cartPage>ul>li>div:not(".cartBoxBottom"):visible').parent();
        switch(step_now.attr('class')){
            case 'shipping':
                if ($('.shipping select[name="shipping"]')[0].selectedIndex!=3 && $('.shipping input[name="zipcode"]').val()==""){
                    site.echo('請輸入ZIPCODE');
                    return false;
                }
                if ($('.shipping select[name="shipping"]')[0].selectedIndex==3 && $('.shipping select[name="city"]').val()==''){
                    site.echo('請選擇PROVINCE');
                    return false;
                }
                if ($('.shipping select[name="city"]').val()=="" && ($('.shipping select[name="shipping"]')[0].selectedIndex==0 || $('.shipping select[name="shipping"]')[0].selectedIndex==3)){
                    site.echo('請選擇CITY');
                    return false;
                }
                if ($('.shipping select[name="area"]').val()=="" && ($('.shipping select[name="shipping"]')[0].selectedIndex==0 || $('.shipping select[name="shipping"]')[0].selectedIndex==3)){
                    site.echo('請選擇DISTRICT');
                    return false;
                }
                if ($('.shipping input[name="address"]').val()==""){
                    site.echo('請輸入ADDRESS');
                    return false;
                }
                if ($('.shipping input[name="mobile"]').val()==""){
                    site.echo('請輸入MOBILE');
                    return false;
                }
                member.mobile = $('.shipping input[name="mobile"]').val()
                return true;
                break;
            case 'billing':
                if ($('.billing select[name="shipping"]')[0].selectedIndex!=3 && $('.billing input[name="zipcode"]').val()==""){
                    site.echo('請輸入ZIPCODE');
                    return false;
                }
                if ($('.billing select[name="shipping"]')[0].selectedIndex==3 && $('.billing select[name="city"]').val()==''){
                    site.echo('請選擇PROVINCE');
                    return false;
                }
                if ($('.billing select[name="city"]').val()=="" && ($('.shipping select[name="shipping"]')[0].selectedIndex==0 || $('.shipping select[name="shipping"]')[0].selectedIndex==3)){
                    site.echo('請選擇CITY');
                    return false;
                }
                if ($('.billing select[name="area"]').val()=="" && ($('.shipping select[name="shipping"]')[0].selectedIndex==0 || $('.shipping select[name="shipping"]')[0].selectedIndex==3)){
                    site.echo('請選擇DISTRICT');
                    return false;
                }
                if ($('.billing input[name="address"]').val()==""){
                    site.echo('請輸入ADDRESS');
                    return false;
                }
                if ($('.billing input[name="mobile"]').val()==""){
                    site.echo('請輸入MOBILE');
                    return false;
                }
                return true;
                break;
            case 'payment':
                $('.cartSEbasicName').html(member.first_name + ' ' + member.last_name);
                $('.cartSEbasicMail').html(member.email);
                $('.cartSEbasicPhone').html(member.mobile);
                $('.cartSEbasicAdd').html(
                    $('.shipping input[name="zipcode"]').val() +
                    $('.shipping select[name="shipping"] option:selected').text() + 
                    $('.shipping select[name="province"]').val() + 
                    $('.shipping select[name="city"]').val() + 
                    $('.shipping select[name="area"]').val() + 
                    $('.shipping input[name="address"]').val()
                    )
                $('.cartSEbasicAdd').html(
                    $('.billing input[name="zipcode"]').val() + ' ' + 
                    $('.billing select[name="shipping"] option:selected').text() + ' ' + 
                    $('.billing select[name="province"]').val() + ' ' + 
                    $('.billing select[name="city"]').val() + ' ' + 
                    $('.billing select[name="area"]').val() + ' ' + 
                    $('.billing input[name="address"]').val()
                    )
                var subtotal = $('input[name="subtotal"]').val();
                var shipping = parseInt($('.shipping select[name="shipping"]').val());
                var total = cart_flow.formatNumber(parseInt(subtotal) + parseInt(shipping));
                $('input[name="shipping"]').val(shipping)
                $('.ShippingMoney').html(cart_flow.formatNumber(shipping));
                $('.TotalMoney').html(total);
                return true;
                break;
        }
    },
    next_step:function(){
        var step_now = $('.cartPage>ul>li>div:not(".cartBoxBottom"):visible').parent();
        var check = cart_flow.check_step();
        if (check==false) return false;
        step_now.children('div:not(".cartBoxBottom")').slideUp();
        step_now.next().children('div:eq(0)').slideDown(function(){
            cart_flow.step_focus(step_now.next());
            step_now.next().children('div.cartCloseCheck').show();
        });
    },
    prev_step:function(){
        var step_now = $('.cartPage>ul>li>div:not(".cartBoxBottom"):visible').parent();
        step_now.children('div:not(".cartBoxBottom")').slideUp();
        step_now.prev().children('div:eq(0)').slideDown(function(){
            cart_flow.step_focus(step_now.prev());
            step_now.prev().children('div.cartCloseCheck').show();
        });
    },
    step_focus:function(obj){
        var delta = 80
        if ($(window).width()<480){
            delta = 50
        }
        if (obj.length==0) return;
        var top_y = obj.offset().top;
        console.log(top_y)
        TweenMax.to($(window), 1, {
            scrollTo:{
                y: top_y - delta, 
                autoKill: true
            }, 
            ease:Power3.easeOut 
        });

        var dot_idx = obj.index();
        $('.cartPageNow li a').removeClass('active');
        $('.cartPageNow li:eq('+dot_idx+') a').addClass('active');
    },
    set_addr_init:function(){
        $('select[name="shipping"]').each(function(){
            $(this).on('change',function(){
                var container = $(this).parents('li');
                var select_idx = $(this)[0].selectedIndex;
                if (select_idx==0){ //taiwan
                    container.find('input[name="zipcode"]').show().val('');
                    container.find('select[name="province"]').hide();
                    container.find('select[name="city"]').parent().show();
                    container.find('select[name="area"]').parent().show();
                    cart_flow.set_city_area_tw(container);
                }
                else if(select_idx==3){ //china
                    container.find('input[name="zipcode"]').hide().val('');
                    container.find('select[name="province"]').show();
                    container.find('select[name="city"]').parent().show();
                    container.find('select[name="area"]').parent().show();
                    cart_flow.set_city_area_china(container);
                }
                else{ //other
                    container.find('input[name="zipcode"]').show().val('');
                    container.find('select[name="province"]').hide();
                    container.find('select[name="city"]').parent().hide();
                    container.find('select[name="area"]').parent().hide();
                }
            }).trigger('change');
        })

        $('.cartSCInfo a').on('click',function(e){
            e.preventDefault();
            $('.billing select[name="shipping"]')[0].selectedIndex = $('.shipping select[name="shipping"]')[0].selectedIndex
            $('.billing select[name="shipping"]').trigger('change');
            $('.billing select[name="province"]').val($('.shipping select[name="province"]').val()).trigger('change');
            $('.billing select[name="city"]').val($('.shipping select[name="city"]').val()).trigger('change');
            $('.billing select[name="area"]').val($('.shipping select[name="area"]').val());
            $('.billing input[name="zipcode"]').val($('.shipping input[name="zipcode"]').val())
            $('.billing input[name="address"]').val($('.shipping input[name="address"]').val())
            $('.billing input[name="mobile"]').val($('.shipping input[name="mobile"]').val())
            $('.billing input[name="tel"]').val($('.shipping input[name="tel"]').val())
        })
    },
    set_city_area_tw:function(container){
        var city = container.find('select[name="city"]');
        var area = container.find('select[name="area"]');
        if (city[0]) city[0].length = 1;
        if (area[0]) area[0].length = 1;
        for (i=0;i<tw_city.length;i++){
            city.append('<option>'+tw_city[i]+'</option>');
        }
        city.off('change').on('change',function(){
            area[0].length = 1;
            var id = city[0].selectedIndex;
            if (id>0){
                var end = cityarea_account[id];
                var start = cityarea_account[id-1];
                for(i=start+1;i<=end;i++){
                    area.append('<option>'+cityarea[i]+'</option>');
                }
            }
        })

    },
    set_city_area_china:function(container){
        var province = container.find('select[name="province"]');
        var city = container.find('select[name="city"]');
        var area = container.find('select[name="area"]');
        if (province[0]) province[0].length = 1;
        if (city[0]) city[0].length = 1;
        if (area[0]) area[0].length = 1;
        for (i=0;i<_CityList.length;i++){
            province.append('<option>'+_CityList[i].name+'</option>');
        }
        province.off('change').on('change',function(){
            city[0].length = 1;
            area[0].length = 1;
            if ($(this)[0].selectedIndex==0) return;
            var id = $(this)[0].selectedIndex - 1;
            for (i=0;i<_CityList[id].city.length;i++){
                city.append('<option>'+_CityList[id].city[i].name+'</option>');
            }
        })
        city.off('change').on('change',function(){
            area[0].length = 1;
            if ($(this)[0].selectedIndex==0) return;
            var pid = province[0].selectedIndex-1;
            var cid = city[0].selectedIndex-1;
            for (i=0;i<_CityList[pid].city[cid].area.length;i++){
                area.append('<option>'+_CityList[pid].city[cid].area[i].name+'</option>');
            }
        })
    },
    checkout:function(){
        $('#checkout_form').submit();
    },

    formatNumber:function(number){
        number = number.toFixed(2) + '';
        var x = number.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1// + x2;
    }
}
$(function(){
	site.init();
})