<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Fal Cevapla</h1>
</div>

<div class="row">
	<div class="col-lg-9 marbot20">

	    <div class="card border-light ">
	        <div class="card-header">Cevapla</div>
	        <div class="card-body">

	        	<div class="row">
		        	<div class="col-md-12">
	                    <h5>Cevabınız</h5>
	                </div>
	                <div class="col-md-12">
		           		<textarea class="form-control tbd"></textarea>
		        	</div>
		        	<div class="col-md-12">
	                    <h5>Resim Ekle (opsiyonel)</h5>
	                </div>
		        	<div class="col-md-12 marbot20">
		        		<input type="file" name="img[]" accept=".gif,.jpg,.png,.jpeg,.bmp" multiple class="images_file_select">
		        	</div>

		        	<div class="col-md-12" id="previewImg">
		        	</div>
	        	</div>

	        </div>
	    </div>

	</div>

	<div class="col-lg-3 marbot20">

        <div class="card border-light ">
            <div class="card-header">
                Profil
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Ad</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["ad"]?></td>
                        </tr>
                        <tr>
                            <td>Soyad</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["soyad"]?></td>
                        </tr>
                        <tr>
                            <td>Sektör</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["sektor"]?></td>
                        </tr>
                        <tr>
                            <td>Cinsiyet</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["cinsiyet"]?></td>
                        </tr>
                        <tr>
                            <td>İlişki</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["iliski"]?></td>
                        </tr>
                        <tr>
                            <td>Doğum Tarihi</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["tarih"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

	
</div>

<style>    
	.tbd{
        border-radius: 0px !important;
        width:100%;
        min-height: 400px !important;
        margin-bottom: 20px
    }

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

    .preview-img-wrap:hover {
        border: 2px solid transparent;
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

    $(".images_file_select").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var exist = false;
            for (var j = 0; j < images_files.length; j++) {
                if (images_files[j].name == files[i].name) {
                    exist = true;
                    console.log("exist");
                    console.log(files[i].name);
                    console.log(images_files[j].name);
                }
            }
            if (!exist) {
                images_files.push(files[i]);
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.filename = files[i].name;
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("#previewImg").append("<div style='float:left' class=\"col-md-2\">" + "<div class=\"preview-img-wrap\">" + "<span class=\"close\" data-name=\"" + file.filename + "\">&times;</span>" + "<div class=\"inner\">" + "<div class=\"preview-img-tag\">" + "<img src=\"" + e.target.result + "\" title=\"" + file.filename + "\"/>" + "</div></div></div></div>");
                    $(".close").click(function() {
                        for (var j = 0; j < images_files.length; j++) {
                            if (images_files[j].name == $(this).attr("data-name")) {
                                images_files.splice(j, 1);
                            }
                        }
                        $(this).parent(".preview-img-wrap").parent().remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        }
        $(".images_file_select").val("");
    });
</script>
