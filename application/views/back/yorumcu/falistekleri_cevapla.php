<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Fal Cevapla</h1>
</div>

<div class="row">
	<div class="col-lg-9 marbot20">

	    <div class="card border-light ">
	        <div class="card-header">Cevapla</div>
	        <div class="card-body">
                <form method="post" id="cevapla-form">
    	        	<div class="row">
    		        	<div class="col-md-12">
    	                    <h5>Cevabınız</h5>
    	                </div>
    	                <div class="col-md-12">
    		           		<textarea class="form-control tbd" name="cevap"></textarea>
    		        	</div>
    		        	<!--<div class="col-md-12">
    	                    <h5>Resim Ekle (opsiyonel)</h5>
    	                </div>
    		        	<div class="col-md-12 marbot20">
    		        		<input type="file" name="img[]" accept=".gif,.jpg,.png,.jpeg,.bmp" multiple class="images_file_select">
    		        	</div>

    		        	<div class="col-md-12" id="previewImg">
    		        	</div>-->
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-submit-fal">
                        </div>
    	        	</div>
                </form>

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

<script type="text/javascript">
   
    $(document).ready(function(){
        var submitting = false;
        $("#cevapla-form").submit(function(e){
            e.preventDefault();
            $(".btn-submit-fal").val("Gönderiliyor...");
            $(".btn-submit-fal").attr("disabled", "");

            if (submitting == true)
                return;
            submitting = true;
            var form_data = new FormData($(this)[0]);

            $.ajax({
                    url : "<?=base_url()?>yorumcu/falistekleri/<?=$fal_data->id?>/cevap-gonder",
                    type : "post",
                    data : form_data,
                    contentType : false,
                    processData : false,
                    success : function(result) {
                        submitting = false;
                        console.log(result);
                        if (result == "success")
                        {
                            var perma = result.substring(8);
                            $("a[data-title='Fal İstekleri']").click();
                            $.notify("Başarılı", "success");
                        }
                        else
                        {
                            $(".btn-submit-fal").val("Gönder");
                            $(".btn-submit-fal").removeAttr("disabled", "");
                            $.notify(result, "error");
                        }
                    },
                    error : function(result){
                        console.log(result);
                        $(".btn-submit-fal").val("Gönder");
                        $(".btn-submit-fal").removeAttr("disabled", "");
                        submitting = false;
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    }
            });
        });
    });

</script>
