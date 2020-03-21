<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="form-group">
    <label for="soru">Lütfen Derdinizi Yazınız</label>
    <textarea class="form-control" name="soru" id="soru" placeholder="Derdinizi Yazınız"></textarea>
</div>

<script type="text/javascript">
	var submitting = false;

	$(document).ready(function(){
		$("#fal-form").submit(function(e){
			e.preventDefault();
			$(".btn-submit-fal").val("Gönderiliyor...");
			$(".btn-submit-fal").attr("disabled", "");

			if (submitting == true)
				return;
			submitting = true;
			var form_data = new FormData($(this)[0]);

				$.ajax({
				url : base_url + "fal-gonder/<?=$yorumcu->id?>/dert-ortagi",
				type : "post",
				data : form_data,
				contentType : false,
				processData : false,
				success : function(result) {
					submitting = false;
					//console.log(result);
					if (result == "success")
					{
						$.notify("Başarılı", "success");
					}
					else
					{
						$(".btn-submit-fal").val("Devam");
						$(".btn-submit-fal").removeAttr("disabled", "");
						process_output_data(result);
					}
				},
				error : function(result){
					//console.log(result);
					$(".btn-submit-fal").val("Devam");
					$(".btn-submit-fal").removeAttr("disabled", "");
					submitting = false;
					process_output_data("error");
				}
			});
		});
	});

	function process_output_data(data)
    {
        if (data == "error" || data == "no_data"){
            $.notify("Bilinmeyen bir hata oluştu tekrar deneyiniz", "error");
        }else if (data == "soru_bos"){
        	$.notify("Lütfen soru alanını doldururunuz", "error");
        }else if (data == "ad_bos"){
        	$.notify("Lütfen Ad alanını doldururunuz", "error");
        }else if (data == "soyad_bos"){
        	$.notify("Lütfen Soyad alanını doldururunuz", "error");
        }else if (data == "email_bos"){
        	$.notify("Lütfen Email alanını doldururunuz", "error");
        }else if (data == "sektor_bos"){
        	$.notify("Lütfen Sektör alanını doldururunuz", "error");
        }else if (data == "cinsiyet_bos"){
        	$.notify("Lütfen Cinsiyet alanını doldururunuz", "error");
        }else if (data == "iliski_bos"){
        	$.notify("Lütfen İlişki alanını doldururunuz", "error");
        }else if (data == "tarih_bos"){
        	$.notify("Lütfen Doğum Tarihi alanını doldururunuz", "error");
        }else if (data == "giris"){
        	$.notify("Lütfen Giriş Yapınız", "error");
        	$("#login-modal").modal();
        }else{
        	$.notify("Bilinmeyen bir hata oluştu tekrar deneyiniz", "error");
        }
    }

</script>