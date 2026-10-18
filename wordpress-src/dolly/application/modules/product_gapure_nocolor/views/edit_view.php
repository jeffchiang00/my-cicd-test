<style>
.ui-accordion-content{padding:0 !important;}


.sort-grid-highlight{
    float:left;
    width:142px;
    height:142px;
    background-color:#FFC;
    margin-top:20px;
}

</style>
<h2 class="content-subhead" id="stacked-form">商品管理 - <span id="ContentPlaceHolder1_lbl_title">編輯</span></h2>
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

    <!-- <label>分類</label>
    <select name="type_id">
        <option value="1">新聞</option>
        <option value="2">故事</option>
        <option value="3">媒體報導</option>
    </select> -->

    <?PHP $tag_type = 0;?>
    <?PHP foreach($brand_list as $brand):?>
    <?PHP 
    if($tag_type!=$brand['parentid']){
        $tag_type = $brand['parentid'];
        switch($tag_type){
            case 1:
                $str_type = '品牌';
                break;
            case 2:
                $str_type = '類別';
                break;
            case 3:
                $str_type = '標籤';
                break;
        }
        echo "<br><label>{$str_type}</label>";
    }
    ?>
    <input class="brand_check" name="brand[]" value="<?PHP echo $brand['id']?>" type="checkbox" <?PHP echo $brand['selected']==1?'checked':''?>> <?PHP echo $brand['title_tw']?> 
    <?PHP endforeach;?>

    <label>價格</label>
    <input type="text" class="num" name="price" size="3" value="<?PHP echo @$row['price']?>">

    <label>特價</label>
    <input type="text" class="num" name="s_price" size="3" value="<?PHP echo @$row['special_price']?>">

    <label>上架日期</label>
    <input name="article_date" type="text" placeholder="" class="pure-input-1-4 date" value="<?PHP echo !isset($row['article_date'])?date('Y-m-d'):$row['article_date']?>">
    
    <label>封面照 (450 x 450)</label>
    <input type="hidden" name="cover_img" class="cover_img" value="<?PHP echo @$row['cover_img']?>">
    
    <label>商品照 (450 x 450)</label>
    <div class="gallery">
        <?PHP foreach($gallery as $img):?>
            <div class="myGalleryUpload_item" style="float:left">
                <input type="hidden" name="gallery[]" value="<?PHP echo $img['filename']?>"><br>
                <img src="<?PHP echo IMG_URL.$img['filename']?>" style="border:1px solid #cccccc; max-width:140px"><br>
                <a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a><br><br>
            </div>
        <?PHP endforeach;?>
    </div>
    <label>商品規格</label>
    <div id="spec">
        <table class="pure-table pure-table-bordered">
            <thead>
                <tr>
                    <th>發佈</th>
                    <th>尺寸</th>
                    <th>數量</th>
                    <!-- <th>價格</th>
                    <th>特價</th> -->
                    <th>貨號</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?PHP foreach($product_item as $item):?>
                <tr>
                    <td><input type="checkbox" name="item_publish[]" <?PHP echo $item['publish']==1?"checked":""?>><input type="hidden" name="itemid[]" value="<?PHP echo $item['id']?>"><i class="icon-move"></i></td>
                    <td><input type="text" name="size[]" size="3" value="<?PHP echo $item['size']?>"></td>
                    <td><input type="text" class="num" name="qty[]" size="3" value="<?PHP echo $item['qty']?>"></td>
                    <!-- <td><input type="text" class="num" name="price[]" size="3" value="<?PHP echo $item['price']?>"></td>
                    <td><input type="text" class="num" name="s_price[]" size="3" value="<?PHP echo $item['special_price']?>"></td> -->
                    <td><input type="text" name="sku[]" value="<?PHP echo $item['sku']?>"></td>
                    <td><a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a></td>
                </tr>
                <?PHP endforeach;?>
            </tbody>
        </table>
        <a href="javascript:void(0)" class="add_product_item"><i class="icon-plus"></i>新增尺寸</a>
    </div>

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
                alert('請輸入英文商品名稱');
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

            //商品規格
            var arr_item = [];
            $('#spec tr').each(function(idx){
                var obj = {}
                if (idx>0){
                    obj.publish = $(this).find('input[name="item_publish[]"]:checked').length>0?1:0;
                    obj.itemid = $(this).find('input[name="itemid[]"]').val();
                    obj.size = $(this).find('input[name="size[]"]').val();
                    obj.qty = $(this).find('input[name="qty[]"]').val();
                    obj.price = $(this).find('input[name="price[]"]').val();
                    obj.s_price = $(this).find('input[name="s_price[]"]').val();
                    obj.sku = $(this).find('input[name="sku[]"]').val();
                    arr_item.push(obj)
                }
            })
            var json_product_item = JSON.stringify(arr_item);
            arr.push({name:'product_item', value:json_product_item});
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
    
    $('.gallery').myGalleryUpload({
        img_url:'<?PHP echo IMG_URL?>',
        upload_url:'<?PHP echo MODULE_URL . '/upload/gallery_img'?>',
        thumbnail_type:'fit',
        thumbnail_size:['450x450','140x140']
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
    $('._ckeditor').ckeditor(function() {}, config);

    $('#spec tbody').sortable();
    product_item_init()
    $('.add_product_item').on('click',function(){
        if ($('#spec td').length>0){
            var tr = $('#spec tr:last').clone();
            tr.find('input[name="itemid[]"]').val(0)
            $('#spec tbody').append(tr);
            product_item_init()
            return;
        }
        $.post('<?PHP echo MODULE_URL . '/product_item'?>',function(data){
            var item = $(data)
            item.find('input[name="itemid[]"]').val(0)
            $('#spec tbody').append(item);
            product_item_init();
        })
    })
    
})

function product_item_init(){
    $('.icon-move').css('visibility', 'hidden');
    $('td').hover(
        function () {
            $(this).find('.icon-move').css('visibility', 'visible');
        },
        function () {
            $(this).find('.icon-move').css('visibility', 'hidden');
        }
    );
    $('#spec tbody a').off('click').on('click',function(){
        $(this).parents('tr').remove();
    })
}

</script>