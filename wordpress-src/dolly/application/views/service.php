



    <div id="container">
	
	<div class="col-xs-12 about" style="min-height: 600px;clear:both;background-color: #dfdfdf;margin-top: -40px;border: 0px;padding-bottom:100px;  padding-top: 40px;    background: url(../images/re_bg.png);">

	<div id="title_hr1" class="col-xs-4">
		<hr style="margin-top:28px;  border-top: 1px solid #b9b7b5;">
	</div>
	<div id="title1" class="col-xs-4">
		<center><h2 style="font-size:18px;">SERVICE</h2></center>
	</div>
	<div id="title_hr2" class="col-xs-4">
		<hr style="margin-top:28px;  border-top: 1px solid #b9b7b5;">
	</div>
	
	<div class="col-md-10 col-md-offset-1 service" style="background-color: #fff;margin-top:35px;padding:0px 0px 0px 0px;clear:both;">
	<!-- pic_1 -->

<a href="<?php echo SITE_URL ?>service/baked">
<div class="img-caption-out col-md-4" style="overflow:hidden;padding: 0px;">
	
	
		<img style="width:105%;" src="<?php echo SITE_URL ?>/assets/images/ming/service1.jpg" />
	
		<div class="img-caption"><div style="height: 100%;">
			<table style="margin-top: 100%;opacity: 0;">
			<tr><td>
				
				<h3 class="text">Customized Baking</h3>
				<!--<hr style="margin-top:10px;margin-bottom:10px;">-->
				<p class="text">客製化烘豆</p>
				
			</td></tr>
			</table></div>
		</div>
</div>
</a>


<a href="<?php echo SITE_URL ?>service/tutorial">
<div class="img-caption-out col-md-4" style="overflow:hidden;padding: 0px;">
	
	
		<img style="width:105%;" src="<?php echo SITE_URL ?>/assets/images/ming/service2.jpg" />
	
		<div class="img-caption"><div style="height: 100%;">
			<table style="margin-top: 100%;opacity: 0;">
			<tr><td>
				
				<h3 class="text">Coffee Traning Courses</h3>
				<!--<hr style="margin-top:10px;margin-bottom:10px;">-->
				<p class="text">咖啡相關課程教學</p>
				
			</td></tr>
			</table></div>
		</div>
</div>
</a>

<a href="<?php echo SITE_URL ?>service/guidance">
<div class="img-caption-out col-md-4" style="overflow:hidden;padding: 0px;">
	
	
		<img style="width:105%;" src="<?php echo SITE_URL ?>/assets/images/ming/service3.jpg" />
	
		<div class="img-caption"><div style="height: 100%;">
			<table style="margin-top: 100%;opacity: 0;">
			<tr><td>
				
				<h3 class="text">Start Business Counsellor</h3>
				<!--<hr style="margin-top:10px;margin-bottom:10px;">-->
				<p class="text">開業輔導</p>
				
			</td></tr>
			</table></div>
		</div>
</div>
</a>




	
	






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

