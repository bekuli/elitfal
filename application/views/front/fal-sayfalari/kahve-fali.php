<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="form-group">
	<label for="soru">Fal Fotoğraflarını Yükleyin (En Fazla 5 Fotoğraf)</label><br>
	<input style="display: none" type="file" name="img[]" accept=".gif,.jpg,.png,.jpeg,.bmp" id="img-select" class="images_file_select">
</div>

<div class="row">
    <div id="previewImg">
        <div data-id="1" class="img-select-box col-md-2 col-xs-6"><div class="preview-img-wrap">
            <span class="close" data-name="">&times;</span>
            <div class="inner"><div class="preview-img-tag"><img src=""><i class="fa fa-camera"></i></div></div></div>
        </div>
        <div data-id="2" class="img-select-box col-md-2 col-xs-6" ><div class="preview-img-wrap">
            <span class="close" data-name="">&times;</span>
            <div class="inner"><div class="preview-img-tag"><img src=""><i class="fa fa-camera"></i></div></div></div>
        </div>
        <div data-id="3" class="img-select-box col-md-2 col-xs-6"><div class="preview-img-wrap">
            <span class="close" data-name="">&times;</span>
            <div class="inner"><div class="preview-img-tag"><img src=""><i class="fa fa-camera"></i></div></div></div>
        </div>
        <div data-id="4" class="img-select-box col-md-2 col-xs-6"  ><div class="preview-img-wrap">
            <span class="close" data-name="">&times;</span>
            <div class="inner"><div class="preview-img-tag"><img src=""><i class="fa fa-camera"></i></div></div></div>
        </div>
        <div data-id="5" class="img-select-box col-md-2 col-xs-6" ><div class="preview-img-wrap">
            <span class="close" data-name="">&times;</span>
            <div class="inner"><div class="preview-img-tag"><img src=""><i class="fa fa-camera"></i></div></div></div>
        </div>
    </div>

</div>

<div class="form-group">
    <label for="soru">Lütfen Sorunuzu Yazınız</label>
    <textarea class="form-control" name="soru" id="soru" placeholder="Kısaca Sorunuzu Yazınız"></textarea>
</div>

<style>    

    #previewImg{
    	padding:0px !important;
    }

    .preview-img-wrap {
        transition: all .6s ease-in-out;
        position: relative;
        display: inline-block;
        font-size: 0px;
        border: 2px solid #EAEAEA;
        border-radius: 4px;
        width: 100%;
        text-align: center;
    }

    .preview-img-wrap img {
        max-width: 100%;
        max-height: 100%;
    }

    .preview-img-wrap .preview-img-tag {
        height: 72px;
        width: 100%;
        display: table-cell;
        vertical-align: middle;
    }


    .preview-img-wrap .inner {
        padding: 5px;
        width: 100%;
        display: table;
    }

    .preview-img-wrap .close {
        position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100;
        background-color: #E92003;
        padding: 6px 6px 4px;
        color: #fff;
        font-weight: 300;
        cursor: pointer;
        text-align: center;
        font-size: 12px;
        line-height: 10px;
        border-radius: 50%;
        opacity: 1;
    }
</style>

<script>
	var images_files = [];
    var cur_img_id = 0;

    $("#previewImg .img-select-box").click(function(){
        cur_img_id = $(this).attr("data-id");
        if ($(this).find("span").attr("data-name") == "")
            $("#img-select").click();
    });

    $(".images_file_select").on("change", function(e) {
        var fileTypes = ['jpg', 'jpeg', 'png', 'bmp', 'JPG', 'PNG', 'JPEG', 'BMP']; 
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var exist = false;
            for (var j = 0; j < images_files.length; j++) {
                if (images_files[j].name == files[i].name) {
                    exist = true;
                }
            }
            if (!exist) {
                var f = files[i];

                var extension = f.name.split('.').pop().toLowerCase();
                var isSuccess = fileTypes.indexOf(extension) > -1;

                if (isSuccess)
                {
                    var fileReader = new FileReader();
                    fileReader.filename = f.name;
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#previewImg div[data-id='"+cur_img_id+"'] img").attr("src", e.target.result);
                        $("#previewImg div[data-id='"+cur_img_id+"'] span").show();
                        $("#previewImg div[data-id='"+cur_img_id+"'] span").attr("data-name", file.filename);
                        $("#previewImg div[data-id='"+cur_img_id+"'] i").hide();
                        $(".close").click(function() {
                            var ths = $(this);
                            setTimeout(function() {
                                for (var j = 0; j < images_files.length; j++) {
                                if (images_files[j].name == $(ths).attr("data-name")) {
                                    images_files.splice(j, 1);
                                }
                            }
                            $(ths).parent().find("img").attr("src", "");
                            $(ths).parent().find("span").hide();
                            $(ths).parent().find("span").attr("data-name", "");
                            $(ths).parent().find("i").show();
                        }, 100);
                            

                        });
                        cur_img_id = 0;
                    });
                    fileReader.readAsDataURL(f);
                    images_files.push(files[i]);
                }else{
                    $.notify("Lütfen sadece resim dosyaları seçin!", "error");
                }
            }
        }
        $(".images_file_select").val("");
    });
</script>

<style>
    .fa-camera{
        color: #000;
        position: absolute;
        z-index: 999;
        font-size: 20px;
        left: 0;
        right: 0;
        top:35px;
        background: #fff;
    }

    #previewImg .img-select-box{
        cursor: pointer;
    }

    #previewImg span{
        display: none;
    }
</style>