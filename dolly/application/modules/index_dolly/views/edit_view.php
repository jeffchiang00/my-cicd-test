<style>
.ui-accordion-content{padding:0 !important;}
</style>
<h2 class="content-subhead" id="stacked-form">關於我們 - <span id="ContentPlaceHolder1_lbl_title">編輯</span></h2>
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
            if ($('textarea[name="title_en"]').val()==""){
                alert('請輸入英文標題');
                return false;
            }
            var content = [];
            $('.my_template_accordion').each(function(){
                var arr_content = [];
                $(this).find('.section').each(function(){
                    var obj = {};

                    obj.view_id = $(this).find('input[name="view_id[]"]').val();

                    var textarea = $(this).find('textarea');
                    var arr_text = [];
                    textarea.each(function(idx){
                        arr_text[idx] = CKEDITOR.instances[$(this).attr('id')].getData();
                        arr_text[idx] = arr_text[idx].replace(/\n/gi,"");
                        //arr_text[idx] = encodeURI(arr_text[idx]);
                    })
                    obj.text = arr_text;

                    var img = $(this).find('input[name="template_img[]"]')
                    var arr_img = [];
                    img.each(function(idx){
                        arr_img[idx] = $(this).val();
                    })
                    obj.img = arr_img;

                    arr_content.push(obj);
                })
                content.push(arr_content);
            })
            var json = JSON.stringify(content);
            arr.push({name:'template_content', value:json});
        },
        url: '<?PHP echo MODULE_URL . '/save'?>',
        type: 'post',
        dataType: 'script'
    });

    $('.date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy-mm-dd"
    });

    $("#languages").tabs();
    
    $('.cover_img').myCoverUpload({
        img_url:'<?PHP echo IMG_URL?>',
        upload_url:'<?PHP echo MODULE_URL . '/upload/cover_img'?>',
        thumbnail_type:'fit',
        thumbnail_size:['450x450','210x210']
    });

    var arr_template = [
        {id:1,img:'<?PHP echo SITE_URL?>assets/admin/images/article_template_01.png',view:'template_01_view'},
        {id:2,img:'<?PHP echo SITE_URL?>assets/admin/images/article_template_02.png',view:'template_02_view'}
    ]
    $('.content_template').myTemplate({
        upload_url:'<?PHP echo MODULE_URL . '/upload/template_upload'?>',
        view_loader_url:'<?PHP echo MODULE_URL . '/template'?>',
        template_info:arr_template,
        ckcss:'<?PHP echo SITE_URL?>assets/admin/css/article_ck.css'
    });
})

</script>