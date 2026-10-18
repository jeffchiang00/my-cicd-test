<style>
.ui-accordion-content{padding:0 !important;}


.sort-grid-highlight{
    float:left;
    width:142px;
    height:142px;
    background-color:#FFC;
    margin-top:20px;
}
.ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
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
    <input type="text" class="pure-input-1-4 num" name="price" value="<?PHP echo @$row['price']?>">

    <label>特價</label>
    <input type="text" class="pure-input-1-4 num" name="s_price" value="<?PHP echo @$row['special_price']?>">

    <label>購買連結</label>
    <input type="text" class="pure-input-1-4 num" name="buy_url" value="<?PHP echo $row['buy_url']?>">

    <label>上架日期</label>
    <input name="article_date" type="text" placeholder="" class="pure-input-1-4 date" value="<?PHP echo !isset($row['article_date'])?date('Y-m-d'):$row['article_date']?>">
    
    <label>封面照 (450 x 450)</label>
    <input type="hidden" name="cover_img" class="cover_img" value="<?PHP echo @$row['cover_img']?>">

    <!--
    <label>商品規格</label>
    <select name="color" style="display:inline;">
        <option value="0">選擇顏色</option>
        <?PHP foreach($color_list as $color):?>
        <option value="<?PHP echo $color['id']?>"><?PHP echo $color['title_tw']?></option>
        <?PHP endforeach;?>
    </select>
    <a href="javascript:void(0)" class="add_product_color">新增顏色</a><br><br>
    <div id="spec" style="width:896px; <?PHP echo count($product_item)>0?'':'display:none;'?>">
        <ul>
            <?PHP foreach($product_item as $row):?>
            <li><a href="#spec_<?PHP echo $row['color_id']?>"><?PHP echo $row['color_text']?></a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
            <?PHP endforeach;?>
        </ul>
        <?PHP foreach($product_item as $row):?>
        <div id="spec_<?PHP echo $row['color_id']?>" class="color_tab_container"><?PHP echo $row['tab_view']?></div>
        <?PHP endforeach;?>
    </div>-->



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

    //咖啡風味設定
    $('th.coffee,td.coffee').hide();
    $('input[type="checkbox"][value="11"]').bind('change',function(){
        var checked = $(this).is(':checked');
        if (checked){
            $('th.coffee,td.coffee').show();
        }
        else{
            $('th.coffee,td.coffee').hide();
        }
    }).trigger('change');


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
            $('#spec .ui-tabs-nav li').each(function(){
                $('#'+$(this).attr('aria-controls')).each(function(){
                    var color_item = {};
                    color_item.color_id = $(this).find('input[name="color"]').val();
                    color_item.gallery = [];
                    $(this).find('input[name="gallery[]"]').each(function(){
                        color_item.gallery.push($(this).val());
                    })
                    color_item.items = [];
                    $(this).find('tr').each(function(idx){
                        var obj = {}
                        if (idx>0){
                            obj.publish = $(this).find('input[name="item_publish[]"]:checked').length>0?1:0;
                            obj.itemid = $(this).find('input[name="itemid[]"]').val();
                            obj.size = $(this).find('input[name="size[]"]').val();
                            obj.qty = $(this).find('input[name="qty[]"]').val();
                            obj.price = $(this).find('input[name="price[]"]').val();
                            obj.s_price = $(this).find('input[name="s_price[]"]').val();
                            obj.sku = $(this).find('input[name="sku[]"]').val();

                            //風味
                            coffee_taste = '';
                            $(this).find('input[type="radio"]:checked').each(function(idx){
                                if (idx>0){
                                    coffee_taste += ',';
                                }
                                coffee_taste += $(this).val();
                            })
                            obj.coffee_taste = coffee_taste;

                            color_item.items.push(obj)
                        }
                    })
                    arr_item.push(color_item)
                })
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
    $('#spec').tabs();
    $('#spec').find( ".ui-tabs-nav" ).sortable({
        axis: "x",
        stop: function() {
            $('#spec').tabs( "refresh" );
        }
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

    $('.add_product_color').on('click',function(){
        product_new_item_tab();
    })
    
    
    $('.gallery').myGalleryUpload({
        img_url:'<?PHP echo IMG_URL?>',
        upload_url:'<?PHP echo MODULE_URL . '/upload/gallery_img'?>',
        thumbnail_type:'fit',
        thumbnail_size:['450x450','140x140']
    });

    $('.cover_img').myCoverUpload({
        img_url:'<?PHP echo IMG_URL?>',
        upload_url:'<?PHP echo MODULE_URL . '/upload/cover_img'?>',
        thumbnail_type:'fit',
        thumbnail_size:['450x450','210x210']
    });

    set_product_item()
})

function product_new_item_tab(){
    var color_id = $('select[name="color"]').val();
    var color_text = $('select[name="color"] option:selected').text();
    if (color_id==0) {
        alert('請選擇顏色');
        return false;
    }

    if ($('.color_tab_container>input[value="' + color_id + '"]').length>0){
        alert(color_text + '已經存在');
        return false;
    }

    $.post('<?PHP echo MODULE_URL?>/color_template','color_id='+color_id,function(data){
        var li = $('<li><a href="#spec_' + color_id + '">' + color_text + '</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>');
        $('#spec ul').append(li);
        $('#spec').append('<div id="spec_' + color_id + '" class="color_tab_container">' + data + '</div>');
        $('#spec').tabs( "refresh" );
        $('.gallery').myGalleryUpload({
            img_url:'<?PHP echo IMG_URL?>',
            upload_url:'<?PHP echo MODULE_URL . '/upload/gallery_img'?>',
            thumbnail_type:'fit',
            thumbnail_size:['450x450','140x140']
        });
        set_product_item()
        $('#spec').show();
        li.find('a').trigger('click');
    })
}

function set_product_item(){
    $('#spec tbody').sortable();
    $('.add_product_item').off('click').on('click',function(){
        var table = $(this).parent()
        if (table.find('td').length>0){
            var rand = Math.floor((Math.random() * 1000) + 1000);
            var tr = table.find('tr:last').clone();
            tr.find('input[name="itemid[]"]').val(0);
            tr.find('input[type="radio"]').each(function(){
                var name = $(this).attr('name').substring(0,6) + rand + '[]';
                $(this).attr('name',name);
            })  
            table.find('tbody').append(tr);
            set_product_item()
            return;
        }
        $.post('<?PHP echo MODULE_URL . '/product_item'?>',function(data){
            var item = $(data)
            item.find('input[name="itemid[]"]').val(0)
            table.find('tbody').append(item);
            set_product_item();
        })
    })
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