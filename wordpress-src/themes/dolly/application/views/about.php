 <section class="about">
 	<div class="col-md-5 col-md-offset-7">
 		<h2 class="dollipop_h2title">守屋幸慈 Dolly</h2>
 		<p>嗨～我是守屋幸慈，也可以叫我朵莉兒～</p>
 		<p>我是中日、原住民混血，喜歡唱歌跳舞</p>
 		<p>拍攝美妝與各式影音教學，分享各種有趣的事物給大家</p>

 	</div>

 </section>
  <section class="bg_gray">
  	<div class="container text-center">
  		<div class="about_cat"><a class="change5">美妝</a><a class="change6">個人</a></div>

  		 		<?PHP 
                    
                    foreach($rs as $row):
                        $template_content = json_decode(urldecode($row['template_content']));
                        $arr_faq = array();
                        $title = $row['title_tw'];
                        $id = $row['id'];
                        $arr_faq = $template_content[1];
                        $idx = 1;
                ?>

  		<div class="change<?php echo $id;?>_div">
  			<?PHP foreach($arr_faq as $item2):
  			$sn = substr('00' . $idx,-2); ?>
	  		<div class="col-md-3 col-sm-4 col-xs-6 about_block text-center">
	  			<div class="col-xs-12">
		  			<span>Q<?PHP echo $sn?></span>
		  			<div class="text-center">
		  				<h4 class="mt75 question"><?PHP echo $item2->input[0];?></h4>
		  				<?PHP echo $item2->text[0]?>
		  			</div>
		  			
	  			</div>
	  		</div>
			<?PHP $idx++; endforeach;?>
  		</div>
			<?PHP 
            	endforeach;
            ?>
  		


		</div>
  	</div>
  </section>


 