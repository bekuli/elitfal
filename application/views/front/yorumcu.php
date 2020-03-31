<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="yorumcu-sayfa">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 profil-wrapper">

				<div class="profil-karti-g">
					<div class="pp">
						<img class="img-circle" src="<?=base_url()?>uploads/<?=$yorumcu->pp?>" onerror="this.src='<?=base_url()?>src/img/pp.png';">
					</div>

					<div class="isim">
						<?=$yorumcu->name?>
					</div>

					<div class="online-status">
						<?php
						if (strtotime($yorumcu->last_online) + 10 < time()){
						?>
                    	<span class="badge">Çevrimdışı</span>
                    	<?php }else{ ?>
                		<span class="badge active">Çevrimiçi</span>
                    	<?php } ?>
                    </div>

					<div class="review-stars">
                        <?php
						for ($i = 0; $i < $puan; $i++)
							echo '<i class="active fa fa-star"></i>';
						for ($i = $puan; $i < 5; $i++)
                        	echo '<i class=" fa fa-star"></i>';
                        ?>
                        <span class="comment-count">(<?=count($comments)?>)</span>
                    </div>

                    <div class="hakkinda-kisa">
                    	<?=$yorumcu->aciklama?>
                    </div>

                    <div class="fal-listesi">

                    	<ul>
                    		<?php if (isset($yorumcu->baktigi_fallar["katina_fali"])) { ?>
                    		<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-katina.png">
                    				</div>
                    				<div class="fal-li-isim">Katina Falı</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["kahve_fali"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-kahve.png">
                    				</div>
                    				<div class="fal-li-isim">Kahve Falı</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["tarot_fali"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-tarot.png">
                    				</div>
                    				<div class="fal-li-isim">Tarot Falı</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["su_fali"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-su.png">
                    				</div>
                    				<div class="fal-li-isim">Su Falı</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["yildizname"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-yildiz.png">
                    				</div>
                    				<div class="fal-li-isim">Yıldızname</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["ruya_yorumu"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-ruya.png">
                    				</div>
                    				<div class="fal-li-isim">Rüya Yorumu</div>
                    			</div>
                			</li>
                			<?php } ?>
                			<?php if (isset($yorumcu->baktigi_fallar["dert_ortagi"])) { ?>
                			<li>
                    			<div class="fal-li">
                    				<div class="fal-li-resim">
                    					<img src="<?=base_url()?>src/img/icon-dert.png">
                    				</div>
                    				<div class="fal-li-isim">Dert Ortağı</div>
                    			</div>
                			</li>
                			<?php } ?>


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
							<?php if (isset($yorumcu->baktigi_fallar["katina_fali"])) { ?>
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
											<span class="badge"><?=$yorumcu->fiyat_listesi["katina_fali"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/katina-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>

							<?php if (isset($yorumcu->baktigi_fallar["kahve_fali"])) { ?>

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
											<span class="badge"><?=$yorumcu->fiyat_listesi["kahve_fali"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/kahve-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<?php } ?>

							<?php if (isset($yorumcu->baktigi_fallar["tarot_fali"])) { ?>
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
											<span class="badge"><?=$yorumcu->fiyat_listesi["tarot_fali"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/tarot-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>

							<?php if (isset($yorumcu->baktigi_fallar["su_fali"])) { ?>

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
											<span class="badge"><?=$yorumcu->fiyat_listesi["su_fali"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/su-fali">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>

							<?php } ?>
							<?php if (isset($yorumcu->baktigi_fallar["yildizname"])) { ?>
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
											<span class="badge"><?=$yorumcu->fiyat_listesi["yildizname"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/yildizname">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if (isset($yorumcu->baktigi_fallar["ruya_yorumu"])) { ?>
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
											<span class="badge"><?=$yorumcu->fiyat_listesi["ruya_yorumu"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/ruya-yorumu">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if (isset($yorumcu->baktigi_fallar["dert_ortagi"])) { ?>
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
											<span class="badge"><?=$yorumcu->fiyat_listesi["dert_ortagi"]?> Kredi</span>
										</div>

										<a href="<?=base_url()?>yorumcular/<?=$yorumcu->id?>/dert-ortagi">
											<div class="fal-btn">FALINI GÖNDER</div>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>

						</div>


					</div>

					<div class="yorumlar">

						<div class="baslik">
							Yorumlar
						</div>

						<div class="yorumlar-listesi">

							<?php

								foreach ($comments as $row)
								{

							?>
							<div class="yorum">
								<div class="review-stars">
									<?php
									for ($i = 0; $i < $row["puan"]; $i++)
										echo '<i class="active fa fa-star"></i>';
									for ($i = $row["puan"]; $i < 5; $i++)
			                        	echo '<i class=" fa fa-star"></i>';
			                        ?>
								</div>

								<div class="icerik">
									<?=htmlspecialchars($row["comment"])?>
								</div>

								<div class="tarih">
									<?=$row["tarih"]?>
								</div>
							</div>
							<?php } ?>

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