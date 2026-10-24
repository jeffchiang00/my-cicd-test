<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?PHP echo SITE_TITLE_ADMIN?></title>
<link rel="stylesheet" href="http://necolas.github.io/normalize.css/2.1.2/normalize.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
<link rel="stylesheet" href="<?PHP echo SITE_URL?>assets/admin/css/theme.css">
<style>
</style>
<script src="<?PHP echo SITE_URL?>assets/admin/js/jquery-1.11.0.min.js"></script>
<script src="<?PHP echo SITE_URL?>assets/admin/js/jquery.form.min.js"></script>
<script>
$(function(){
	$('#frm').ajaxForm({
		beforeSubmit: function(a, f, o) {
			q = $('#frm').formSerialize();
			$.post(self.url,q,null,'script');
			return false;
		}
	});
})
</script>
</head>
<body>
<div class="pure-g">
    <div class="pure-u-1" style="max-width:300px; margin:0 auto;">
    <form class="pure-form" id="frm" autocomplete="off">
    	<legend><?PHP echo SITE_TITLE_ADMIN?></legend>
        <fieldset class="pure-group">
            <input type="text" name="username" class="pure-input-1" placeholder="Username" title="Username">
            <input type="password" name="password" class="pure-input-1" placeholder="Password" title="Password">
        </fieldset>
    
        <button type="submit" class="pure-button pure-input-1 notice">Sign in</button>
    </form>
    </div>
</div>
</body>

</html>