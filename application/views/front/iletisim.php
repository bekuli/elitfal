<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">
		<div class="col-md-4 yorumcu-ol-form-wrapper">
			<div class="yorumcu-ol-sayfa">
				<div class="yorumcu-ol-baslik"> 
					İletişim
				</div>
				<form class="yorumcu-ol-form">
				  	<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">Adınız</label>
				      		<input type="text" class="form-control" name="name" placeholder="Adınız">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">E-posta</label>
				      		<input type="email" class="form-control" name="email" placeholder="E-posta">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">GSM Numarası</label>
				      		<input type="number" class="form-control" name="tel" placeholder="GSM Numarası">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">Mesajınız</label>
				      		<textarea style="height: 200px;" name="message" id="massage" class="form-control" rows="3"></textarea>
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				      		<button type="submit" name="submit" class="btn btn-block yorumcu-ol-btn">Gönder</button>
				    	</div>
					</div>
					<input type="hidden" value="" name="iletisim">
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function(){
		$(".yorumcu-ol-form").submit(function(e){
            e.preventDefault();

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url: "<?=base_url()?>iletisim/submit",
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(".yorumcu-ol-form button").text("Gönderiliyor...");
                    $(".yorumcu-ol-form button").attr("disabled", "");
                },
                success: function( data){
                    $(".yorumcu-ol-form button").removeAttr("disabled");
                    $(".yorumcu-ol-form button").text("Gönder");

                    if (data == "success")
                    {
                        $.notify("İletişim formunuz bize iletildi!", "success");
                        $(".yorumcu-ol-form").trigger("reset");
                    }else if (data == "false")
                    {
                        $.notify("Tüm alanları doldurmak zorunludur!", "error");
                    }else if (data == "error"){
                    
                        $.notify("Bilinmeyen Hata", "error");
                    }
                },
                error: function( e ){
                    $(".yorumcu-ol-form button").text("Gönder");
                    $(".yorumcu-ol-form button").removeAttr("disabled");
                    $.notify("Bilinmeyen Hata", "error");
                    console.log( e );
                }
            });
        });
	});

</script>

<style>
	body{background: #f1f1f1}
	.yorumcu-ol-btn{color:#fff;}
	.yorumcu-ol-btn:hover{color:#fff;background: #880000}
	.yorumcu-ol-btn:focus{color:#fff;}
</style>