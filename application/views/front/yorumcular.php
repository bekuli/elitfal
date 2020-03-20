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
				                            <i class="active fa fa-star"></i>
				                            <i class="active fa fa-star"></i>
				                            <i class="active fa fa-star"></i>
				                            <i class="active fa fa-star"></i>
				                            <i class=" fa fa-star"></i>
				                            <span class="comment-count">(51)</span>
				                        </div>
				                        <div class="desc">
				                            <?=$row["aciklama"]?>
				                        </div>
				                	</div>

				                	<div class="col-md-12">
				                		<div class="falbtn">FAL BAKTIR (ÇEVRİMİÇİ)</div>
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