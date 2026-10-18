<style>
.ui-accordion-content{padding:0 !important;}
</style>
<h2 class="content-subhead" id="stacked-form">文章管理 - <span id="ContentPlaceHolder1_lbl_title">編輯</span></h2>

<form id="frm" class="pure-form pure-form-stacked">
    <div style="">
        <div style="display: inline-block;">
            <button type="submit" class="pure-button notice">儲存</button>
        </div>
        <div style="display: inline-block;">
            <a href="<?PHP echo MODULE_URL?>" class="pure-button">回上頁</a>
        </div>
    </div>
    <hr>
    <input type="hidden" name="id" value="<?PHP echo (isset($row["id"]))?$row["id"]:"0" ?>">
    <label>發佈</label>
    <input type="radio" name="publish" value="1" <?PHP echo (@$row["publish"]=="1")?"checked":"" ?>>是
    <input type="radio" name="publish" value="0"  <?PHP echo (@$row["publish"]=="0"||!isset($row["publish"]))?"checked":"" ?>>否

    <label>大分類</label>
    <select name="type_id" class="type_id">
        <option value="1" <?PHP echo (@$row["type_id"]=="1")?"selected":"" ?>>最新消息(NEWS)</option>
        <option value="2" <?PHP echo (@$row["type_id"]=="2")?"selected":"" ?>>影片(VIDEOS)</option>
        <!--option value="3" <?PHP echo (@$row["type_id"]=="3")?"selected":"" ?>>媒體報導</option-->
    </select>
    <label>小分類</label>
    <select name="small_type_id" class="small_type_id">
        <option class="opt1" value="1" <?PHP echo (@$row["small_type_id"]=="1")?"selected":"" ?>>NEWS</option>
        <option class="opt2" value="2" <?PHP echo (@$row["small_type_id"]=="2")?"selected":"" ?>></option>
        <option class="opt3" value="3" <?PHP echo (@$row["small_type_id"]=="3")?"selected":"" ?>>REPORTS</option>
        <option class="opt4" value="4" <?PHP echo (@$row["small_type_id"]=="4")?"selected":"" ?>></option>
        <option class="opt5" value="5" <?PHP echo (@$row["small_type_id"]=="5")?"selected":"" ?>></option>
        <option class="opt6" value="6" <?PHP echo (@$row["small_type_id"]=="6")?"selected":"" ?>></option>
    </select>

    <script>
    $(document).ready(function(){  
        img_size1 = '500x324';
        img_size2 = '250x162';
        $(".opt2").hide();
        $(".opt4").hide();
        $(".opt5").hide();
        $(".opt6").hide();

        $(".type_id").change(function(){
            type_id = $(".type_id :selected").val();
            if(type_id == "1"){
                $(".opt1").text("NEWS");
                $(".opt2").css("display","none");//text("STORIES")  css("display","none")
                $(".opt3").text("EVENTS");
                $(".opt4").css("display","none");
                $(".opt5").css("display","none");
                $(".opt6").css("display","none");
                $('.cover_img_label').text("封面照 (500 x 500)");
                img_size1 = '500x500';
                img_size2 = '250x500';
            }
            else if(type_id == "2"){
                $(".opt1").text("MAKEUP");
                $(".opt2").css("display","block");
                $(".opt2").text("DRAWING");
                $(".opt3").text("SO CRAZY");
                $(".opt4").css("display","block");
                $(".opt4").text("LIVE");
                $(".opt5").css("display","block");
                $(".opt5").text("LIFESTYLE");
                $(".opt6").css("display","block");
                $(".opt6").text("HAIR");
                $('.cover_img_label').text("封面照 (500 x 324)");
                img_size1 = '500x324';
                img_size2 = '250x162';
            }
        });
    });
    </script>

    <label>日期</label>
    <input name="article_date" type="text" placeholder="" class="pure-input-1-4 date" value="<?PHP echo !isset($row['article_date'])?date('Y-m-d'):$row['article_date']?>">
    
    <label>Youtube 連結<br>
    ( 例如<a target="_blank" href="https://www.youtube.com/watch?v=IOEcELgbFP0">https://www.youtube.com/watch?v=<span style="color:red;">IOEcELgbFP0</span></a>，請填<span style="color:red;">IOEcELgbFP0</span>就好 )</label>
    <input name="youtube_url" type="text" placeholder="" class="pure-input-1-4" value="<?PHP echo @$row['youtube_url']?>">
    
    <label class="cover_img_label">封面照 (500 x 500)</label>
    <label><?PHP echo MODULE_URL ?></label>
    <input type="hidden" name="cover_img" class="cover_img" value="<?PHP echo @$row['cover_img']?>">

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
        //thumbnail_size:[img_size1,img_size2]
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