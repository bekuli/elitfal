<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="row">
			<div class="profil">
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
				<div id="exTab1" class="container">
					<ul  class="nav nav-pills">
					    <li class="active">
					        <a  href="liste1" data-toggle="tab">Liste 1</a>
					    </li>
					    <li>
					        <a href="liste2" data-toggle="tab">Liste 2</a>
					    </li>
					    <li>
					        <a href="liste3" data-toggle="tab">Liste 3</a>
					    </li>
					</ul>

					<div class="tab-content clearfix">
	    				<div class="tab-pane active" id="liste1">

	    					<div class="kullanici-fal-liste">
				
								<table class="table table-striped table-responsive-md btn-table">

					  				<thead>
									    <tr>
									      <th style="width: 20%">Fal Türü</th>
									      <th style="width: 20%">Yorumcu</th>
									      <th style="width: 10%">Durum</th>
									      <th style="width: 10%">Ücret</th>
									      <th style="width: 20%">Ödeme</th>
									      <th style="width: 10%">Tarih</th>
									      <th style="width: 10%"></th>
									    </tr>
									</thead>

									 <tbody>
									   <tr>
									     	<td scope="row">Kahve Falı</td>
									      	<td><img src="" height="35" width="60" alt="yorumcu_foto" border="2">Aysel</td>
									      	<td>Okundu</td>
									      	<td>350 Kredi</td>
									      	<td>Ödeme Bekleniyor</td>
									      	<td>02/02/2000</td>
									      	<td>
									      		<button type="button" class="kullanici-btn btn btn-xs">Detaylar</button>
									      	</td>
									    </tr>
									</tbody>

								</table>	

							</div>

	    				</div>
	    				<div class="tab-pane" id="liste2">

	    				</div>
	    				<div class="tab-pane" id="liste3">

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