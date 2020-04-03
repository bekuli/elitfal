<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Yorumcu Başvuruları</h1>
</div>

<div class="urltable">

    <div class="row urltable-top">
        <div class="col-xl-2 col-md-4">
        </div>
        <div class="col-xl-8 col-md-4"></div>
        <div class="col-xl-2 col-md-4">
            <form method="POST" action="" id="search-url">
                <div class="input-group urls-search">
                    <input placeholder="Arama" type="text" class="form-control" aria-label="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="urltable-content">


    </div>

</div>

<div class="modal" tabindex="-1" role="dialog" id="delete-modal" style="top:15%">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Emin misin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="delete-modal-content">
            Bu isteği kalıcı olarak siliceksin emin misin?
            <input type="hidden" name="delete-id"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="delete-yes">Evet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="view-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Görüntüle</h5>
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

<script type="text/javascript">
    
    $(document).ready(function () {

        $(".urltable-content").html(loading_set_np);
        $(".urltable-content").load("<?=base_url()?>admin/yorumcu_basvurulari_list");


        $(".urltable-content").on("click", "a[data-action]", function(e){
            e.preventDefault();
            
            if ($(this).attr("data-action") == "delete"){
                $("#delete-modal").modal();
                $("input[name='delete-id']").attr("value", $(this).parent().attr("data-id"));
            }else if ($(this).attr("data-action") == "view"){
                $.ajax({
                    url: '<?=base_url()?>admin/yorumcu_basvurulari/' + $(this).parent().attr("data-id") + "/view",
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
            }
        });
        
        $("#delete-yes").click(function(){
            $.ajax({
                url: '<?=base_url()?>admin/yorumcu_basvurulari/' + $("input[name='delete-id']").attr("value") + "/delete",
                contentType: false,
                processData: false,
                success: function( data){
                    
                    $('#delete-modal').modal('hide');
                    if (data == "success")
                    {
                        $.notify("Başarıyla silindi", "success");
                        $("#nav a[data-title='yorumcu_basvurulari']").click();
                    }else
                        $.notify("Silerken bir hata oluştu", "error");
                    
                    $("input[name='delete-id']").attr("value","");
                },
                error: function( e ){
                    console.log( e );
                    $.notify("Silerken bir hata oluştu", "error");
                    $("input[name='delete-id']").attr("value","");
                }
            });
        });
        
    });
    
    
</script>
