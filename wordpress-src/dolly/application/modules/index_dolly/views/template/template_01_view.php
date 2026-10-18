<div class="section">
	<input type="hidden" name="view_id[]" value="<?PHP echo $view_id?>">
	<h3>樣板<a href="javascript:void(0)" class="del_template" style="float:right;"><i class="icon-trash"></i>DELETE</a></h3>
	<div>
		<div class="template_img" style="max-width:100%;">
			<input type="hidden" name="template_img[]" value="<?PHP echo $img[0]?>">
			<input type="file" name="template_file_input" style="display:none;" >
			<img src="<?PHP echo $img[0]==''?$default_img[0]:IMG_URL.$img[0]?>" class="template_img_upload">
		</div>
		<div class="template_text" style="">
			<textarea id="template_text_<?PHP echo rand(1000,9999)?>"><?PHP echo $content[0]?></textarea>
		</div>
	</div>
</div>