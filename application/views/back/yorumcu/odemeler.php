<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Ödemeler</h1>
</div>

<div class="row ap-hp-cards marbot20">

    <div class="col-md-12">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="card-title"><?=$profil->kredi?> Kredi</span> <span>Hesabınızdaki Bakiye</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
    	<div class="card border-light ">
           <div class="card-header">Ödeme Geçmişi</div>
           <div class="card-body odeme-gecmisi">
                
           </div>
        </div>
    </div>

    <div class="col-md-6">
    	<div class="card border-light ">
           <div class="card-header">Para Çekme İstekleri </div>
           <div class="card-body">
                <div class="row">
                	<div class="col-md-12">
                		<a href="#" class="btn btn-primary btn-sm withdraw-btn">Para Çekme İsteği Gönder</a>
                	</div>
                </div>
                <div class="withdraw-requests">

                </div>
           </div>
        </div>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="withdraw-modal" style="top:15%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Para Çekme İsteği Gönder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <form>
            	
                <div class="row">
                	<div class="col-md-8">
                		<div class="form-group">
                			<label for="">Çekmek istediğiniz kredi tutarı</label>
	                    	<input max="<?=$profil->kredi?>" type="number" value="<?=$profil->kredi?>" name="kredi" class="form-control">
	                	</div>
	                </div>
	                <div class="col-md-4">
	                	<div class="form-group">
                			<label for="">%<?=$this->fal->get_setting("komisyon")?> komisyon</label>
	                		<input type="text" value="" name="komisyon" disabled="" class="form-control">
	                	</div>
	                </div>
                </div>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" id="withdraw-submit-btn" class="btn btn-primary">Gönder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	var submitting = false;
	var komisyon = <?=$this->fal->get_setting("komisyon")?>;

	$("#withdraw-modal input[name=kredi]").keyup(function(){
		var kredi = $(this).val();
		if (kredi >= 100)
		$("#withdraw-modal input[name=komisyon]").val((kredi / 10) - ((kredi / 10) / komisyon)+" TL");

	});
	$(document).ready(function(){
		var kredi = <?=$profil->kredi?>;
		if (kredi >= 100)
		$("#withdraw-modal input[name=komisyon]").val((kredi / 10) - ((kredi / 10) / komisyon)+" TL");
	});
	
	$(".odeme-gecmisi").html(loading_set_np);
    $(".odeme-gecmisi").load("<?=base_url()?>yorumcu/odeme_gecmisi_list");

    $(".odeme-gecmisi").on("click", ".urltable-pagination a",function(e){
        e.preventDefault();
        
        if ($(this).attr("page") != "active")
        {
            $(".odeme-gecmisi").load("<?=base_url()?>yorumcu/odeme_gecmisi_list/" + $(this).attr("page"));
        }
    });

    $(".withdraw-requests").html(loading_set_np);
    $(".withdraw-requests").load("<?=base_url()?>yorumcu/withdraw_requests_list");

    $(".withdraw-requests").on("click", ".urltable-pagination a",function(e){
        e.preventDefault();
        
        if ($(this).attr("page") != "active")
        {
            $(".withdraw-requests").load("<?=base_url()?>yorumcu/withdraw_requests_list/" + $(this).attr("page"));
        }
    });

    $(".withdraw-btn").click(function(e){
    	e.preventDefault();
    	$("#withdraw-modal").modal();
    });

    $("#withdraw-modal form").submit(function (e){
    	e.preventDefault();
            $(".btn-submit-fal").val("Gönderiliyor...");
            $(".btn-submit-fal").attr("disabled", "");

            if (submitting == true)
                return;
            submitting = true;
            var form_data = new FormData($(this)[0]);

            $.ajax({
                    url : "<?=base_url()?>yorumcu/withdraw_request",
                    type : "post",
                    data : form_data,
                    contentType : false,
                    processData : false,
                    success : function(result) {
                        submitting = false;
                        console.log(result);
                        if (result == "success")
                        {
                        	$("#withdraw-modal").modal("hide");
                            $.notify("İsteğiniz başarıyla gönderildi!", "success");
                            $("nav a[data-title='odemeler']").click();
                        }
                        else if (result == "high"){
                        	$.notify("Hesabınızda okadar kredi bulunmamaktadır!", "error");
                        }
                        else if (result == "low"){
                        	$.notify("Azami para çekme miktarı '1000' kredidir!", "error");
                        }
                        else if (result == "false"){
                        	$.notify("Gerekli alanlar doldurulmalıdır!", "error");
                        }
                        else
                            $.notify("Bilinmeyen bir hata oluştu!", "error");

                        $("#withdraw-submit-btn").val("Gönder");
                            $("#withdraw-submit-btn").removeAttr("disabled", "");
                    },
                    error : function(result){
                        console.log(result);
                        $("#withdraw-submit-btn").val("Gönder");
                        $("#withdraw-submit-btn").removeAttr("disabled", "");
                        submitting = false;
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    }
            });
    });

    $("#withdraw-submit-btn").click(function(){
    	$("#withdraw-modal form").submit();
    });
</script>

<style type="text/css">
	.odeme-gecmisi, .withdraw-requests{
		font-size:14px;
	}

	.deposit{
		color:green;
		font-weight: bold;
	}

	.withdraw{
		color:red;
		font-weight: bold;
	}
</style>