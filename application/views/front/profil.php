<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="row">
			<div class="profil-kullanici">
			<div class="col-md-2">

				<div class="kullanici-kart">
					<div class="profil-foto">
		            	<img src="https://www.lacartedescolocs.fr/assets/fallbacks/profile_woman_medium_fallback-a7f0361efd57b6d193bef198dacdaaf2a0ac1aa17f23cd9613540c05f2c6bac6.png">
		            </div>

		            <div class="kullanici-bilgi">        
		                <?=$profil->name?>
		            </div>

		            <a href="">
			            <div class="kullanici-ayarlar">     
			               <i class="fa fa-gear"></i>
			               Ayarlarım
			            </div>
		            </a>
		        </div>

			</div>
			<div class="col-md-10">

					<ul  class="nav nav-tabs">
					    <li class="active">
					        <a  href="#liste1" data-toggle="tab">Bekliyen Fallarım</a>
					    </li>
					    <li>
					        <a href="#liste2" data-toggle="tab">Bakılan Fallarım</a>
					    </li>
					    <li>
					        <a href="#liste3" data-toggle="tab">Kredi İşlemleri</a>
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
									 				<td><img src="<?=base_url().'uploads/'.$row["yorumcu"]["pp"]?>" height="35" width="35" class="img-circle" alt="yorumcu_foto" border="2"><?=$row["yorumcu"]["name"]?></td>
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
									      				<a href="<?=base_url()?>odeme/fal/<?=$row["id"]?>" class="kullanici-btn btn btn-xs">Ödeme Yap</a>
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
									 				<td><img src="<?=base_url().'uploads/'.$row["yorumcu"]["pp"]?>" height="35" width="35" class="img-circle" alt="yorumcu_foto" border="2"><?=$row["yorumcu"]["name"]?></td>
									 				<td>
									 					Cevaplandı
									 				</td>
									 				<td><?=$row["odeme"]?></td>
									 				<td><?=$row["tarih"]?></td>
									 				<td>
									      				<button type="button" class="kullanici-btn btn btn-xs">Detaylar</button>
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

	    				</div>
					</div>
		</div>
	</div>
</div>
</div>
</div>

<style>
	body{background: #f1f1f1}
	.kullanici-fal-liste td{vertical-align: middle !important}
</style>