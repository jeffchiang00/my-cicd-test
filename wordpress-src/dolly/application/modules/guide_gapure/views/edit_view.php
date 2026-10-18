<style>
.ui-accordion-content{padding:0 !important;}
</style>
<h2 class="content-subhead" id="stacked-form">隱私權頁面 - <span id="ContentPlaceHolder1_lbl_title">編輯</span></h2>
<form id="frm" class="pure-form pure-form-stacked">
    <div style="">
        <div style="display: inline-block;">
            <button type="submit" class="pure-button notice">儲存</button>
        </div>
        <!-- <div style="display: inline-block;">
            <a href="<?PHP echo MODULE_URL?>" class="pure-button">回上頁</a>
        </div> -->
    </div>
    <hr>
    <input type="hidden" name="id" value="<?PHP echo (isset($row["id"]))?$row["id"]:"0" ?>">
    <label>發佈</label>
    <input type="radio" name="publish" value="1" <?PHP echo (@$row["publish"]=="1")?"checked":"" ?>>是
    <input type="radio" name="publish" value="0"  <?PHP echo (@$row["publish"]=="0"||!isset($row["publish"]))?"checked":"" ?>>否
    
    <label>文字內容</label>
    <div id="languages" style="width:896px">
        <ul>
            <li>
                <a href="#tab_en">
                    英文
                </a>
            </li>
            <li>
                <a href="#tab_tw">
                    繁體
                </a>
            </li>
            <li>
                <a href="#tab_cn">
                    簡體
                </a>
            </li>
        </ul>
        <div id="tab_en" class="tab_container">
            <?PHP echo $tab_en?>
        </div>
        <div id="tab_tw" class="tab_container">
            <?PHP echo $tab_tw?>
        </div>
        <div id="tab_cn" class="tab_container">
            <?PHP echo $tab_cn?>
        </div>
    </div>
</form>
<script>
$(function () {
    $('#frm').ajaxForm({
        beforeSubmit: function(arr, $form, options) {
            var content = [];
            $('textarea').each(function(idx){
                var text = CKEDITOR.instances[$(this).attr('name')].getData();
                text = text.replace(/\n/gi,"");
                //arr_text[idx] = encodeURI(arr_text[idx]);
                content.push(text);
            })
            var json = JSON.stringify(content);
            arr.push({name:'template_content', value:json});
        },
        url: '<?PHP echo MODULE_URL . '/save'?>',
        type: 'post',
        dataType: 'script'
    });

    $("#languages").tabs();
    
    $('.cover_img').myCoverUpload({
        img_url:'<?PHP echo IMG_URL?>',
        upload_url:'<?PHP echo MODULE_URL . '/upload/cover_img'?>',
        thumbnail_type:'fit',
        thumbnail_size:['450x450','210x210']
    });

    var config = new Object();
    config.toolbar = 'Basic';
    config.extraPlugins = 'stylesheetparser';
    //config.extraPlugins = 'autogrow'; //搭配JQUERY UI TAB怪怪的
    config.contentsCss = '<?PHP echo SITE_URL?>assets/admin/css/article_ck.css';
    config.stylesSet = [];
    config.autoGrow_onStartup = true;
    config.toolbar_Basic = [
        ['Bold', 'Italic', 'Underline', 'FontSize'],
        ['Link', 'Unlink'],
        ['TextColor', 'BGColor']
    ];
    $('textarea').ckeditor(function() {}, config);
})

</script>