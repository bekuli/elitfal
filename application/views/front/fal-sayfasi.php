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

							<form>

								<?php

								include "fal-sayfalari/".$falsayfasi.".php";

								?>

								<hr/>

								<label>Bilgileriniz</label>

								<div class="bilgiler">

								    <div class="form-group">
								        <input name="name" type="" placeholder="Adınız" class="form-control">
								    </div>

								    <div class="form-group">
								        <input name="email" type="email" placeholder="Email" class="form-control">
								    </div>

								    <div class="form-group">
								        <input name="email_verification" type="email" placeholder="Email Tekrar" class="form-control">
								    </div>

								    <div class="form-group">
								        <select name="working_at" class="form-control">
								            <option value="">Sektörünüz</option>
								            <option v-key="20" value="20">Basın-Yayın</option>
								            <option v-key="29" value="29">Belirtilmemiş</option>
								            <option v-key="18" value="18">Danışmanlık</option>
								            <option v-key="28" value="28">Diğer</option>
								            <option v-key="31" value="31">Doktor</option>
								            <option v-key="30" value="30">Emekli</option>
								            <option v-key="19" value="19">Ev Kadını</option>
								            <option v-key="4" value="4">Halkla İlişkiler</option>
								            <option v-key="12" value="12">Hukukçu</option>
								            <option v-key="1" value="1">Kamu Sektörü</option>
								            <option v-key="21" value="21">Manken/Model</option>
								            <option v-key="2" value="2">Mimar</option>
								            <option v-key="22" value="22">Muhasebe</option>
								            <option v-key="5" value="5">Mühendis</option>
								            <option v-key="14" value="14">Müzik</option>
								            <option v-key="23" value="23">Otomotiv</option>
								            <option v-key="15" value="15">Psikolog</option>
								            <option v-key="25" value="25">Reklam</option>
								            <option v-key="16" value="16">Sanatçı</option>
								            <option v-key="8" value="8">Satış/Pazarlama</option>
								            <option v-key="7" value="7">Sağlık Hizmetleri</option>
								            <option v-key="33" value="33">Sağlık Sektörü</option>
								            <option v-key="32" value="32">Serbest Meslek</option>
								            <option v-key="26" value="26">Sigortacı</option>
								            <option v-key="9" value="9">Sport</option>
								            <option v-key="27" value="27">Tekstil</option>
								            <option v-key="10" value="10">Ticaret</option>
								            <option v-key="17" value="17">Turizm</option>
								            <option v-key="11" value="11">Yöneticilik</option>
								            <option v-key="6" value="6">Öğrenci</option>
								            <option v-key="3" value="3">Öğretim Görevlisi/Asistan</option>
								            <option v-key="24" value="24">Öğretmen</option>
								            <option v-key="13" value="13">İnsan Kaynakları</option>
								            <option v-key="0" value="0">İşsiz</option>
								        </select>

								    </div>

								    <div class="form-group">

								        <select name="gender" class="form-control">

								            <option value="">Cinsiyetiniz</option>
								            <option v-key="0" value="0">erkek</option>
								            <option v-key="1" value="1">kadın</option>

								        </select>

								    </div>

								    <div class="form-group">

								        <select name="relationship_status" class="form-control">
								            <option value="">İlişki Durumu</option>
								            <option v-key="5" value="5">Ayrı yaşıyor</option>
								            <option v-key="3" value="3">Boşanmış</option>
								            <option v-key="2" value="2">Evli</option>
								            <option v-key="4" value="4">Karmaşık</option>
								            <option v-key="1" value="1">İlişkisi var</option>
								            <option v-key="0" value="0">İlişkisi yok</option>
								        </select>

								    </div>

								    <div class="form-group">
							            <input placeholder="Doğum Tarihi" name="birth_date" type="date" autocomplete="off" class="form-control">
								    </div>

								</div>

								<div class="form-check" style="margin-bottom: 10px">
							    	<input type="checkbox" class="form-check-input" id="check">
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

<style>
	body{background: #f1f1f1}
</style>