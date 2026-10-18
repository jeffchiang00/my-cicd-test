<style>
a:hover, a:link, a:visited {
  text-decoration: none;
  color:#000;
}
</style>


<div class="container">
<div class="col-md-10 col-md-offset-1" style="min-height:600px;">
  <div class="row">
<?PHP 
       
        foreach($row as $key => $rows){
?>

<div class="col-md-4" style="height:300px;text-align:center;">
	<a href="<?php echo SITE_URL ?>product/item/<?php echo $rows['id']; ?>">
	<div class="img-caption-out">	
	  <img style="width:100%;" src="<?PHP echo IMG_URL . $rows['filename']?>" />
		<div class="img-caption" style=" background-color: rgba(0, 0, 0, 0) !important;"><div style="height: 100%;">
			<table style="margin-top: 100%;opacity: 0;">
			<tr><td>
				
				<img width="100" src="<?php echo SITE_URL;?>/assets/images/ming/ming_logo.png" />
				
			</td></tr>
			</table></div>
		</div>
	</div>


	  <h4 style="margin-top:30px;"><?php echo $rows['title_tw']; ?></h4>
	  <p><?php echo $rows['subtitle_tw']; ?></p>
	  <p><?php echo "售價: " . $rows['special_price'] . " NT"; ?>
		<?php 
			$x = $rows['tag_id'];
			if ($x == 14){
				echo " 1磅";
			}
		 ?>

	  </p>
	</a>

</div>


         


<?php } ?>
  </div>
</div>
</div>

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



