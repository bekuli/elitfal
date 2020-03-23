<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="form-group">
    <label>Lütfen Açılım Seçiniz</label><br>
    <label class="form-check-label"><input type="radio" value="0" name="acilim" checked="" class="form-check-input">
      Genel Açılım
    </label> <label class="form-check-label"><input type="radio" value="1" name="acilim" class="form-check-input">
      İlişki Açılımı
    </label> <label class="form-check-label"><input type="radio" value="2" name="acilim" class="form-check-input">
      İş Açılımı
    </label>
</div>

<label><span id="card-count">10</span> Adet Kart Seçiniz</label>
<ul class="card-list">

<?php
    for ($i = 1; $i <= 78; $i++){
        echo '<li data-id="'.$i.'"></li>';
    }
    ?>

</ul>

<div style="height: 15px"></div>

<div class="form-group multi-input" id="partner-bilgileri">
    <label>Eşinizin veya Partnerinizin Bilgilerini Giriniz</label>
    <div class="row">
    	<div class="col-md-6 col-xs-12 marbot">
    		<input type="text" class="form-control" name="partner-adi" placeholder="Partnerinizin Adı">
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
    <label for="soru">Lütfen Sorunuzu Yazınız</label>
    <textarea class="form-control" name="soru" id="soru" placeholder="Kısaca Sorunuzu Yazınız"></textarea>
</div>

<style>#partner-bilgileri{display:none;}</style>

<script type="text/javascript">
	var selected_cards = [];
	var max_cards = 10;

	$(".card-list li").click(function(){
		if ($(this).attr("data-active") == "1")
		{
			$(this).removeClass("active");
			$(this).attr("data-active", "0");
			var id = selected_cards.indexOf($(this).attr("data-id"));
			if (id != -1)
				selected_cards.splice(id, 1);
		}else{
			if (selected_cards.length == max_cards)
				return;
			$(this).addClass("active");
			$(this).attr("data-active", "1");
			selected_cards.push($(this).attr("data-id"));
		}
	});

	$("input[name='acilim']").change(function(){
		if ($(this).val() == "1"){
			$("#partner-bilgileri").show();
			max_cards = 7;
		}
		else if ($(this).val() == "2"){
			$("#partner-bilgileri").hide();
			max_cards = 7;
		}
		else{
			$("#partner-bilgileri").hide();
			max_cards = 10;
		}
		$("#card-count").text(max_cards);
		selected_cards = [];

		$(".card-list>li").each(function(){
			$(this).attr("data-active", 0);
			$(this).removeClass("active");
		});
	});
</script>