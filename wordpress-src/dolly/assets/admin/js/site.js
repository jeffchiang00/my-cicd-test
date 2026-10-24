var uploaded = 0;
var img_url = "http://192.168.0.11/work/gapure-v01/";
var edit_view = {
    init: function() {
        edit_view.menu_click();
        $('.date_ui').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        $("textarea").autosize();
    },
    menu_click: function() {
        var menu = document.getElementById('menu'),
            menuLink = document.getElementById('menuLink'),
            layout = document.getElementById('layout'),
            toggleClass = function(element, className) {
                var classes = element.className.split(/\s+/),
                    length = classes.length,
                    i = 0;
                for (; i < length; i++) {
                    if (classes[i] === className) {
                        classes.splice(i, 1);
                        break;
                    }
                }
                // The className is not found
                if (length === classes.length) {
                    classes.push(className);
                }
                element.className = classes.join(' ');
            };

        menuLink.onclick = function(e) {
            e.preventDefault();
            var active = 'active';
            toggleClass(layout, active);
            toggleClass(menu, active);
        };
    },
    ckedit: function(obj, css) {
        console.log(css);
        var today = new Date();
        var config = new Object();
        var brand_id = $("select[name=brand_id] option:selected").val()
        config.toolbar = 'Basic';
        config.filebrowserImageUploadUrl = img_url + 'welcome/ckupload/upload/?brand_id=' + brand_id + "&backurl=http://admin.isabelle.com.tw/welcome/cktool";
        config.extraPlugins = 'stylesheetparser';
        config.extraPlugins = 'mediaembed';
        config.extraPlugins = 'autogrow';
        config.contentsCss = css;
        config.stylesSet = [];
        config.autoGrow_onStartup = true;
        config.toolbar_Basic = [
            ['Source'],
            ['Bold', 'Italic', 'Underline', 'FontSize'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink'],
            ['TextColor', 'BGColor'],
            ['Image', 'MediaEmbed', 'Table', 'HorizontalRule', 'SpecialChar']
        ];
        $(obj).ckeditor(function() {}, config);
    },
    cover_img: function(addr, obj, min, max, ratio) {
        var jcrop_api;
        var obj_id = obj;
        var obj = $("#" + obj);
        obj.find('input[type=file]').fileupload({
            change: function(e, data) {
                obj.find('.cover_loading').html('<i class="icon-spinner icon-spin"></i>');
            },
            beforeSend: function(e, data) {
                data.formData = {
                    brand_id: $("select[name=brand_id] option:selected").val()
                };
            },
            url: addr + '/upload/' + obj_id + '_img',
            sequentialUploads: true,
            dataType: 'json',
            done: function(e, data) {
                var json = data.result;
                if (!json.error) {
                    edit_view.showimg(json.file, obj, min, max, ratio);
                    var site_width = json.image_width;
                    edit_view.save_img(addr, obj_id, site_width);
                    obj.find('.cover_loading').empty();
                } else {
                    alert(json.error);
                }
            },
            dropZone: null
        });
    },
    save_img: function(addr, obj_id, site_width) {
        var obj = $("#" + obj_id);
        $("#save_img").unbind('click').bind('click', function() {
            var brand_id = $("select[name=brand_id] option:selected").val();
            var d = $("#crop_val").val() + "&file=" + $("#file_val").val() + "&brand_id=" + brand_id;
            var img_ratio = site_width / $(".jcrop-holder").width();
            var post_add = addr + "/crop?ra=" + img_ratio;
            switch (obj_id) {
                default: post_add = addr + "/crop/?ra=" + img_ratio;
                break;
            }
            if (obj)
                $.post(post_add, d, function(data) {
                    if (!data.error) {
                        // console.log(obj);
                        var ht = '<br><img src="' + img_url + 'upload/' + data.file + '" style="border:1px solid #cccccc"><a href="javascript:void(0)" onclick="edit_view.delete_img($(this))"><i class="icon-trash"></i>DELETE</a><br><br><input type="hidden" name="' + obj_id + '_img" value="' + data.file + '">';
                        obj.find(".cover_preview").html(ht);
                        $('#c_close').click();
                        $("body").animate({
                            scrollTop: obj.offset().top
                        });
                    } else {
                        alert(data.error);
                    }
                }, 'json');
        });
        $('#c_close').click(function() {
            $("#img_crop").hide();
            $('#img_crop img').attr("src", "");
            $("#file_val").val();
            jcrop_api.destroy();
            $("#crop_site").attr("style", "max-width:none;");
        });
    },
    cover_img2: function(addr, obj, min, max, ratio) {
        var jcrop_api;
        var obj_id = obj;
        var obj = $("#" + obj);
        obj.find('input[type=file]').fileupload({
            change: function(e, data) {
                obj.find('.cover_loading').html('<i class="icon-spinner icon-spin"></i>');
            },
            beforeSend: function(e, data) {
                data.formData = {
                    brand_id: $("select[name=brand_id] option:selected").val()
                };
            },
            url: addr + '/upload/' + obj_id + '_img',
            sequentialUploads: true,
            dataType: 'json',
            done: function(e, data) {
                var json = data.result;
                if (!json.error) {
                    edit_view.showimg(json.file, obj, min, max, ratio);
                    var site_width = json.image_width;
                    edit_view.save_img2(addr, obj_id, site_width);
                    obj.find('.cover_loading').empty();
                } else {
                    alert(json.error);
                }
            },
            dropZone: null
        });
    },
    save_img2: function(addr, obj_id, site_width) {
        var obj = $("#" + obj_id);
        $("#save_img").unbind('click').bind('click', function() {
            var brand_id = $("select[name=brand_id] option:selected").val();
            var d = $("#crop_val").val() + "&file=" + $("#file_val").val() + "&brand_id=" + brand_id;
            var img_ratio = site_width / $(".jcrop-holder").width();
            var post_add = addr + "/crop2?ra=" + img_ratio;
            switch (obj_id) {
                default: post_add = addr + "/crop2/?ra=" + img_ratio;
                break;
            }
            if (obj)
                $.post(post_add, d, function(data) {
                    if (!data.error) {
                        // console.log(obj);
                        var ht = '<br><img src="' + img_url + 'upload/' + data.file + '" style="border:1px solid #cccccc"><a href="javascript:void(0)" onclick="edit_view.delete_img($(this))"><i class="icon-trash"></i>DELETE</a><br><br><input type="hidden" name="' + obj_id + '_img" value="' + data.file + '">';
                        obj.find(".cover_preview").html(ht);
                        $('#c_close').click();
                        $("body").animate({
                            scrollTop: obj.offset().top
                        });
                    } else {
                        alert(data.error);
                    }
                }, 'json');
        });
        $('#c_close').click(function() {
            $("#img_crop").hide();
            $('#img_crop img').attr("src", "");
            $("#file_val").val();
            jcrop_api.destroy();
            $("#crop_site").attr("style", "max-width:none;");
        });
    },
    showimg: function(file, obj, min, max, ratio) {
        $("#img_crop").show();
        $('#img_crop img').attr("src", img_url + "upload/" + file);
        $("#file_val").val(file);
        $("body").animate({
            scrollTop: 0
        });
        $("#crop_site").Jcrop({
            bgFade: true,
            bgOpacity: .2,
            bgColor: 'black',
            onChange: showCoords,
            onSelect: showCoords
        }, function() {
            jcrop_api = this;
            if (min != '') {
                jcrop_api.setOptions({
                    minSize: min,
                    setSelect: [min[0], min[1], 0, 0]
                });
            }
            if (max != '') {
                jcrop_api.setOptions({
                    maxSize: max
                });
            }
            if (ratio != '') {
                jcrop_api.setOptions({
                    aspectRatio: ratio
                });
                jcrop_api.setSelect([0,0,$('#img_crop img').width(),$('#img_crop img').height()/ratio]);
            }
            else{
                jcrop_api.setSelect([0,0,$('#img_crop img').width(),$('#img_crop img').height()]);
            }
        });

        function showCoords(c) {
            var c_val = "width=" + c.w + "&height=" + c.h + "&x=" + c.x + "&y=" + c.y;
            $("#crop_val").val(c_val);
        }
    },
    delete_img: function(obj) {
        if (!confirm('刪除?')) return;
        var target = obj.parent();
        target.empty();
    },
    gallery_img: function(addr, obj) {
        var obj_id = obj;
        var obj = $("#" + obj_id);
        obj.find('input[type=file]').fileupload({
            change: function(e, data) {
                $.each(data.files, function(index, file) {
                    obj.find('.gallery').append('<div id="' + obj_id + '_temp_' + (uploaded + index) + '" class="gallery_img"><div class="loading"><i class="icon-spinner icon-spin"></i><br><span></span></div></div>');
                })
            },
            beforeSend: function(e, data) {
                data.formData = {
                    brand_id: $("select[name=brand_id] option:selected").val()
                };
            },
            url: addr + "/gallery_upload/" + obj_id + "_file",
            sequentialUploads: true,
            dataType: 'json',
            done: function(e, data) {
                $('#' + obj_id + '_temp_' + uploaded).html('<img src="' + img_url + 'upload/' + data.result.file + '" style=""><br><a href="javascript:void(0)" onclick="edit_view.delete_img_gallery($(this))"><i class="icon-trash"></i>DELETE</a><input type="hidden" name="' + obj_id + '_img[]" value="' + data.result.file + '">');
                uploaded++;
            },
            dropZone: null,
            progress: function(e, data) {
                $.each(data.files, function(index, file) {
                    //console.log(file.name);
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#' + obj_id + '_temp_' + uploaded).find('span').html(progress + "%")
                });
            }
        });
        edit_view.gallery_sort(obj);
    },
    gallery_sort: function(obj) {
        obj.find('.gallery').sortable({
            placeholder: "sortable-placeholder"
        });
    },
    delete_img_gallery: function(obj) {
        if (!confirm('確定刪除?')) return;
        var target = obj.parent();
        target.remove();
    },
    form_set: function(obj, addr, beforesubmit) {
        obj.ajaxForm({
            forceSync: true,
            beforeSubmit: beforesubmit,
            url: addr,
            type: 'post',
            dataType: 'script'
        });
    }
}

///////list_view //////////


var list_view = {
        init: function() {

        },
        publish: function(obj, addr) {
            var q = "id=" + obj.attr('value');
            if (obj.prop("checked")) {
                q += "&publish=1"
            } else {
                q += "&publish=0"
            }
            $.post(addr, q, null, 'script');
        },
        del: function(id, addr) {
            if (!confirm('確認刪除?')) return;
            $.post(addr, 'id=' + id, null, 'script');
        },
        sort: function(addr) {
            $('tbody').sortable({
                handle: ".icon-move",
                items: "tr:not(.top)",
                placeholder: "sortable-placeholder",
                start: function(event, ui) {
                    $('.sortable-placeholder').append('<td colspan="20">&nbsp;</td>')
                },
                stop: function(event, ui) {
                    var q = '';
                    $('.icon-move').each(function(index, element) {
                        q += '&id[]=' + $(this).attr('value');
                    });
                    $.post(addr, q)
                }
            });
        }
    }
    ///個別專案需求
var project = {}


//封面上傳
;(function($) {
    $.fn.myCoverUpload = function(settings) {
        var _defaultSettings = {
            img_url:'aaa',
            upload_url:'aaa',
            thumbnail_type:'origin',
            thumbnail_size:[],
            crop_min:[0,0],
            img_src:''
        };
        var _settings = $.extend(_defaultSettings, settings);
        var _show_preivew = function(instance,json){
            var file_name = json.file;
            var img = $('<img src="' + _settings.img_url + file_name + '" style="border:1px solid #cccccc; max-width:300px">');
            var btn_delete = $('<a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a>');
            instance.parent().prev().val(file_name);
            btn_delete.on('click',function(){
                instance.parent().find('.myCoverUpload_preview').empty();
            })
            instance.parent().find('.myCoverUpload_preview')
                .empty()
                .append('<br>')
                .append(img)
                .append('<br>')
                .append(btn_delete)
                .append('<br>')
                .append('<br>')
        }
        return this.each(function(idx) {
            var container = $('<div class="myCoverUpload_container"></div>'),
                file_input = $('<input name="myCoverUpload_instance_' + idx + '" type="file" placeholder="" class="pure-input">'),
                loading = $('<span class="myCoverUpload_loading"></span>'),
                preview = $('<div class="myCoverUpload_preview"></div>'),
                arr_size = JSON.stringify(_settings.thumbnail_size);
            container.append(file_input).append(loading).append(preview);
            $(this).after(container);
            file_input.fileupload({
                formData: {
                    thumbnail_type:_settings.thumbnail_type,
                    thumbnail_size: arr_size
                },
                change: function(e, data) {
                    $(this).next().html('<i class="icon-spinner icon-spin"></i>');
                },
                beforeSend: function(e, data) {
                },
                fileuploadsubmit:function (e, data) {
                },
                url: _settings.upload_url,
                sequentialUploads: true,
                dataType: 'json',
                done: function(e, data) {
                    var json = data.result;
                    if (!json.error) {
                        $(this).next().html('');
                        switch(_settings.thumbnail_type){
                            case 'crop':
                            default:
                                _show_preivew($(this),json);
                                break;
                        }
                    } else {
                        alert(json.error);
                    }
                },
                dropZone: null
            });
            
            if ($(this).val()){
                _show_preivew(file_input,{file:$(this).val()})
            }
        });
    };
})(jQuery);

;(function($) {
    $.fn.myGalleryUpload = function(settings) {
        var _defaultSettings = {
            img_url:'aaa',
            upload_url:'aaa',
            thumbnail_type:'origin',
            thumbnail_size:[],
            crop_min:[0,0],
            img_src:'',
            max_imgs:6,
            uploaded:0
        };
        var _settings = $.extend(_defaultSettings, settings);
        var _show_preivew = function(instance,json){
            var file_name = json.file;
            var img = $('<img src="' + _settings.img_url + file_name + '" style="border:1px solid #cccccc; max-width:140px">');
            var btn_delete = $('<a href="javascript:void(0)"><i class="icon-trash"></i>DELETE</a>');
            instance.parent().prev().val(file_name);
            btn_delete.on('click',function(){
                $(this).parents('.myGalleryUpload_item').remove();
            })

            var img_item = $('<div class="myGalleryUpload_item" style="float:left"></div>');
            img_item
                .append('<input type="hidden" name="gallery[]" value="' + file_name + '">')
                .append('<br>')
                .append(img)
                .append('<br>')
                .append(btn_delete)
                .append('<br>')
                .append('<br>')
            instance.parent().find('.myGalleryUpload_preview').append(img_item)
        }
        return this.each(function(idx) {
            var container = $('<div class="myGalleryUpload_container"></div>'),
                //file_input = $('<input name="myGalleryUpload_instance_' + idx + '" type="file" placeholder="" class="pure-input" multiple>'),
                file_input = $('<input name="myGalleryUpload_instance" type="file" placeholder="" class="pure-input" multiple>'),
                loading = $('<span class="myGalleryUpload_loading"></span>'),
                preview = $('<div class="myGalleryUpload_preview"></div>'),
                arr_size = JSON.stringify(_settings.thumbnail_size),
                html = $(this).html() //已上傳照片
            $(this).html('');
            container.append(file_input).append(loading).append(preview);
            $(this).append(container).append('<div style="clear:both;"></div>');
            file_input.fileupload({
                formData: {
                    thumbnail_type: _settings.thumbnail_type,
                    thumbnail_size: arr_size
                },
                change: function(e, data) {
                    $(this).next().html('<i class="icon-spinner icon-spin"></i>');
                },
                beforeSend: function(e, data) {
                },
                fileuploadsubmit:function (e, data) {
                },
                url: _settings.upload_url,
                sequentialUploads: true,
                dataType: 'json',
                done: function(e, data) {
                    var json = data.result;
                    if (!json.error) {
                        $(this).next().html('');
                        switch(_settings.thumbnail_type){
                            case 'crop':
                            default:
                                _show_preivew($(this),json);
                                break;
                        }
                    } else {
                        alert(json.error);
                    }
                },
                dropZone: null
            });
            
            if (html!=''){
                var temp = $('<div>'+html+'</div>');
                temp.find('input[type="hidden"]').each(function(){
                    _show_preivew(file_input,{file:$(this).val()})
                })
                //_show_preivew(file_input,{file:$(this).val()})
            }

            preview.sortable({placeholder: "sort-grid-highlight"});
        });
    };
})(jQuery);

//樣板模組
;(function($) {
    $.fn.myTemplate = function(settings) {
        var _defaultSettings = {
            upload_url:'',
            view_loader_url:'',
            template_info:[],
            ckcss:''
        };
        var _settings = $.extend(_defaultSettings, settings);
        var _add_template = function(btn_instance){
            var language_index = btn_instance.parents('.tab_container').index()-1,
                template_container = btn_instance.parent().next(),
                template_selected = btn_instance.parent().find('input[type="radio"]:checked').index('.my_template_toolbar:eq('+language_index+') input'),
                view_id = btn_instance.parent().find('input[type="radio"]:checked').val(),
                view = _settings.template_info[template_selected].view,
                section_count = template_container.find('.section').length + 1
            
            $.post(_settings.view_loader_url,'view_id='+view_id+'&view='+view+'&section_idx='+section_count+'&rand='+Math.random(),function(data){
                var section = $(data);
                template_container.append(section);
                _accordion(template_container);
                _set_template_input(section)
            },'html')
        }
        var _accordion = function(instance){
            if(typeof instance.data("ui-accordion") != "undefined"){
                instance.accordion("destroy");
            }
            instance.accordion({
                header: "> div > h3",
                collapsible:true,
                autoHeight:false,
                heightStyle: "content",
                active:instance.find('.section').length-1,
                activate: function(event, ui) {
                    $(this).find('.template_text').attr('contenteditable',true);
                }
            }).sortable({
                items:"div.section",
                axis: "y",
                handle:'h3',
                distance: 20 ,
                scroll: false,
                start: function(event, ui){
                    var textareaId = ui.item.find('textarea').attr('id');
                    if (typeof textareaId != 'undefined') {
                        var editorInstance = CKEDITOR.instances[textareaId];
                        editorInstance.destroy();
                        CKEDITOR.remove( textareaId );
                    }
                },
                stop: function(event, ui){
                    var textareaId = ui.item.find('textarea').attr('id');
                    if (typeof textareaId != 'undefined') {
                        //CKEDITOR.replace( textareaId );
                    }
                    _set_template_input(ui.item)
                }
            }).disableSelection;
        }

        var _set_template_input = function(section){
            //設定上傳
            section.find('.template_img_upload').css('cursor','pointer').on('click',function(){
                var target_img = $(this);
                target_img.prev().fileupload({
                    formData: {
                        width: target_img.width()
                    },
                    change: function(e, data) {
                        //$(this).next().html('<i class="icon-spinner icon-spin"></i>');
                    },
                    beforeSend: function(e, data) {
                    },
                    fileuploadsubmit:function (e, data) {
                    },
                    url: _settings.upload_url,
                    sequentialUploads: true,
                    dataType: 'json',
                    done: function(e, data) {
                        var json = data.result;
                        if (!json.error) {
                            var file_name = json.file;
                            target_img.attr('src',json.img_url + json.file)
                            target_img.prev().prev().val(json.file);
                        } else {
                            alert(json.error);
                        }
                    },
                    dropZone: null
                })
                .trigger('click');
            })
            
            //ck
            var config = new Object();
            config.toolbar = 'Basic';
            config.extraPlugins = 'stylesheetparser';
            //config.extraPlugins = 'autogrow'; //搭配JQUERY UI TAB怪怪的
            config.contentsCss = _settings.ckcss;
            config.stylesSet = [];
            config.autoGrow_onStartup = true;
            config.toolbar_Basic = [
                ['Source'],
                ['Bold', 'Italic', 'Underline', 'FontSize'],
                ['Link', 'Unlink'],
                ['TextColor', 'BGColor'],
                ['MediaEmbed']
            ];
            section.find('.template_text textarea').ckeditor(function() {}, config);

            section.find('a.del_template').on('click',function(){
                if (confirm('確定要刪除樣板？')==false) return false;
                var section = $(this).parents('.section');
                //CKEDITOR要一併刪除
                var textarea = section.find('textarea');
                textarea.each(function(){
                    var editorInstance = CKEDITOR.instances[$(this).attr('id')];
                    editorInstance.destroy();
                    console.log($(this).attr('id'));
                })
                var template_container = section.parent();
                section.remove();
                _accordion(template_container);
            })
        }

        return this.each(function(idx) {
            //設定template選項
            var default_value = $(this).html();
            $(this).empty();
            var template_toolbar = $('<div class="my_template_toolbar"></div>');
            $(this).append(template_toolbar);
            for(key=0;key<_settings.template_info.length;key++){
                var checked = '';
                if (key==0) checked = 'checked';
                var input_radio = $('<input type="radio" name="myTemplate_radio_'+idx+'" value="'+_settings.template_info[key].id+'" ' + checked + '>');
                var img = $('<img src="'+_settings.template_info[key].img+'">');
                template_toolbar.append(input_radio).append(img);
            }
            var btn_add = $('<a class="pure-button">新增樣板</a>');
            template_toolbar.append('<br>').append('<br>').append(btn_add);
            btn_add.on('click',function(){_add_template($(this))})

            //設定accordion
            var template_container = $('<div class="my_template_accordion" style="margin:10px 0"></div>');
            $(this).append(template_container);
            template_container.append(default_value);
            _accordion(template_container);
            _set_template_input(template_container.find('.section'))
        });
    };
})(jQuery);
