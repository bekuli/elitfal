<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Ödemeler</h1>
</div>

<div class="row ap-hp-cards marbot20">

    <div class="col-md-12">
    	<div class="card border-light ">
           <div class="card-header">Ödeme logları</div>
           <div class="card-body odeme-gecmisi odeme-table">
                
           </div>
        </div>
    </div>

    <div class="col-md-12">
    	<div class="card border-light ">
           <div class="card-header">Para Çekme İstekleri</div>
           <div class="card-body">
                <div class="withdraw-requests odeme-table">

                </div>
           </div>
        </div>
    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="view-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hesabı Görüntüle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view-modal-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="cevap-modal" style="top:15%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cevap</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="cevap-modal-content">
            <form id="cevap-form">
                <input type="hidden" name="cevap-id"/>
                <table style="width:100%">
                    <tbody>
                        <tr>
                            <td><b>Cevap</b></td>
                            <td> : </td>
                            <td><textarea class="form-control" name="sonuc"></textarea></td>
                        </tr>
                    </tbody>
                </table>

            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="cevap-btn">Gönder</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	var submitting = false;
	
	$(".odeme-gecmisi").html(loading_set_np);
    $(".odeme-gecmisi").load("<?=base_url()?>admin/odeme_gecmisi_list");

    $(".odeme-gecmisi").on("click", ".urltable-pagination a",function(e){
        e.preventDefault();
        
        if ($(this).attr("page") != "active")
        {
            $(".odeme-gecmisi").load("<?=base_url()?>admin/odeme_gecmisi_list/" + $(this).attr("page"));
        }
    });

    $(".withdraw-requests").html(loading_set_np);
    $(".withdraw-requests").load("<?=base_url()?>admin/withdraw_requests_list");

    $(".withdraw-requests").on("click", ".urltable-pagination a",function(e){
        e.preventDefault();
        
        if ($(this).attr("page") != "active")
        {
            $(".withdraw-requests").load("<?=base_url()?>admin/withdraw_requests_list/" + $(this).attr("page"));
        }
    });

    $(".odeme-table").on("click", "a[data-action]", function(e){
            e.preventDefault();
            
            if ($(this).attr("data-action") == "view"){

                var url = "";
                if ($(this).parent().attr("data-user-type") == "user")
                    url = '<?=base_url()?>admin/users/' + $(this).parent().attr("data-id") + "/view";
                else
                    url = '<?=base_url()?>admin/yorumcular/' + $(this).parent().attr("data-id") + "/view";

                $.ajax({
                    url: url,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $("#view-modal-content").html(loading_set_np);
                        $("#view-modal").modal();
                    },
                    success: function( data){
                        $("#view-modal-content").html(data);
                    },
                    error: function( e ){
                        console.log( e );
                    }
                });
            }else if ($(this).attr("data-action") == "answer"){
                $("#cevap-modal").modal();
                $("input[name='cevap-id']").attr("value", $(this).parent().attr("data-r-id"));
            }
        });

    $("#cevap-form").submit(function(e){
            e.preventDefault();

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url: '<?=base_url()?>admin/odemeler/' + $("input[name='cevap-id']").val() + "/withdraw_answer",
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#cevap-btn").text("Gönderiliyor...");
                    $("#cevap-btn").attr("disabled", "");
                },
                success: function( data){
                    $("#cevap-btn").removeAttr("disabled");
                    $("#cevap-btn").text("Gönder");

                    if (data == "success")
                    {
                        $.notify("Gönderildi!", "success");
                        $("#cevap-modal").modal("hide");
                        $("#cevap-form textarea").val("");
                        $("#nav a[data-title='odemeler']").click();
                    }else if (data == "false"){
                        $.notify("Gerekli alanlar doldurulmalıdır", "error");
                    }else {
                        console.log(data);
                        $.notify("Bilinmeyen Hata", "error");
                    }
                },
                error: function( e ){
                    $("#cevap-btn").text("Gönder");
                    $("#cevap-btn").removeAttr("disabled");
                    console.log( e );
                }
            });
        });

    $("#cevap-btn").click(function(){
            $("#cevap-form").submit();
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