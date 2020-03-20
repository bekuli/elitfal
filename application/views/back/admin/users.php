<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Kullanıcılar</h1>
</div>

<div class="urltable">

    <div class="row urltable-top">
        <div class="col-xl-2 col-md-4">

        </div>
        <div class="col-xl-8 col-md-4"></div>
        <div class="col-xl-2 col-md-4">
            <form method="POST" action="" id="search-url">
                <div class="input-group urls-search">
                    <input placeholder="Search Users" type="text" class="form-control" aria-label="Search">
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

<div class="modal" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hesabi Düzenle</h5>
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
            Bu hesabı kalıcı olarak siliceksin emin misin?
            <input type="hidden" name="delete-id"/>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="delete-yes">Evet</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    
    $(document).ready(function () {

        $(".urltable-content").load("<?=base_url()?>admin/user_list");

        $(".urltable-content").on("click", "a[data-action]", function(e){
            e.preventDefault();
            
            if ($(this).attr("data-action") == "view"){
                var url = $(this).attr("href");
                window.history.pushState("", "", url);
                set_page(url);
                $("#nav").find("a").removeClass("active");
            }else if ($(this).attr("data-action") == "view_user"){

                $.ajax({
                    url: '<?=base_url()?>admin/users/' + $(this).parent().attr("data-id") + "/view",
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

            }else if ($(this).attr("data-action") == "view_urls") {
                var url = $(this).attr("href");
                window.history.pushState("", "", url);
                set_page(url);
                $("#nav").find("a").removeClass("active");

            }else if ($(this).attr("data-action") == "edit"){
                
                $.ajax({
                    url: '<?=base_url()?>admin/users/' + $(this).parent().attr("data-id") + "/edit",
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
                
            }else if ($(this).attr("data-action") == "delete"){
                $("#delete-modal").modal();
                $("input[name='delete-id']").attr("value", $(this).parent().attr("data-id"));
            }else if ($(this).attr("data-action") == "status"){
                
                var status = $(this).attr("data-status");
                var selector = $(this);

                $.ajax({
                    url: '<?=base_url()?>admin/users/' + $(this).parent().attr("data-id") + "/update-status",
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        if (status == "1")
                            $.notify("Deaktifleştiriliyor", "info");
                        else
                            $.notify("Aktifleştiriliyor", "info");
                    },
                    success: function( data){

                        if (data == "success")
                        {
                            if (status == "1"){
                                $.notify("Deaktifleştirildi", "success");
                                selector.attr("data-status", "0");
                                selector.attr("title", "Enable User");
                                selector.parent().siblings(".urlbox-status").find("div").html("Disabled");
                            }
                            else{
                                $.notify("Aktifleştirildi", "success");
                                selector.attr("data-status", "1");
                                selector.attr("title", "Disable User");
                                selector.parent().siblings(".urlbox-status").find("div").html("Enabled");
                            }
                            
                            //$("#nav a[data-title='Urls']").click();
                        }else
                            $.notify("Bilinmeyen Hata", "danger");
                    },
                    error: function( e ){
                        console.log( e );
                    }
                });
            }
        });
        
        $("#delete-yes").click(function(){
            $.ajax({
                url: '<?=base_url()?>admin/users/' + $("input[name='delete-id']").attr("value") + "/delete",
                contentType: false,
                processData: false,
                success: function( data){
                    
                    $('#delete-modal').modal('hide');
                    if (data == "success")
                    {
                        $.notify("Başarıyla silindi", "success");
                        $("#nav a[data-title='Users']").click();
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
            $("#user-edit-form").submit();
        });
        
        $("#edit-modal").on("submit", "#user-edit-form",function(e){
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
                    console.log(data);

                    if (data == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (data == "bad_email")
                    {
                        $.notify("Hatalı eposta adresi!", "error");
                    }else if (data == "empty"){
                        $.notify("Tüm alanları doldurmak zorunludur!", "error");
                    }else
                    {
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

        $(".urltable-content").on("click", ".urltable-pagination a",function(e){
            e.preventDefault();
            
            if ($(this).attr("page") != "active")
            {
                var q = $(this).attr("search");
                if (typeof q !== typeof undefined && q !== false)
                    $(".urltable-content").load("<?=base_url()?>admin/user_list/" + $(this).attr("page") + "/" + $(this).attr("search"));
                else
                    $(".urltable-content").load("<?=base_url()?>admin/user_list/" + $(this).attr("page"));
            }
        });

        $("#search-url").submit(function(e){
            e.preventDefault();

            $(".urltable-content").load("<?=base_url()?>admin/user_list/1/"+$("#search-url input").val());
        });
    });
    
    
</script>
