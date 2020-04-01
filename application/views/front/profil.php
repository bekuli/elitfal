<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="row">
			<div class="profil-kullanici">
			<div class="col-md-12">

					<ul  class="nav nav-tabs">
					    <li class="active">
					        <a  href="#liste1" data-toggle="tab">Bekleyen Fallarım</a>
					    </li>
					    <li>
					        <a href="#liste2" data-toggle="tab">Bakılan Fallarım</a>
					    </li>
					    <li>
					        <a href="#liste3" data-toggle="tab">Kredi İşlemleri</a>
					    </li>
					    <li>
					        <a href="#liste4" data-toggle="tab">Profil Ayaları</a>
					    </li>
					</ul>

					<div class="tab-content">
	    				<div class="tab-pane active" id="liste1">

	    					<div class="kullanici-fal-liste">
				
								<table class="table table-striped table-responsive-md btn-table">

					  				<thead>
									    <tr>
									      <th style="width: 20%">Fal Türü</th>
									      <th style="width: 25%">Yorumcu</th>
									      <th style="width: 20%">Durum</th>
									      <th style="width: 10%">Ücret</th>
									      <th style="width: 10%">Tarih</th>
									      <th style="width: 15%"></th>
									    </tr>
									</thead>

									 <tbody>
									 	<?php
									 		foreach ($bekleyen_fallar as $row) {
									 			?>
									 			<tr>
									 				<td><?=$this->fal->fal_turu_name_to_org($row["fal_turu"])?></td>
									 				<td><img src="<?=base_url().'uploads/'.$row["yorumcu"]["pp"]?>" onerror="this.src='<?=base_url()?>src/img/pp.png';" height="35" width="35" class="img-circle" alt="yorumcu_foto" border="2"><?=$row["yorumcu"]["name"]?></td>
									 				<td>
									 					<?php
									 						if ($row["status"] == "0") {
									 						 	echo "Cevap Bekleniyor";
									 						 }else if ($row["status"] == "2") {
									 						 	echo "Ödeme Bekleniyor";
									 						 } 
									 					?>
									 				</td>
									 				<td><?=$row["odeme"]?></td>
									 				<td><?=$row["tarih"]?></td>
									 				<td>
									 					<?php if ($row["status"] == "2")  { ?>
									      				<a href="<?=base_url()?>odeme/fal/<?=$row["perma"]?>" class="kullanici-btn btn btn-xs">Ödeme Yap</a>
									      			<?php } ?>
									      			</td>

									 			</tr>
									 			<?php
									 		}
									 	 ?>
									</tbody>

								</table>	

							</div>

	    				</div>
	    				<div class="tab-pane" id="liste2">

	    					<div class="kullanici-fal-liste">
				
								<table class="table table-striped table-responsive-md btn-table">

					  				<thead>
									    <tr>
									      <th style="width: 20%">Fal Türü</th>
									      <th style="width: 25%">Yorumcu</th>
									      <th style="width: 20%">Durum</th>
									      <th style="width: 10%">Ücret</th>
									      <th style="width: 20%">Tarih</th>
									      <th style="width: 5%"></th>
									    </tr>
									</thead>

									 <tbody>
									 	<?php
									 		foreach ($bakilan_fallar as $row) {
									 			?>
									 			<tr>
									 				<td><?=$this->fal->fal_turu_name_to_org($row["fal_turu"])?></td>
									 				<td><img src="<?=base_url().'uploads/'.$row["yorumcu"]["pp"]?>" onerror="this.src='<?=base_url()?>src/img/pp.png';" height="35" width="35" class="img-circle" alt="yorumcu_foto" border="2"><?=$row["yorumcu"]["name"]?></td>
									 				<td>
									 					Cevaplandı
									 				</td>
									 				<td><?=$row["odeme"]?></td>
									 				<td><?=$row["tarih"]?></td>
									 				<td>
									      				<a href="<?=base_url()?>profil/cevap/<?=$row["id"]?>" class="kullanici-btn btn btn-xs">Detaylar</a>
									      			</td>

									 			</tr>
									 			<?php
									 		}
									 	 ?>
									</tbody>

								</table>	

							</div>

	    				</div>
	    				<div class="tab-pane" id="liste3">

    						<div class="kullanici-fal-liste">
				
								<table class="table table-striped table-responsive-md btn-table">

					  				<thead>
									    <tr>
									      <th style="width: 30%">Açıklama</th>
									      <th style="width: 15%">Miktar</th>
									      <th style="width: 15%">Ödeme Türü</th>
									      <th style="width: 25%">Ödeme Sonucu</th>
									      <th style="width: 10%">Tarih</th>
									    </tr>
									</thead>

									 <tbody>
									 	<?php
									 		foreach ($bakilan_fallar as $row) {
									 			?>
									 			<tr>
									 				<td><?=$this->fal->fal_turu_name_to_org($row["fal_turu"])?></td>
									 				<td>
									 					<?=$row["odeme"]?>
									 				</td>
									 				<td></td>
									 				<td>Cevaplandı</td>
									 				<td><?=$row["tarih"]?></td>

									 			</tr>
									 			<?php
									 		}
									 	 ?>
									</tbody>

								</table>	

							</div>

	    				</div>

	    				<div class="tab-pane" id="liste4">
    						<div class="ayarlar-profil">
								<div class="col-md-12">
									<div class="row">

										<div class="col-md-12">
											<div class="baslik-kullanici-ayarlar">
											Profil Ayarlar
											</div>
										</div>

										<div class="col-md-12">

											<div class="form-kullanici-ayarlar">
												
												<form id="profil-ayarlar-form">
												  <div class="form-row">
												  	<div class="row">
												    	<div class="form-group col-md-6">
												      		<label for="inputAd4">Ad</label>
												      		<input name="name" type="text" class="form-control" value="<?=$user_data->name?>" id="inputAd4" placeholder="Adınız">
												    	</div>
												    	<div class="form-group col-md-6">
												      		<label for="inputSoyad4">Soyad</label>
												      		<input name="surname" type="text" class="form-control" value="<?=$user_data->surname?>" id="inputSoyad4" placeholder="Soyadınız">
												    	</div>
												    </div>
												  </div>
												  <div class="form-row">
												  	<div class="row">
												  		<div class="form-group col-md-6">
												      		<label for="inputEmail4">E-mailiniz</label>
												      		<input name="email" type="email" class="form-control" value="<?=$user_data->email?>" id="inputEmaill4" placeholder="E-mailiniz">
												    	</div>
												    	<div class="form-group col-md-6">
												      		<label for="inputTelefon4">Telefon Numaranız</label>
												      		<input name="tel" type="number" class="form-control" value="<?=$user_data->telefon?>" id="inputTelefo4" placeholder="Telefon Numaranız">
												    	</div>
												    </div>
												  </div>
												  <div class="form-row">
												  	<div class="row">
												  		<div class="form-group col-md-6">
												      		<label for="inputCinsiyet4">Cinsiyetiniz</label>
												      		<select id="inputCinsiyet4" name="cinsiyet" class="form-control">
												      			<option value="">Cinsiyetiniz</option>
																<option <?=$user_data->cinsiyet == "erkek" ?  ' selected="selected"' : '';?> value="erkek">erkek</option>
																<option <?=$user_data->cinsiyet == "kadın" ?  ' selected="selected"' : '';?> value="kadın">kadın</option>
												      		</select>
												    	</div>
												    	<div class="form-group col-md-6">
												      		<label for="inputIliski4">İlişki Durumunuz</label>
												      		<select id="inputIliski4" name="iliski_durumu" class="form-control">
												      			<option value="İlişki Durumu">İlişki Durumu</option>
					                                            <option <?=$user_data->iliski_durumu == "Ayrı yaşıyor" ?  ' selected="selected"' : '';?> value="Ayrı yaşıyor">Ayrı yaşıyor</option>
					                                            <option <?=$user_data->iliski_durumu == "Boşanmış" ?  ' selected="selected"' : '';?> value="Boşanmış">Boşanmış</option>
					                                            <option <?=$user_data->iliski_durumu == "Evli" ?  ' selected="selected"' : '';?> value="Evli">Evli</option>
					                                            <option <?=$user_data->iliski_durumu == "Karmaşık" ?  ' selected="selected"' : '';?> value="Karmaşık">Karmaşık</option>
					                                            <option <?=$user_data->iliski_durumu == "İlişkisi var" ?  ' selected="selected"' : '';?> value="İlişkisi var">İlişkisi var</option>
					                                            <option <?=$user_data->iliski_durumu == "İlişkisi yok" ?  ' selected="selected"' : '';?> value="İlişkisi yok">İlişkisi yok</option>
												      		</select>
												    	</div>
												    </div>
												  </div>
												  <div class="form-row">
												  	<div class="row">
												  		<div class="form-group col-md-12">
												      		<label for="inputDogum4">Doğum tarihiniz</label>
												      		<input name="dogum_tarihi" type="text" class="form-control datepicker" value="<?=$user_data->dogum_tarihi?>" id="inputDogum4" placeholder="Doğum tarihiniz">
												    	</div>
												    </div>
												  </div>
												  <div class="form-row">
												  		<div class="baslik-kullanici-ayarlar sifre-degistir-baslik">
												  			Şifre Değiştir
												  		</div>
												  </div>
												  <div class="form-row">
												  	<div class="row">
												  		<div class="form-group col-md-6">
												      		<label for="inputSifre4">Şifre</label>
												      		<input name="password" type="password" class="form-control" id="inputSifre4" placeholder="Şifre">
												      		<small class="form-text text-muted">Şifrenizi değiştirmek istemiyorsanız bu kısmı boş bırakınız.</small>
												    	</div>
												    	<div class="form-group col-md-6">
												      		<label for="inputSifretekrar4">Şifre Tekrar</label>
												      		<input name="password-repeat" type="password" class="form-control" id="inputSifretekrar4" placeholder="Şifre Tekrar">
												    	</div>
												  	</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<input class="btn btn-guncelle" type="submit" value="Güncelle" name="submit">
													</div>
												</div>
												</form>

											</div>

										</div>

									</div>
								</div>

							</div>
	    				</div>
					</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	var submiting_profil=false;
	$(document).ready(function(){
		$("#profil-ayarlar-form").submit(function(e){
			e.preventDefault();
			$(".btn-guncelle").val("Güncelleniyor...");
			$(".btn-guncelle").attr("disabled","");
			if (submiting_profil==true) {
				return;
			}
			submiting_profil=true;

			var form_data=new FormData($(this)[0]);

			$.ajax({
				url:base_url+"profil/ayarlar-kaydet",
				type:"post",
				data:form_data,
				contentType : false,
                processData : false,
				success:function(result){
					$(".btn-guncelle").val("Güncelle");
					$(".btn-guncelle").removeAttr("disabled");
					submiting_profil=false;

					console.log(result);

					if (result=="success") {
						$.notify("Kaydedildi.", "success");
					}else if (result=="error") {
						$.notify("Bilinmiyen bir hata meydana geldi.", "error");
					}else if (result=="bos") {
						$.notify("Gerekli alanlar doldurulmalıdır", "error");
					}else if (result=="email") {
						$.notify("Geçerli bir email değil.", "error");
					}else if (result=="no_match") {
						$.notify("Girilen şifre uyuşmuyor.", "error");
					}else if (result=="tel") {
						$.notify("Geçerli bir telefon numarası giriniz.", "error");
					}else {
						$.notify("Bilinmiyen bir hata meydana geldi.", "error");
					}

				},
				error:function(r){
					$(".btn-guncelle").val("Güncelle");
					$(".btn-guncelle").removeAttr("disabled");
					submiting_profil=false;


					$.notify("Bilinmiyen bir hata meydana geldi.", "error");
				},
			});
		});
	});
	$( function() {
    	$( ".datepicker" ).datepicker();
  	} );
</script>

<style>
	body{background: #f1f1f1}
	.kullanici-fal-liste td{vertical-align: middle !important}
</style>