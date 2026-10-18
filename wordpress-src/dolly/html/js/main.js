// JavaScript Document
//動畫速度
	var speed=500,
	t=0,
	p=0,
	renum=1,
	returns='left',
	nowdiv=1,
	slagon=["x","-10%","-2%","25%","-5%"],
	slagon320=["x","-22%","8%","-5%","30%"],
	slagon480=["x","-10%","-2%","35%","-5%"],
	slagon760=["x","0%","0%","30%","55%"],
	slagon960=["x","-5%","-5%","-2%","-2%"],
	slagon1024=["x","0%","5%","15%","10%"],
	slagon1280=["x","2%","10%","20%","15%"],
	slagon1920=["x","13%","15%","20%","15%"],
	
	top320=["x","45","460","860","1270"],
	top480=["x","45","460","900","1350"],
	top760=["x","45","600","1130","1670"],
	top960=["x","45","380","720","1080"],
	top1024=["x","60","510","1000","1550"],
	top1280=["x","60","620","1200","1760"],
	top1920=["x","60","720","1350","2000"],
	
	animationok=["x",-1,-1,-1,-1];
	var remeber=1;
	var dd=1;
	var ismobile=0;
	var ismobile2=0;
	var skrollr_obj
	currentLang = navigator.language;   //判断除IE外其他浏览器使用语言
	if(!currentLang){//判断IE浏览器使用语言
	    currentLang = navigator.browserLanguage;
	}
	//判断访问终端
	var browser={
	    versions:function(){
	        var u = navigator.userAgent, app = navigator.appVersion;
	        return {
	            trident: u.indexOf('Trident') > -1, 
	            presto: u.indexOf('Presto') > -1, 
	            webKit: u.indexOf('AppleWebKit') > -1, 
	            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
	            mobile: !!u.match(/AppleWebKit.*Mobile.*/), 
	            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), 
	            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, 
	            iPhone: u.indexOf('iPhone') > -1 , 
	            iPad: u.indexOf('iPad') > -1, 
	            webApp: u.indexOf('Safari') == -1 
	        };
	    }(),
	    language:(navigator.browserLanguage || navigator.language).toLowerCase()
	}


	$(function(){
		
	if(browser.versions.mobile||browser.versions.android||browser.versions.ios){
	ismobile=1
	}
	PResizeH();

	
	var $control =$('.pic_5_main').find('li');
 /*   $control.on("mouseover",function(){
			num=$(this).index()
			$('.pic_5 li h3').eq(num).css( "background", "#74665e" );
			$('.pic_5 li h4').eq(num).css( "background", "#74665e" );
				
	});
     $control.on("mouseout",function(){
		    $('.pic_5 li h3').css( "background", "#000" );
			$('.pic_5 li h4').css( "background", "#000" );
	});*/
	
	 $control.on({
     mouseover: function() {
  		 num=$(this).index()
		 $('.pic_5 li h3').eq(num).css( "background", "#74665e" );
	     $('.pic_5 li h4').eq(num).css( "background", "#74665e" );
 	 }, mouseout: function() {
    	$('.pic_5 li h3').css( "background", "#000" );
		$('.pic_5 li h4').css( "background", "#000" );
    }
	});
	
	
	
	});
	
	
	$(window).resize(function(){
		//alert("ff")
		if(ismobile==0){
		PResizeH();
		}
	});	

	function PResizeH(){
		//如果瀏覽器小於960並且不是行動裝置讓圖片一開始都出現
	   if( $(window).width()<960 && ismobile==0){
					 ismobile2=1
				for(var i=1;i<=4;i++){
			 	 $('.pic_'+i+ ' .slagon').css("opacity","1");
				 $('.pic_'+i+ ' .product').css("opacity","1");
				}
				
	     }else{//如果是行動裝置讓圖片一開始都出現
			 for(var i=1;i<=4;i++){
			 	 $('.pic_'+i+ ' .slagon').css("opacity","1");
				 $('.pic_'+i+ ' .product').css("opacity","1");
				}
				 ismobile2=0 
		 }
	
	

		//console.log($(window).width());
		//如果是PC就執行瀏覽器寬度判斷
		if(ismobile==0){
				
	    repostion()
		}
		
		//如果是PC 一開始流覽器寬度大於960(ismobile2=0) 並且ismobile=0(PC)
	    if(ismobile2==0 && ismobile==0){
		
		$('.pic_1 .slagon').attr('data-0', "opacity:1;");
		$('.pic_1 .slagon').attr('data-300', "opacity:0;");
		$('.pic_1 .product').attr('data-0', "opacity:1;");
		$('.pic_1 .product').attr('data-300', "opacity:0;");
		}
	    skrollr_obj = skrollr.init({
  		//跟smoothScrolling的功能，主要都是讓scroll事件不要這麼敏感，動畫才不會看起來卡卡的。
  		smoothScrolling : true,
  		smoothScrollingDuration:200,
 		 //可以調整ScrollBar往下拉對應到keyframe的值等倍放大
 		 scale:1,
  
  		//讓文本高度自動達到滿足Keyframe的條件
 		 forceHeight:true,
  
 		 //針對行動裝置的功能
		  mobileCheck:function(){},
 		 mobileDeceleration:0.004,
 		 //畫面一開始，元素的初始值set：物件上第一個影格的值，ease：相對畫面開始的Scrolltop值使用兩格影格作參考，reset:使用他原生的CSS值
 		 edgeStrategy:'set',
		});
	      skrollr_obj.refresh();
		}
	 
	
function repostion(){

	    deldata()
	   if($(window).width()<=320){
		 // console.log("320ii");
			  for(var i=1;i<=4;i++){
				$('.pic_'+i).css("top",top320[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon320[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon320[i]);
		     }
			}
	   }else
	 if( $(window).width()>320 && $(window).width()<462 ){
		  
		//	console.log("320++");
		    for(var i=1;i<=4;i++){
				$('.pic_'+i).css("top",top480[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon480[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon480[i]);
		     }
			}
		      /*  $('.pic_2 .slagon').attr('data-0', "right:-7%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-500', "right:-2%;opacity:1;");*/
	   }else 
        if( $(window).width()>=462 &&$(window).width()<744){
			//console.log("480++");
			
			 for(var i=1;i<=4;i++){
				  $('.pic_'+i).css("top",top760[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon480[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon480[i]);
		     }
			}
		      /*  $('.pic_2 .slagon').attr('data-0', "right:-10%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-800', "right:0%;opacity:1;");*/
	   }else  if($(window).width()>=744 && $(window).width()<944){
		  deldata()
		//  console.log("760++");
		  
		   for(var i=1;i<=4;i++){
			   $('.pic_'+i).css("top",top960[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon960[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon960[i]);
		     }
			}
		  
		       /* $('.pic_2 .slagon').attr('data-0', "right:0%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-200', "right:-5%;opacity:1;");*/
	   }else 
	   if($(window).width()>=944 && $(window).width()<=1008){
		  
		 //   console.log("960++");
			 for(var i=1;i<=4;i++){
				 $('.pic_'+i).css("top",top1024[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon1024[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon1024[i]);
		     }
			}
				if(ismobile2==0){
			    $('.pic_2 .slagon').attr('data-0', "right:0%;opacity:0;");
			
			    $('.pic_2 .slagon').attr('data-500', "right:5%;opacity:5;");

				$('.pic_2 .product').attr('data-0', "left:-5%;opacity:0;");
			    $('.pic_2 .product').attr('data-500', "left:0%;opacity:5;");
				$('.pic_2').attr('data-0', "top:510px;");
			    $('.pic_2').attr('data-500', "top:410px;");
				$('.pic_3 .slagon').attr('data-500', "left:5%;opacity:0;");
			    $('.pic_3 .slagon').attr('data-1000', "left:15%;opacity:5;");
				/*$('.pic_3 .product').attr('data-300', "right:5%;opacity:0;");
			    $('.pic_3 .product').attr('data-800', "right:0%;opacity:1;");*/
				$('.pic_3 .product').attr('data-500', "right:0%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "opacity:5;");
				$('.pic_3').attr('data-400', "top:1000px;");
			    $('.pic_3').attr('data-700', "top:900px;");
				$('.pic_4 .slagon').attr('data-1000', "right:-2%;opacity:0;");
			    $('.pic_4 .slagon').attr('data-1500', "right:10%;opacity:5;");
				$('.pic_4 .product').attr('data-1000', "left:-5%;opacity:0;");
			    $('.pic_4 .product').attr('data-1500', "left:0%;opacity:5;");
				$('.pic_4').attr('data-0', "top:1550px;");
			    $('.pic_4').attr('data-1500', "top:1450px;");
				}
	  }else  if($(window).width()>1008 && $(window).width()<=1264){
				
		   
		  //  console.log("1024++");
			for(var i=1;i<=4;i++){
				$('.pic_'+i).css("top",top1280[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon1280[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon1280[i]);
		     }
			}
				if(ismobile2==0){
			    $('.pic_2 .slagon').attr('data-0', "right:5%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-500', "right:10%;opacity:1;");
				$('.pic_2 .product').attr('data-0', "left:-5%;opacity:0;");
			    $('.pic_2 .product').attr('data-500', "left:0%;opacity:1;");
				$('.pic_2').attr('data-0', "top:620px;");
			    $('.pic_2').attr('data-500', "top:520px;");
				$('.pic_3 .slagon').attr('data-500', "left:30%;opacity:0;");
			    $('.pic_3 .slagon').attr('data-1000', "left:20%;opacity:1;");
			/*	$('.pic_3 .product').attr('data-500', "right:5%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "right:0%;opacity:1;");*/
				$('.pic_3 .product').attr('data-500', "right:0%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "opacity:1;");
				$('.pic_3').attr('data-400', "top:1150px;");
			    $('.pic_3').attr('data-700', "top:1100px;");
				$('.pic_4 .slagon').attr('data-1000', "right:5%;opacity:0;");
			    $('.pic_4 .slagon').attr('data-1500', "right:15%;opacity:1;");
				$('.pic_4 .product').attr('data-1000', "left:-5%;opacity:0;");
			    $('.pic_4 .product').attr('data-1500', "left:0%;opacity:1;");
				$('.pic_4').attr('data-0', "top:1850px;");
			    $('.pic_4').attr('data-1500', "top:1660px;");
				}
	   }else  if($(window).width()>1264 && $(window).width()<1904){
		  //  console.log("1264++");
			for(var i=1;i<=4;i++){
				 $('.pic_'+i).css("top",top1920[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon1920[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon1920[i]);
		     }
			}
				if(ismobile2==0){
			    $('.pic_2 .slagon').attr('data-0', "right:5%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-500', "right:15%;opacity:1;");
				$('.pic_2 .product').attr('data-0', "left:-5%;opacity:0;");
			    $('.pic_2 .product').attr('data-500', "left:0%;opacity:1;");
				$('.pic_2').attr('data-0', "top:720px;");
			    $('.pic_2').attr('data-500', "top:620px;");
			    $('.pic_3 .slagon').attr('data-500', "left:30%;opacity:0;");
			    $('.pic_3 .slagon').attr('data-1000', "left:20%;opacity:1;");
				
				/*$('.pic_3 .product').attr('data-500', "right:5%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "right:0%;opacity:1;");*/
				$('.pic_3 .product').attr('data-500', "right:0%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "opacity:1;");
				$('.pic_3').attr('data-400', "top:1350px;");
			    $('.pic_3').attr('data-700', "top:1250px;");
				
				$('.pic_4 .slagon').attr('data-1000', "right:5%;opacity:0;");
			    $('.pic_4 .slagon').attr('data-1500', "right:15%;opacity:1;");
				$('.pic_4 .product').attr('data-1000', "left:-5%;opacity:0;");
			    $('.pic_4 .product').attr('data-1500', "left:0%;opacity:1;");
				$('.pic_4').attr('data-0', "top:2000px;");
			    $('.pic_4').attr('data-1500', "top:1900px;");
				}

	   }else  if($(window).width()>=1904){
		 //   console.log("1264++");
			for(var i=1;i<=4;i++){
				 $('.pic_'+i).css("top",top1920[i]+"px"); 
			 if(i%2==0){
			    $('.pic_'+i+ ' .slagon').css("right",slagon1920[i]); 
		     }else{
			   $('.pic_'+i+ ' .slagon').css("left",slagon1920[i]);
		     }
			}
				if(ismobile2==0){
			    $('.pic_2 .slagon').attr('data-0', "right:5%;opacity:0;");
			    $('.pic_2 .slagon').attr('data-500', "right:15%;opacity:1;");
				$('.pic_2 .product').attr('data-0', "left:-5%;opacity:0;");
			    $('.pic_2 .product').attr('data-500', "left:0%;opacity:1;");
				$('.pic_2').attr('data-0', "top:720px;");
			    $('.pic_2').attr('data-500', "top:620px;");
			    $('.pic_3 .slagon').attr('data-500', "left:30%;opacity:0;");
			    $('.pic_3 .slagon').attr('data-1000', "left:20%;opacity:1;");
				
				/*$('.pic_3 .product').attr('data-500', "right:5%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "right:0%;opacity:1;");*/
				$('.pic_3 .product').attr('data-500', "right:0%;opacity:0;");
			    $('.pic_3 .product').attr('data-1000', "opacity:1;");
				$('.pic_3').attr('data-400', "top:1350px;");
			    $('.pic_3').attr('data-700', "top:1250px;");
				
				$('.pic_4 .slagon').attr('data-1000', "right:5%;opacity:0;");
			    $('.pic_4 .slagon').attr('data-1500', "right:15%;opacity:1;");
				$('.pic_4 .product').attr('data-1000', "left:-5%;opacity:0;");
			    $('.pic_4 .product').attr('data-1500', "left:0%;opacity:1;");
				$('.pic_4').attr('data-0', "top:2000px;");
			    $('.pic_4').attr('data-1500', "top:1900px;");
				}

	   }
}
	
	function deldata(){
    //如果有變動瀏覽器尺寸先清掉所有的data
    $('.skrollable').each( function() {
        var $skroll = $(this);
        $.each( $skroll.data(), function( key ) {
            $skroll.removeAttr( 'data-' + key );
           // $skroll.removeData();
        });
    });

		
	}