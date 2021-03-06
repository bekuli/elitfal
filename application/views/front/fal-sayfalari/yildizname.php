<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="form-group">
    <label>Lütfen Açılım Seçiniz</label><br>
    <label class="form-check-label"><input type="radio" value="0" name="acilim" checked="" class="form-check-input">
      Genel Açılım
    </label> <label class="form-check-label"><input type="radio" value="1" name="acilim" class="form-check-input">
      İlişki Açılımı
    </label>
</div>

<div class="form-group multi-input">
    <label>Doğum Bilgilerinizi Girin</label>
    <div class="row">
    	<div class="col-md-6 col-xs-12 marbot">
    		<input type="text" class="form-control datepicker" name="dogum-gunu" placeholder="Doğum Gününüz">
    	</div>
    	<div class="col-md-6 col-xs-12 marbot">
    		<input type="text" class="form-control" name="dogum-yeri" placeholder="Doğum Yeri">
    	</div>
    	<div class="col-md-6 col-xs-12 marbotr">
    		<input type="time" id="dogum-saati" class="form-control" name="dogum-saati" >
    	</div>
    	<div class="col-md-6 col-xs-12">
    		<input type="text" class="form-control" name="anne-adi" placeholder="Anne Adı">
    	</div>
    </div>
</div>

<div class="form-group multi-input" id="partner-bilgileri">
    <label>Eşinizin veya Partnerinizin Bilgilerini Giriniz</label>
    <div class="row">
    	<div class="col-md-6 col-xs-12 marbot">
    		<input type="date" class="form-control" name="partner-adi" placeholder="Partnerinizin Adı">
    	</div>
    	<div class="col-md-6 col-xs-12 marbot">
    		<select name="partner-burcu" class="form-control">
			    <option value="" selected="selected" disabled="disabled">Eşinizin Burcu</option>
                <option value="Koç">Koç ( 21 Mart - 19 Nisan )</option>
                <option value="Boğa">Boğa ( 20 Nisan - 20 Mayıs )</option>
                <option value="İkizler">İkizler ( 21 Mayıs - 20 Haziran )</option>
                <option value="Yengeç">Yengeç ( 21 Haziran - 22 Temmuz )</option>
                <option value="Aslan">Aslan ( 23 Temmuz - 22 Ağustos )</option>
                <option value="Başak">Başak ( 23 Ağustos - 22 Eylül )</option>
                <option value="Terazi">Terazi ( 23 Eylül - 22 Ekim )</option>
                <option value="Akrep">Akrep ( 23 Ekim - 21 Kasım )</option>
                <option value="Yay">Yay ( 22 Kasım - 21 Aralık )</option>
                <option value="Oğlak">Oğlak ( 22 Aralık - 19 Ocak )</option>
                <option value="Kova">Kova ( 20 Ocak - 18 Şubat )</option>
                <option value="Balık">Balık ( 19 Şubat - 20 Mart )</option>
			</select>
    	</div>
    	<div class="col-md-6 col-xs-12 marbot">
    		<input type="text" class="form-control" name="partner-anne-adi" placeholder="Partnerinizin Anne Adı">
    	</div>
    	<div class="col-md-12 col-xs-12">
    		<textarea class="form-control" name="partner-hakkinda" placeholder="Partneriniz Hakkında"></textarea>
    	</div>
    </div>
</div>

<div class="form-group">
    <label for="soru">Lütfen Sorularınızı Yazınız</label>
    <textarea class="form-control" name="soru" id="soru" placeholder="Kısaca Sorularınızı Yazınız"></textarea>
</div>

<style>
#dogum-saati:before {
content:'Doğum Saati:';
margin-right:.6em;
color:#333;
}
#partner-bilgileri{
	display: none;
}
</style>

<script type="text/javascript">
	$("input[name='acilim']").change(function(){
		if ($(this).val() == "1")
			$("#partner-bilgileri").show();
		else
			$("#partner-bilgileri").hide();
	});
</script>