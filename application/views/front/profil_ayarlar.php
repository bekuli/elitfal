<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
									
									<form>
									  <div class="form-row">
									  	<div class="row">
									    	<div class="form-group col-md-6">
									      		<label for="inputAd4">Ad</label>
									      		<input type="text" class="form-control" id="inputAd4" placeholder="Adınız">
									    	</div>
									    	<div class="form-group col-md-6">
									      		<label for="inputSoyad4">Soyad</label>
									      		<input type="text" class="form-control" id="inputSoyad4" placeholder="Soyadınız">
									    	</div>
									    </div>
									  </div>
									  <div class="form-row">
									  	<div class="row">
									  		<div class="form-group col-md-6">
									      		<label for="inputEmail4">E-mailiniz</label>
									      		<input type="email" class="form-control" id="inputEmaill4" placeholder="E-mailiniz">
									    	</div>
									    	<div class="form-group col-md-6">
									      		<label for="inputTelefon4">Telefon Numaranız</label>
									      		<input type="number" class="form-control" id="inputTelefo4" placeholder="Telefon Numaranız">
									    	</div>
									    </div>
									  </div>
									  <div class="form-row">
									  	<div class="row">
									  		<div class="form-group col-md-6">
									      		<label for="inputCinsiyet4">Cinsiyetiniz</label>
									      		<select id="inputCinsiyet4" class="form-control">
									      			<option value="">Cinsiyetiniz</option>
													<option value="erkek">erkek</option>
													<option value="kadın">kadın</option>
									      		</select>
									    	</div>
									    	<div class="form-group col-md-6">
									      		<label for="inputIliski4">İlişki Durumunuz</label>
									      		<select id="inputIliski4" class="form-control">
									      			<option value="İlişki Durumu">İlişki Durumu</option>
		                                            <option value="Ayrı yaşıyor">Ayrı yaşıyor</option>
		                                            <option value="Boşanmış">Boşanmış</option>
		                                            <option value="Evli">Evli</option>
		                                            <option value="Karmaşık">Karmaşık</option>
		                                            <option value="İlişkisi var">İlişkisi var</option>
		                                            <option value="İlişkisi yok">İlişkisi yok</option>
									      		</select>
									    	</div>
									    </div>
									  </div>
									  <div class="form-row">
									  	<div class="row">
									  		<div class="form-group col-md-12">
									      		<label for="inputDogum4">Doğum tarihiniz</label>
									      		<input type="text" class="form-control datepicker" id="inputDogum4" placeholder="Doğum tarihiniz">
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
									      		<input type="password" class="form-control" id="inputSifre4" placeholder="Şifre">
									      		<small class="form-text text-muted">Şifrenizi değiştirmek istemiyorsanız bu kısmı boş bırakınız.</small>
									    	</div>
									    	<div class="form-group col-md-6">
									      		<label for="inputSifretekrar4">Şifre Tekrar</label>
									      		<input type="password" class="form-control" id="inputSifretekrar4" placeholder="Şifre Tekrar">
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

<style>
	body{background: #f1f1f1}
</style>

<script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );

</script>