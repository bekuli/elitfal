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
			$(".btn-submit").val("Gönderiliyor...");
			$(".btn-submit").attr("disabled", "");

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
					if (result == "success")
					{

					}else
					{
						$(".btn-submit").val("Devam");
						$(".btn-submit").removeAttr("disabled", "");
						process_output_data(result);
					}
				},
				error : function(){
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
        }
    }

</script>