// JavaScript Document
$(function(){
	
	var opWinW = $(window).innerWidth(),
		opWinH = $(window).innerHeight(),
		$body = $("body"),
		$burgLine = $(".burgLine"),//漢堡線
		$overBody = $(".overBody"),//全畫面刷黑
		$menuLeft = $(".menuLeft"),//左方主選單
		$BackTop = $(".BackTop"),//回最上方		
		$btn_menuClose = $(".btn_menuClose"),//關閉主選單的手指
		$btn_lang = $(".btn_lang"),//右上角的語系
		$btn_langChang = $(".btn_lang ul"),//右上語系內容
		
		//以下為會員登入物件
		$btn_member = $(".btn_member"),//右上會員登入
		$overLoginBody = $(".overLoginBody"),//會員登入背景刷黑
		$memberLogin = $(".memberLogin"),//會員登入介面
		$memberLoginClose = $(".memberLoginClose"),//關閉會員登入介面
		$memberLoginCheck = $(".memberLoginCheck");//登入會員裡面的記住我。
		
	$(window).ready(function(){
		okgo();
	});
	function okgo(){
		
	};

	
	$(window).resize(function(){
		PageResizeH();
		var NowW = $(window).innerWidth(),
			NowH = $(window).innerHeight();
		//console.log(NowW);
	});	
	
	$BackTop.click(function(){
		$body.stop(true,false).animate({scrollTop:"0"},400);
	});
	
	
	//右側選單開關動態
	var M = 0;
	//左側語系，選單開關動態
	var L = 0;
	
	function PageResizeH(){
		var chWinW = $(window).innerWidth();
		var chWinH = $(window).innerHeight();
		//console.log(M + ', ' + chWinW);
		
		//判斷兩側選單的收合及自動關閉
		if(chWinW < 1300 && M == 0){
			M = 1;	
			$burgLine.bind("click",burgMenu);
			TweenMax.to($btn_langChang, 0, {css:{display:"none",opacity:0}});
			L = 0;
		}if(chWinW > 1300 && M == 1){
			M = 0;
			TweenLite.to($overBody, 0, {css:{display:"none"},opacity:0});
			TweenLite.to($menuLeft, 0, {css:{left:-245},ease:Quint.easeOut});
			$burgLine.unbind("click",burgMenu);			
		}
	};
	PageResizeH();
	//---------------------------------------*****
	//=====左側選單縮小版打開及關閉
	//---------------------------------------*****
	function burgMenu(){
		//console.log("做幾次");
		TweenMax.to($overBody, 0, {css:{display:"block",opacity:0}});
		TweenMax.to($overBody, 0.5, {css:{opacity:.6},ease:Quint.easeOut});	
		TweenMax.to($menuLeft, 1, {css:{left:+245},ease:Quint.easeOut});		
	};	
	
	$overBody.click(function(){
		TweenMax.to($overBody, 0, {css:{display:"none"},opacity:0});
		TweenMax.to($menuLeft, 1.5, {css:{left:-245},ease:Quint.easeOut});
	});	
	$btn_menuClose.click(function(){
		TweenMax.to($overBody, 0, {css:{display:"none"},opacity:0});
		TweenMax.to($menuLeft, 1.5, {css:{left:-245},ease:Quint.easeOut});
		return false;
	});	
	//---------------------------------------*****
	//=====右側選單，語系切換開關
	//---------------------------------------*****
	$btn_lang.click(function(){
		if(L==0){
			TweenMax.to($btn_langChang, 0, {css:{display:"block",opacity:0}});
			TweenMax.to($btn_langChang, 0, {alpha:0});
			TweenMax.to($btn_langChang, 0.2, {alpha:1,onComplete:function(){
				L = 1;
				//console.log(L);
			}});
		}else{
			TweenMax.to($btn_langChang, 0.2, {alpha:0,onComplete:function(){
				L = 0;
				//console.log(L);
			}});
			TweenMax.to($btn_langChang, 0, {css:{display:"none",opacity:0},delay:.2});
		}
		return false;
	});
	$("body").click(function(){
		if(L==1){
			TweenMax.to($btn_langChang, 0.2, {alpha:0,onComplete:function(){
				L = 0;
				//console.log(L);
			}});
			TweenMax.to($btn_langChang, 0, {css:{display:"none",opacity:0},delay:.2});
		}
	});
	
	
	//---------------------------------------*****
	//=====登入會員
	//---------------------------------------*****
	TweenMax.to($overLoginBody, 0, {autoAlpha:0});
	TweenMax.to($memberLogin, 0, {autoAlpha:0});
	
	
	$btn_member.click(function(){
		TweenMax.to($overLoginBody, .5, {autoAlpha:.9,ease:Quad.easeOut});
		TweenMax.to($memberLogin, .5, {autoAlpha:1,ease:Quad.easeOut});
		return false;
	});
	
	$memberLoginClose.click(function(){
		TweenMax.to($overLoginBody, .5, {autoAlpha:0,ease:Quad.easeOut});
		TweenMax.to($memberLogin, .5, {autoAlpha:0,ease:Quad.easeOut});
		return false;
	});
	
	$overLoginBody.click(function(){
		TweenMax.to($overLoginBody, .5, {autoAlpha:0,ease:Quad.easeOut});
		TweenMax.to($memberLogin, .5, {autoAlpha:0,ease:Quad.easeOut});
	});
	
	//登入Btn
	var C = 0;
	TweenMax.to($(".memberLoginCheckBoxOn"), 0, {scale:0.5,alpha:0});
	
	$memberLoginCheck.click(function(){
		if(C==0){
			console.log("hi");
			TweenMax.to($(".memberLoginCheckBoxOn"), .3, {scale:1,alpha:1,ease:Back.easeOut,onComplete:function(){
				C = 1;
				//console.log(C);
			}});			
		}else{
			TweenMax.to($(".memberLoginCheckBoxOn"), .3, {scale:0.5,alpha:0,ease:Back.easeOut,onComplete:function(){
				C = 0;
				//console.log(C);
			}});
		}
		return false;
	});
	
	
	
	
});










