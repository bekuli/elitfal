<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Kredi Fiyat Listesi</h1>
</div>

<div class="urltable">

    <div class="row urltable-top">
        <div class="col-xl-2 col-md-4">
            <a href="#" class="btn btn-primary" id="kredi-ekle-btn">Kredi Fiyatı Ekle</a>
        </div>
        <div class="col-xl-8 col-md-4"></div>
        <div class="col-xl-2 col-md-4">
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
            Bunu kalıcı olarak siliceksin emin misin?
            <input type="hidden" name="delete-id"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="delete-yes">Evet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kredi Fiyatını Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit-modal-content"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="edit-save">Kaydet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="add-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kredi Fiyatı Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add-modal-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-save">Kaydet</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {

        $(".urltable-content").html(loading_set_np);
        $(".urltable-content").load("<?=base_url()?>admin/kredi_list");

        $("#kredi-ekle-btn").click(function(e){
            e.preventDefault();
            $.ajax({
                url: "<?=base_url()?>admin/kredi/ekle-view",
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#add-modal-content").html(loading_set_np);
                    $("#add-modal").modal();
                },
                success: function( data){
                    $("#add-modal-content").html(data);
                },
                error: function( e ){
                    console.log( e );
                }
            });

        });


        $(".urltable-content").on("click", "a[data-action]", function(e){
            e.preventDefault();
            
            if ($(this).attr("data-action") == "delete"){
                $("#delete-modal").modal();
                $("input[name='delete-id']").attr("value", $(this).parent().attr("data-id"));
            }else if ($(this).attr("data-action") == "edit"){
                 $.ajax({
                    url: '<?=base_url()?>admin/kredi/' + $(this).parent().attr("data-id") + "/edit",
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $("#edit-modal-content").html(loading_set_np);
                        $("#edit-modal").modal();
                    },
                    success: function( data){
                        $("#edit-modal-content").html(data);
                    },
                    error: function( e ){
                        console.log( e );
                    }
                });
            }
        });
        
        $("#delete-yes").click(function(){
            $.ajax({
                url: '<?=base_url()?>admin/kredi/' + $("input[name='delete-id']").attr("value") + "/delete",
                contentType: false,
                processData: false,
                success: function( data){
                    
                    $('#delete-modal').modal('hide');
                    if (data == "success")
                    {
                        $.notify("Başarıyla silindi", "success");
                        $("#nav a[data-title='kredi']").click();
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

        $("#edit-save").click(function(){
            $("#kredi-edit-form").submit();
        });

        $("#add-save").click(function(){
            $("#kredi-add-form").submit();
        });

        $("#add-modal").on("submit", "#kredi-add-form",function(e){
            e.preventDefault();

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url: "<?=base_url()?>admin/kredi/ekle",
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#add-save").text("Yükleniyor...");
                    $("#add-save").attr("disabled", "");
                },
                success: function( data){
                    $("#add-save").removeAttr("disabled");
                    $("#add-save").text("Kaydet");
                    console.log(data);

                    if (data == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                        $("#add-modal").modal("hide");
                        $("nav a[data-title='kredi']").click();
                    }else if (data == "false")
                    {
                        $.notify("Tüm alanları doldurmak zorunludur!", "error");
                    }else if (data == "number"){
                    
                        $.notify("Sadece sayı kullanınız", "error");
                    }else if (data == "error"){
                    
                        $.notify("Bilinmeyen Hata", "error");
                    }
                },
                error: function( e ){
                    $("#add-save").text("Kaydet");
                    $("#add-save").removeAttr("disabled");
                    $.notify("Bilinmeyen Hata", "error");
                    console.log( e );
                }
            });
        });

        $("#edit-modal").on("submit", "#kredi-edit-form",function(e){
            e.preventDefault();

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr("action"),
                type: 'post',
                data: form_data,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#edit-save").text("Yükleniyor...");
                    $("#edit-save").attr("disabled", "");
                },
                success: function( data){
                    $("#edit-save").removeAttr("disabled");
                    $("#edit-save").text("Kaydet");
                    $("#edit-modal").modal("hide");
                    $("nav a[data-title='kredi']").click();

                    if (data == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (data == "false")
                    {
                        $.notify("Tüm alanları doldurmak zorunludur!", "error");
                    }else if (data == "number"){
                    
                        $.notify("Sadece sayı kullanınız", "error");
                    }else if (data == "error"){
                    
                        $.notify("Bilinmeyen Hata", "error");
                    }
                },
                error: function( e ){
                    $("#edit-save").text("Kaydet");
                    $("#edit-save").removeAttr("disabled");
                    console.log( e );
                }
            });
        });
        
    });
    
    
</script>
