<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="home-plain">
	<div class="flex welcome">
		<div class="container">
			<div class="row">
				<h2>Canlı Fal Sitesine Hoş Geldiniz</h2>
				<p>Paketini Seç Yorumcunla Görüşmeyi Başlat! İster Telefon ile İster Yazılı Falını Baktır!</p>
			</div>
		</div>
	</div>
</div>

<div class="home-fal-turler">
	<div class="flex">
		<div class="container">
			<div class="row">

				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-kahve.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Kahve Falı
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-tarot.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Tarot Falı
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-yildiz.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Yıldızname
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-ruya.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Rüya Yorumu
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-katina.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Katina Aşk Falı
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="fal-tur-box">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-su.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Su Falı
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

					<a href="">
				<div class="fal-tur-box">
					<a href="">
						<div class="fal-tur-item">
							<div class="row">
								<div class="fal-tur-img-box">
									<img src="<?=base_url()?>src/img/icon-dert.png" class="fal-tur-img">
								</div>
								<div class="fal-text">
									<div class="fal-tur-isim">
										Dert Ortağı
									</div>
								</div>
					</a>
							</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="yorumcular">
	<div class="container">
	    <div class="row">
	    	
	    	<?php

	    		foreach ($yorumcular as $row) {
	    			?>

					<div class="col-xs-12 col-sm-4 col-md-4 yorumcu">
			        	<a href="<?=base_url()?>yorumcular/<?=$row["id"]?>">
				            <div class="yorumcu-box">
				                <div class="row">
				                    <div class="col-sm-6 col-md-4 pp">
				                        <img src="<?=base_url()?>uploads/yorumcupp.jpg" alt="" class="img-circle">
				                    </div>
				                    <div class="col-sm-6 col-md-8">
				                        <div class="isim"><h4><?=$row["name"]?></h4></div>
				                        <div class="profile-review-stars">
				                            <?php
				                            $comments = $this->fal->get_yorumcu_comments($row["id"]);
				                            $puan = $this->fal->yorumcu_puan_ortalama($row["id"], $comments);
											for ($i = 0; $i < $puan; $i++)
												echo '<i class="active fa fa-star"></i>';
											for ($i = $puan; $i < 5; $i++)
					                        	echo '<i class=" fa fa-star"></i>';
					                        ?>
					                        <span class="comment-count">(<?=count($comments)?>)</span>
				                        </div>
				                        <div class="desc">
				                            <?=$row["aciklama"]?>
				                        </div>
				                	</div>

				                	<div class="col-md-12">
				                		<div class="falbtn">FAL BAKTIR 
				                			<?php
											if (strtotime($row["last_online"]) + 10 < time()){
											?>
					                    		(ÇEVRİMDIŞI)
					                    	<?php }else{ ?>
					                			(ÇEVRİMİÇİ)
					                    	<?php } ?>
                    		
                    					</div>
				                	</div>
				            	</div>
				        	</div>
			        	</a>
			    	</div>

	    			<?php
	    		}

	    	?>

	        



		</div>
	</div>
</div>