



    <div id="container">
	
	<div class="col-xs-12 about" style="clear:both;background-color: #dfdfdf;margin-top: -40px;border: 0px;padding-bottom:100px;  padding-top: 40px;">

	<div id="title_hr1" class="col-xs-4 col-xs-offset-1">
		<hr style="margin-top:28px;  border-top: 1px solid #b9b7b5;">
	</div>
	<div id="title1" class="col-xs-2">
		<center><h2 style="font-size:18px;">PRODUCTS</h2></center>
	</div>
	<div id="title_hr2" class="col-xs-4">
		<hr style="margin-top:28px;  border-top: 1px solid #b9b7b5;">
	</div>
	
	<div class="col-xs-10 col-xs-offset-1 service" style="background-color: #fff;margin-top:35px;padding:0px 0px 0px 0px;">
	<!-- pic_1 -->
<div style="width:100%;background-image:url('img/bg_pic1.jpg');background-size: cover;" >



	<a href="<?php echo SITE_URL ?>product/type/14">
		<img style="width:34.166667%;" src="<?php echo SITE_URL ?>/assets/images/ming/list_coffee.jpg" />
	</a>
	<a href="<?php echo SITE_URL ?>product/type/">
		<img style="width:33.958333%;margin-left: -4px;" src="<?php echo SITE_URL ?>/assets/images/ming/list_cup.jpg" />
	</a>
	<a href="<?php echo SITE_URL ?>product/type/">	
		<img style="width:31.875%;margin-left: -4px;" src="<?php echo SITE_URL ?>/assets/images/ming/list_box.jpg" />
	</a>
</div>






</div>

	
</div>



</div><!-- container end -->




<script>

$('.img-caption-out').mouseenter(function(){
	$(this).children('div').fadeIn("fast");
	x = $(this).children('div');//img-caption
	y = x.children('div');
	y.children('table').animate({marginTop:'0%', opacity:'1'},400);
	
});
$('.img-caption-out').mouseleave(function(){
	$(this).children('div').fadeOut("fast");
	y.children('table').animate({marginTop:'100%', opacity:'0'},400);
});

$(function(){
	$(window).resize(function(){ 	
		windows_size = window.innerWidth;
		if (windows_size < 650){
			$(".img_text").css("width","250px")
		}
	});
	$(document).ready(function(){			
		windows_size = window.innerWidth;
		if (windows_size < 650){
			$(".img_text").css("width","250px")
		}
	});
});

a = window.location.search;
if (a == '?x=works'){
	$(document).ready(function(){
		$('html,body').animate({scrollTop:$('.works').offset().top}, 400); 
	});
}


</script>

