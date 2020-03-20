<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="yorumcu-sayfa">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 profil-wrapper">

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

                    <div class="fal-listesi">

                    	<ul>
                    		<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-katina.png">
                    				</div>
                    				<div class="fal-li-isim">Katina Falı</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-kahve.png">
                    				</div>
                    				<div class="fal-li-isim">Kahve Falı</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-tarot.png">
                    				</div>
                    				<div class="fal-li-isim">Tarot Falı</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-su.png">
                    				</div>
                    				<div class="fal-li-isim">Su Falı</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-yildiz.png">
                    				</div>
                    				<div class="fal-li-isim">Yıldızname</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-ruya.png">
                    				</div>
                    				<div class="fal-li-isim">Rüya Yorumu</div>
                    			</div>
                			</li>

                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-dert.png">
                    				</div>
                    				<div class="fal-li-isim">Dert Ortağı</div>
                    			</div>
                			</li>



                    	</ul>

                    </div>

				</div>

			</div>

			<div class="col-lg-9 profil-sag-wrapper">

				<div class="profil-sag">
					<div class="hakkimda">
						<div class="baslik">
							Hakkımda
						</div>
						<div class="icerik">
							<?=$yorumcu->aciklama_uzun?>
						</div>
					</div>

					<div class="fallar">

						<div class="row" style="text-align: center">

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-katina.png">
									</div>

									<div class="fal-isim">
										Katina Falı
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/katina-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-kahve.png">
									</div>

									<div class="fal-isim">
										Kahve Falı
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/kahve-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-tarot.png">
									</div>

									<div class="fal-isim">
										Tarot Falı
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/tarot-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-su.png">
									</div>

									<div class="fal-isim">
										Su Falı
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/su-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-yildiz.png">
									</div>

									<div class="fal-isim">
										Yıldızname
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/yildizname">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-ruya.png">
									</div>

									<div class="fal-isim">
										Rüya Yorumu
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/ruya-yorumu">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-xs-6 col-sm-4 fal-box-wrapper">
								<div class="fal-box">
									<div class="fal-resim">
										<img src="<?=base_url()?>src/img/icon-dert.png">
									</div>

									<div class="fal-isim">
										Dert Ortağı
									</div>

									<div class="alt">

										<div class="fal-kredi">
											<span class="badge">150 Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/dert-ortagi">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

						</div>


					</div>

					<div class="yorumlar">

						<div class="baslik">
							Yorumlar
						</div>

						<div class="yorumlar-listesi">

							<div class="yorum">
								<div class="review-stars">
									<i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class=" fa fa-star"></i>
								</div>

								<div class="icerik">
									Çok anlamlı bir yorumdu!...
								</div>

								<div class="tarih">
									19 Mart 2020
								</div>
							</div>

							<div class="yorum">
								<div class="review-stars">
									<i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class=" fa fa-star"></i>
								</div>
								
								<div class="icerik">
									Çok anlamlı bir yorumdu!...
								</div>

								<div class="tarih">
									19 Mart 2020
								</div>
							</div>

							<div class="yorum">
								<div class="review-stars">
									<i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class="active fa fa-star"></i>
			                        <i class=" fa fa-star"></i>
								</div>
								
								<div class="icerik">
									Çok anlamlı bir yorumdu!...
								</div>

								<div class="tarih">
									19 Mart 2020
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