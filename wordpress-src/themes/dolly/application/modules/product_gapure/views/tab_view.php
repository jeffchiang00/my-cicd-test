
<label>商品名稱</label>
<textarea name="title_<?PHP echo $lang?>" rows="2" cols="50"><?PHP echo @$title?></textarea>

<label>商品副標</label>
<textarea name="subtitle_<?PHP echo $lang?>" rows="2" cols="50"><?PHP echo @$subtitle?></textarea>

<label>商品介紹(產地、尺寸、重量等)</label>
<textarea class="_ckeditor" name="description_<?PHP echo $lang?>" rows="2" cols="50"><?PHP echo @$description?></textarea>

<label>商品介紹(圖文)</label>
<div class="template_toolbar">
	
</div>
<div class="content_template <?PHP echo $lang?>">
	<?PHP echo @$content;?>
</div>