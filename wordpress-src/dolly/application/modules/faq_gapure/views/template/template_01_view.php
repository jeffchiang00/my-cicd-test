<div class="section">
	<input type="hidden" name="view_id[]" value="<?PHP echo $view_id?>">
	<h3>樣板<a href="javascript:void(0)" class="del_template" style="float:right;"><i class="icon-trash"></i>DELETE</a></h3>
	<div>
		<div style="padding:0 10px;">
			<label>問</label>
			<input type="text" class="pure-input-1-2" id="template_text_<?PHP echo rand(1000,9999)?>" value="<?PHP echo $input[0]?>">

			<label>答</label>
			<div class="template_text" style="">
				<textarea id="template_text_<?PHP echo rand(1000,9999)?>"><?PHP echo $content[0]?></textarea>
			</div>
		</div>
	</div>
</div>