<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">
		<div class="col-md-3 yorumcu-ol-form-wrapper">
			<div class="yorumcu-ol-sayfa">
				<div class="yorumcu-ol-baslik"> 
					İletişim
				</div>
				<form class="yorumcu-ol-form">
				  	<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">Adınız</label>
				      		<input type="text" class="form-control" placeholder="Adınız">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">E-posta</label>
				      		<input type="email" class="form-control" placeholder="E-posta">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">GSM Numarası</label>
				      		<input type="number" class="form-control" placeholder="GSM Numarası">
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				    		<label for="name">Mesajınız</label>
				      		<textarea name="massage" id="massage" class="form-control" rows="3"></textarea>
				    	</div>
					</div>
					<div class="row">
				    	<div class="col-md-12">
				      		<button type="submit" name="submit" class="btn btn-primary btn-block yorumcu-ol-btn">Gönder</button>
				    	</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<style>
	body{background: #f1f1f1}
</style>