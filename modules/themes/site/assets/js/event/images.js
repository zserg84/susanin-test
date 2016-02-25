var init_select_cover = function() {
    var $input = $('.js_input_change_cover'),     //js_input_event_change_cover
        $img_box_preview = $('.js_cover_preview'),    //js_event_cover_preview
        $img_box_crop = $('.js_image_crop_box'),
        //$popup = $('#popup_crop_image'),      //popup_event_crop_image
        $ghost = $('#image_ghost'),
        _file, FAImg, FAImgGhost,
        $cropper = $('._cropper'),
        _dnr = false,
        size = $img_box_preview.data('mixsize'),
        size_w = $img_box_preview.data('mixsize-w'),
        size_h = $img_box_preview.data('mixsize-h');
        //cW=size, cH=size,
    //size_w = size_w ? size_w : size;
    //size_h = size_h ? size_h : size;
    var cW=size_w, cH=size_h,
        cX=0, cY=0, cK = 1,
        $btnApply = $('._editAvatarApply'),
        param_id = $img_box_preview.data('param-value'),
        file_name = $img_box_preview.data('file-name'), //'EventForm3[cover]',
        uploadOpts = {
            url: $img_box_preview.data('url')
        };

    var _onSelectFile = function(evt) {
        $("a#inline").trigger("click");
        _file = FileAPI.getFiles(evt)[0];
        if (_file) {
            $('.js_btn_show_cover_resize').click(); //js_btn_show_event_cover_resize
            _createPreview();
        }
        /*var files = FileAPI.getFiles(evt);
        FileAPI.filterFiles(files, function(file, info *//**Object*//*) {
            if (/^image/.test(file.type)) {
                _file = file;
                _createPreview();
            }
        }, function() {});*/
    };

    $btnApply.click(function() {
        _uploadFile();
    });

    var _createPreview = function(file) {
        var w = parseInt($img_box_crop.width()),
            h = parseInt($img_box_crop.height());
        //w = 738;
        //h= 300;
        //console.log(_file);
        FAImgGhost = FileAPI.Image(_file);
        FAImg = FAImgGhost.clone();

        //console.log(FAImg);
        FAImgGhost.get(function(err, image) {
            if (!err) {
                $ghost.html(image);
            }
        });

        FAImg
            .resize(w, h, 'max')
            .get(function(err, image) {
                if (!err) {
                    $($img_box_crop).find('canvas').remove();
                    $img_box_crop.prepend(image);
                    _calcCropSizes();
                }
            });
    };

    var _calcCropSizes = function() {
        var $canvas, $origin,
            wCrop, hCrop, wOrig, hOrig,
            minSizeCropper, minSizeCropper_w, minSizeCropper_h;
        $canvas = $($img_box_crop).find('canvas');
        $origin = $('canvas', $ghost);
        wCrop = $canvas.attr('width');
        hCrop = $canvas.attr('height');
        wOrig = $origin.width();
        hOrig = $origin.height();

        if ((wOrig < size_w) || (hOrig < size_h)) {
            $btnApply.attr('disabled', 'disabled');
            alert($img_box_preview.data('errorsize'));
        } else {
            cK = wOrig / wCrop;
            minSizeCropper_w = parseInt(size_w / cK);
            if (minSizeCropper_w < size_w) {
                minSizeCropper_w = size_w;
            }
            cK = hOrig / hCrop
            minSizeCropper_h = parseInt(size_h / cK);
            if (minSizeCropper_h < size_h) {
                minSizeCropper_h = size_h;
            }

            $btnApply.removeAttr('disabled');
            //$img_box_crop.css({width:wCrop, height:hCrop});
            _showCropper(minSizeCropper_w, minSizeCropper_h, wCrop, hCrop);
        }
    }

    var _showCropper = function(minW, minH, maxW, maxH) {
        $cropper.show();
        if (_dnr) {
            $cropper.draggable('destroy');
            $cropper.resizable('destroy');
        }
        $cropper.draggable({
            containment:'parent',
            stop: function(event, ui) {
                cX = ui.position.left;
                cY = ui.position.top;
            }
        });
        $cropper.resizable({
            minWidth:minW, minHeight:minH, maxWidth:maxW, maxHeight:maxH, aspectRatio:true, containment:'parent',
            stop:function(event, ui) {
                cW = ui.size.width;
                cH = ui.size.height;
            }
        });
        _dnr = true;
        $cropper.css({left:0,top:0,width:size_w,height:size_h});
    }


    var _uploadFile = function() {
        var x, y, w, h;
        x = parseInt(cX * cK);
        y = parseInt(cY * cK);
        w = parseInt(cW * cK);
        h = parseInt(cH * cK);

        var token_name = $('meta[name="csrf-param"]').attr('content');
        var token = $('meta[name="csrf-token"]').attr('content');

        _file = FileAPI.Image(_file).crop(x, y, w, h).resize(size_w, size_h);

        var opts = FileAPI.extend(uploadOpts, {
            files: {},
            data: {param_name:param_id},
            upload: function() {
                $img_box_crop.addClass('loading');
            },
            complete: function(data, xhr) {
                var imageId = xhr.response;
                $img_box_crop.removeClass('loading');
                if (data.err) {
                    alert('Oops! Server error.');
                } else {
                    _file.get(function(err, image) {
                        if (!err) {
                            $img_box_preview.html('' +
                            '<img src="'+image.toDataURL()+'" />' +
                            '<a class="delite" href="/event/default/image-delete/?key='+imageId+'">' +
                            '<span class="glyphicon glyphicon-remove"></span>' +
                            '</a>').css("display", "");
                            $ghost.html('');
                        }
                    });
                    $.fancybox.close();
                    //$popup.modal('hide');
                }
            }
        });

        opts.files[file_name] = _file;
        opts.data[token_name] = token;
        FileAPI.upload(opts);
    };

    $input.on('change', _onSelectFile);

    $(document).on("click", ".js_cover_preview img", function(){
        $('.image_file').trigger("click");
    });
}

$(document).ready(function() {
    init_select_cover();


});