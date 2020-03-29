<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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

<style>
	body{background: #f1f1f1}
</style>