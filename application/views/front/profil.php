<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="row">
			<div class="profil">
			<div class="col-md-3">

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
			<div class="col-md-9">
				<div class="kullanici-fal-liste">
				
					<table class="table table-striped table-responsive-md btn-table">

		  				<thead>
						    <tr>
						      <th style="width: 15%">FAL TÜRLERİ</th>
						      <th style="width: 20%">YORUMCU</th>
						      <th style="width: 15%">DURUMU</th>
						      <th style="width: 15%">ÜCRET</th>
						      <th style="width: 20%">GÖNDERİLME TARİHİ</th>
						      <th style="width: 15%"></th>
						    </tr>
						</thead>

						 <tbody>
						   <tr>
						     	<td scope="row">Kahve Falı</td>
						      	<td><img src="" height="35" width="60" alt="yorumcu_foto" border="2">Aysel</td>
						      	<td>Okundu</td>
						      	<td>350 Kredi</td>
						      	<td>02/02/2000</td>
						      	<td>
						      		<button type="button" class="btn btn-teal btn-rounded btn-sm m-0">Detaylar</button>
						      	</td>
						    </tr>
						</tbody>

					</table>	

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