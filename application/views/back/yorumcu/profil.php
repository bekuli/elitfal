<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Profil</h1>
</div>

<div class="row">
	<div class="col-md-4">
	    <form id="pp-form">
	        <div class="card border-light ">
	           <div class="card-header">Profil Fotoğrafı</div>
	           <div class="card-body">
	           		<?php
	           		if (empty($profil->pp))
	           			$img = base_url()."src/img/pp.png";
	           		else
	           			$img = base_url()."uploads/".$profil->pp;
	           		?>
	                <img onerror="this.src='<?=base_url()?>src/img/pp.png';" id="img-uploaded" src="<?=$img?>"/>
	                <label for="upload_image" class="btn btn-primary btn-sm foto-btn">Profil fotoğrafını değiştir</label>
	                <input style="display: none" type="file" name="img" accept=".gif,.jpg,.png,.jpeg,.bmp" id="upload_image" class="images_file_select">
	           </div>
	        </div>
	    </form>
	</div>

	<div class="col-md-8">
        <form id="profil-form">
            <div class="card border-light ">
               <div class="card-header">Profil Bilgileri</div>
               <div class="card-body">
                    <div class="form-group">
                        <label for="isim">İsim</label>
                        <input type="text" value="<?=$profil->name?>" name="name" class="form-control" id="isim">
                    </div>
                    <div class="form-group">
                        <label for="kisa-aciklama">Kısa Açıklama (max 130 karakter)</label>
                        <textarea maxlength="130" class="form-control" name="aciklama"><?=$profil->aciklama?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="uzun-aciklama">Uzun Açıklama</label>
                        <textarea style="height:100px" class="form-control" name="aciklama_uzun"><?=$profil->aciklama_uzun?></textarea>
                    </div>
               </div>
               <div class="card-footer">
                    <input name="hesap-ayarlari" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                </div>
            </div>
        </form>
    </div>

</div>

<style type="text/css">
	#img-uploaded{
		border-radius: 50%;
		width: 100px;
		height: 100px;
	}

	.foto-btn{
		cursor:pointer;
	}
</style>

<script type="text/javascript" src="<?=base_url()?>src/js/croppie/croppie.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>src/js/croppie/croppie.css">

<div id="uploadimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Resmi kırp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body text-center">
        <div id="image_demo" style="width:350px; margin-top:30px"></div>

        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-success crop_image">Kaydet</button>
          	<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
        </div>
     </div>
    </div>
</div>

<script type="text/javascript">

	var cropping = false;
	var submitting_profil = false;

	$(document).ready(function(){
		$image_crop = $('#image_demo').croppie({
			enableExif: true,
				viewport: {
				width:300,
				height:300,
				type:'square'
			},
			boundary:{
				width:300,
				height:300
			}
		});

		$('#upload_image').on('change', function(e){
			var fileTypes = ['jpg', 'jpeg', 'png', 'bmp', 'JPG', 'PNG', 'JPEG', 'BMP']; 
			var f = e.target.files[0];
			var extension = f.name.split('.').pop().toLowerCase();
            var isSuccess = fileTypes.indexOf(extension) > -1;

            if (!isSuccess)
            {
            	$.notify("Lütfen sadece resim dosyaları seçin!", "error");
            	return;
            }

			var reader = new FileReader();
			reader.onload = function (event) {
				$image_crop.croppie('bind', {
					url: event.target.result
				}).then(function(){
				});
			}
			reader.readAsDataURL(this.files[0]);
			$('#uploadimageModal').modal();
		});

		$('.crop_image').click(function(event){

			if (cropping == true){
				return;
			}

			cropping = true;

			$image_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function(response){
				$.ajax({
					url: base_url+"yorumcu/profil/pp-change",
					type: "POST",
					data:{"image": response},
					beforeSend: function(){
	                    $(".crop_image").val("Kaydediliyor...");
	                    $(".crop_image").attr("disabled", "");
	                },
					success:function(result)
					{
						if (result.substring(0,7) == "success"){
							$('#uploadimageModal').modal('hide');
							$("#img-uploaded").attr("src", result.substring(8));
							$.notify("Profil fotoğrafı değiştirildi!", "success");
						}else{
							$.notify("Bilinmeyen bir hata oluştu!", "error");
						}

						$('#uploadimageModal').modal('hide');
                    	$(".crop_image").val("Kaydet");
                    	$(".crop_image").removeAttr("disabled", "");
						cropping = false;
					},
					error:function(r){
						cropping = false;
						$.notify("Bilinmeyen bir hata oluştu!", "error");
						$(".crop_image").val("Kaydet");
                    	$(".crop_image").removeAttr("disabled", "");
					}
				});
			})
		});


		$("#profil-form").submit(function(e){
            e.preventDefault();
            if (submitting_profil == true)
                return;
            submitting_profil = true;

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "yorumcu/profil/profil-bilgileri",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("#profil-form input[type=submit]").val("Kaydediliyor...");
                    $("#profil-form input[type=submit]").attr("disabled", "");
                },
                success : function(result) {
                    if (result == "error")
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    else if (result == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (result == "long"){
                        $.notify("Kısa açıklama 130 karakterden uzun olamaz!", "error");
                    }else if (result == "false"){
                        $.notify("Gerekli alanlar doldurulmalıdır!", "error");
                    }

                    $("#profil-form input[type=submit]").val("Kaydet");
                    $("#profil-form input[type=submit]").removeAttr("disabled", "");
                    submitting_profil = false;
                },
                error : function(r){
                    console.log(r);
                    submitting_profil = false;
                    $("#profil-form input[type=submit]").val("Kaydet");
                    $("#profil-form input[type=submit]").removeAttr("disabled", "");
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                }
            });

        });

	});  


</script>

<style type="text/css">
	#image_demo{
		width: 100% !important;
	}
</style>