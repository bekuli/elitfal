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
								        <input name="email" type="email" placeholder="Email" class="form-control">
								    </div>

								    <div class="form-group">
								        <input name="email_tekrar" type="email" placeholder="Email Tekrar" class="form-control">
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
								            <option value="İlişki Durumu">İlişki Durumu</option>
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
							 	<button type="submit" class="btn btn-success">Devam</button>
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

  $(document).ready(function(){
  	$("#fal-form").submit(function(){
  		$(".sbmt_btn").val("Loading...");
		$(".sbmt_btn").attr("disabled", "");
		
  		$.ajax({
			url : base_url + "home/profile/do_post_product/",
			type : "post",
			data : form_data,
			contentType : false,
			processData : false,
			success : function(result) {
				console.log(result);
				$(".pnav_uploaded_products").click();
				notify("Product Added", "success", "bottom", "right");
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
		});
  	});
  });

</script>

<style>
	body{background: #f1f1f1}
</style>