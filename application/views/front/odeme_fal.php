<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">

	<div class="row">
		<div class="col-lg-12">	
			<div class="odeme-fal">
				<div class="row">

					<div class="col-md-12">
						<div class="odenecek-tutar">
							
							Ödenecek Tutar : <?=$kredi?> Kredi (<?=$kredi/10?> TL)

						</div>
					</div>

					<div class="col-md-12">
						<div class="kupon-kod">
							
							<label class="kupon-yazi">
									
								Kupon Kodunuz :

							</label>

							<input type="text" name="kupon" class="form-control kupon-textbox">

							<a href="" class="kupon-btn">Güncelle</a>

						</div>
					</div>

					<div class="col-md-12">
						<div class="odeme-tur">
							
							<div class="row">

								<div class="col-md-4">
									<div class="odeme-img">
										<img src="<?=base_url()?>src/img/card.png">
									</div>
								</div>
								<div class="col-md-5">
									<div class="odeme-baslik">
										Kredi Kartı İle Ödeme
									</div>
									<div class="odeme-aciklama">
										Dünyanın her noktasından ödemelerinizi Iyzico ile kolayca yapabilirsiniz.
									</div>
								</div>
								<div class="col-md-3">
									<div class="odeme-btn-wrapper">
										<a href="" class="odeme-btn">Ödeme Yap</a>
									</div>
								</div>

							</div>

						</div>
					</div>

					<div class="col-md-12">
						<div class="odeme-tur">
							
							<div class="row">

								<div class="col-md-4">
									<div class="odeme-img">
										<img src="<?=base_url()?>src/img/mobile.png">
									</div>
								</div>
								<div class="col-md-5">
									<div class="odeme-baslik">
										Mobil Ödeme
									</div>
									<div class="odeme-aciklama">
										Mobil ödemenizi numaranızı yazdıktan sonra cep telefonunuza gelecek olan mesaja "evet" cevabı vererek kolayca yapabilirsiniz.
									</div>
								</div>
								<div class="col-md-3">
									<div class="odeme-btn-wrapper">
										<a href="" class="odeme-btn">Ödeme Yap</a>
									</div>
								</div>

							</div>

						</div>
					</div>

					<div class="col-md-12">
						<div class="odeme-tur">
							
							<div class="row">

								<div class="col-md-4">
									<div class="odeme-img">
										<img src="<?=base_url()?>src/img/kredi.png">
									</div>
								</div>
								<div class="col-md-5">
									<div class="odeme-baslik">
										Hesaptaki Kredi İle Öde
									</div>
									<div class="odeme-aciklama">
										Sayın Olgun GÜRLER, hesabınızda 0 kredi bulunmaktadır.
									</div>
								</div>
								<div class="col-md-3">
									<div class="odeme-btn-wrapper">
										<a href="" class="odeme-btn">Ödeme Yap</a>
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

<style>
	body{background: #f1f1f1}
</style>