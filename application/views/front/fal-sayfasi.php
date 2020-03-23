<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="fal-sayfasi">

					<div class="col-md-3">
						<div class="profil">
							<div class="pp">
								<img class="img-circle" src="<?=base_url()?>uploads/yorumcupp.jpg">
							</div>

							<div class="isim">
								<?=$yorumcu->name?>
							</div>

							<div class="online-status">
		                    	<span class="badge active">Çevrimiçi</span>
		                    </div>

							<div class="review-stars">
		                        <i class="active fa fa-star"></i>
		                        <i class="active fa fa-star"></i>
		                        <i class="active fa fa-star"></i>
		                        <i class="active fa fa-star"></i>
		                        <i class=" fa fa-star"></i>
		                        <span class="comment-count">(51)</span>
		                    </div>

		                    <div class="hakkinda-kisa">
		                    	<?=$yorumcu->aciklama?>
		                    </div>
		                </div>
		            </div>

					<div class="col-md-9">
						<div class="icerik">
							<div class="fal-ismi">
								<?=$faladi?>
							</div>

							<form method="post" id="fal-form" enctype="multipart/form-data">

								<?php

								include "fal-sayfalari/".$falsayfasi.".php";

								?>

								<hr/>

								<label>Bilgileriniz</label>

								<div class="bilgiler">

								    <div class="form-group">
								        <input name="ad" type="" placeholder="Adınız" class="form-control">
								    </div>

								    <div class="form-group">
								        <input name="soyad" type="text" placeholder="Soyadınız" class="form-control">
								    </div>

								    <div class="form-group">
								        <input name="email" type="email" placeholder="Eposta Adresiniz" class="form-control">
								    </div>

								    <div class="form-group">
								        <select name="sektor" class="form-control">
								            <option value="">Sektörünüz</option>
								            <option  value="Belirtilmemiş">Belirtilmemiş</option>
								            <option value="İşsiz">İşsiz</option>
								            <option  value="Diğer">Diğer</option>
								            <option  value="Basın-Yayın">Basın-Yayın</option>
								            <option  value="Danışmanlık">Danışmanlık</option>
								            <option  value="Doktor">Doktor</option>
								            <option  value="Emekli">Emekli</option>
								            <option  value="Ev Kadını">Ev Kadını</option>
								            <option value="Halkla İlişkiler">Halkla İlişkiler</option>
								            <option  value="Hukukçu">Hukukçu</option>
								            <option value="Kamu Sektörü">Kamu Sektörü</option>
								            <option  value="Manken/Model">Manken/Model</option>
								            <option value="Mimar">Mimar</option>
								            <option  value="Muhasebe">Muhasebe</option>
								            <option value="Mühendis">Mühendis</option>
								            <option  value="Müzik">Müzik</option>
								            <option  value="Otomotiv">Otomotiv</option>
								            <option  value="Psikolog">Psikolog</option>
								            <option  value="Reklam">Reklam</option>
								            <option  value="Sanatçı">Sanatçı</option>
								            <option value="Satış/Pazarlama">Satış/Pazarlama</option>
								            <option value="Sağlık Hizmetleri">Sağlık Hizmetleri</option>
								            <option  value="Sağlık Sektörü">Sağlık Sektörü</option>
								            <option  value="Serbest Meslek">Serbest Meslek</option>
								            <option  value="Sigortacı">Sigortacı</option>
								            <option value="Sport">Sport</option>
								            <option  value="Tekstil">Tekstil</option>
								            <option  value="Ticaret">Ticaret</option>
								            <option  value="Turizm">Turizm</option>
								            <option  value="Yöneticilik">Yöneticilik</option>
								            <option value="Öğrenci">Öğrenci</option>
								            <option value="Öğretim Görevlisi/Asistan">Öğretim Görevlisi/Asistan</option>
								            <option  value="Öğretmen">Öğretmen</option>
								            <option  value="İnsan Kaynakları">İnsan Kaynakları</option>
								        </select>

								    </div>

								    <div class="form-group">

								        <select name="cinsiyet" class="form-control">

								            <option value="">Cinsiyetiniz</option>
								            <option value="erkek">erkek</option>
								            <option value="kadın">kadın</option>

								        </select>

								    </div>

								    <div class="form-group">

								        <select name="iliski_durumu" class="form-control">
								            <option value="">İlişki Durumu</option>
								            <option value="Ayrı yaşıyor">Ayrı yaşıyor</option>
								            <option value="Boşanmış">Boşanmış</option>
								            <option value="Evli">Evli</option>
								            <option value="Karmaşık">Karmaşık</option>
								            <option value="İlişkisi var">İlişkisi var</option>
								            <option value="İlişkisi yok">İlişkisi yok</option>
								        </select>

								    </div>

								    <div class="form-group">
							            <input placeholder="Doğum Tarihi" name="dogum_tarihi" type="text" autocomplete="off" class="datepicker form-control">
								    </div>

								</div>

								<div class="form-check" style="margin-bottom: 10px">
							    	<input type="checkbox" class="form-check-input" name="kosullar" id="check">
							    	<a href="">Kullanım Koşullarını Kabul Ediyorum</a>
							    </div>
							 	<button type="submit" class="btn btn-submit-fal btn-success">Devam</button>
							</form>
							
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );

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

			if (typeof selected_cards !== 'undefined')
			{	
				var cards = "";
				for (var i = 0; i < selected_cards.length; i++)
				{
					if (i == selected_cards.length - 1)
						cards+=selected_cards[i];
					else
						cards+=selected_cards[i]+",";
				}

				form_data.append("selected_cards", cards);
			}

			if (typeof images_files !== 'undefined')
			{
				if (images_files.length == 0)
				{
					form_data.append("images", "");
				}
				else
				for (var i = 0; i < images_files.length; i++)
					form_data.append("images[]", images_files[i]);
			}

			$.ajax({
				url : base_url + "fal-gonder/<?=$yorumcu->id?>/<?=$falsayfasi?>",
				type : "post",
				data : form_data,
				contentType : false,
				processData : false,
				success : function(result) {
					submitting = false;
					console.log(result);
					if (result.substring(0,7) == "success")
					{
						var perma = result.substring(8);
						location.href = base_url + "odeme/fal/"+perma;
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
					console.log(result);
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
        }else if (data == "kosullar"){
        	$.notify("Lütfen Kullanım Kouşullarını Kabul Edin", "error");
        }else if (data == "giris"){
        	$.notify("Lütfen Giriş Yapınız", "error");
        	$("#login-modal").modal();
        }else{
        	$.notify(data, "error");
        	console.log(data);
        	//$.notify("Bilinmeyen bir hata oluştu tekrar deneyiniz", "error");
        }
    }
</script>

<style>
	body{background: #f1f1f1}
</style>