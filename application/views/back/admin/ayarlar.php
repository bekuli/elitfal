<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Ayarlar</h1>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="row">

            <div class="col-md-12">
                <form id="email-form">
                    <div class="card border-light ">
                    	<div class="card-header">Hesap Ayarları</div>
                       <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email Adresi</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                       </div>
                       <div class="card-footer">
                            <input name="hesap-ayarlari" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <form id="sifre-form">
                    <div class="card border-light ">
                       <div class="card-header">Şifre Değiştir</div>
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="msifre">Mevcut Şifre</label>
                                        <input type="password" name="msifre" class="form-control" id="msifre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ysifre">Yeni Şifre</label>
                                        <input type="password" name="ysifre" class="form-control" id="ysifre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ysifre-again">Yeni Şifre Tekrar</label>
                                        <input type="password" name="ysifre_tekrar" class="form-control" id="ysifre-again">
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="card-footer">
                            <input name="sifre-degistir" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">

            <div class="col-md-12">
                <form id="fiyat-listesi-form">
                    <div class="card border-light ">
                       <div class="card-header">Fiyat Listesi</div>
                       <div class="card-body">
                            <div class="row">



                            </div>
                       </div>
                       <div class="card-footer">
                            <input name="fiyat-listesi" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <form id="fiyat-listesi-form">
                    <div class="card border-light ">
                       <div class="card-header">Komisyon</div>
                       <div class="card-body">
                            <div class="row">
                              
                            	<div class="form-group">
								  <label for="exampleFormControlTextarea2">.</label>
								  <textarea style="width: 450px;" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
								</div>
                              
                            </div>
                       </div>
                       <div class="card-footer">
                            <input name="fiyat-listesi" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>


</div>

<style type="text/css">
    .custom-checkbox label, .custom-checkbox input{
        cursor: pointer;
    }

    .custom-control-inline{
        display: block !important;
    }
</style>

<script type="text/javascript">
    var submitting_email = false;
    var submitting_sifre = false;
    var submitting_baktigim_fallar = false;
    var submitting_fiyat_listesi = false;

    $(document).ready(function(){

        $("#email-form").submit(function(e){
            e.preventDefault();
            if (submitting_email == true)
                return;
            submitting_email = true;

            var email = $("#email").val();
            if (email.trim() == ""){
                $.notify("Geçersiz email adresi", "error");
                submitting_email = false;
                return;
            }

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "yorumcu/ayarlar/email",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("#email-form input[type=submit]").val("Kaydediliyor...");
                    $("#email-form input[type=submit]").attr("disabled", "");
                },
                success : function(result) {
                    if (result == "error")
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    else if (result == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (result == "false")
                    {
                        $.notify("Geçersiz email adresi", "error");
                    }

                    $("#email-form input[type=submit]").val("Kaydet");
                    $("#email-form input[type=submit]").removeAttr("disabled", "");
                    submitting_email = false;
                },
                error : function(r){
                    console.log(r);
                    submitting_email = false;
                    $("#email-form input[type=submit]").val("Kaydet");
                    $("#email-form input[type=submit]").removeAttr("disabled", "");
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                }
            });

        });

        $("#sifre-form").submit(function(e){
            e.preventDefault();
            if (submitting_sifre == true)
                return;
            submitting_sifre = true;

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "yorumcu/ayarlar/sifre",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("#sifre-form input[type=submit]").val("Kaydediliyor...");
                    $("#sifre-form input[type=submit]").attr("disabled", "");
                },
                success : function(result) {
                    if (result == "error")
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    else if (result == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (result == "no_match")
                    {
                        $.notify("Yeni şifre ile tekrarı uyuşmuyor", "error");
                    }else if (result == "no_match_org")
                    {
                        $.notify("Mevcut şifreniz yanlış!", "error");
                    }


                    $("#sifre-form input[type=submit]").val("Kaydet");
                    $("#sifre-form input[type=submit]").removeAttr("disabled", "");
                    submitting_sifre = false;
                },
                error : function(r){
                    submitting_sifre = false;
                    $("#sifre-form input[type=submit]").val("Kaydet");
                    $("#sifre-form input[type=submit]").removeAttr("disabled", "");
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                }
            });

        });

        $("#baktigim-fallar-form").submit(function(e){
            e.preventDefault();
            if (submitting_baktigim_fallar == true)
                return;
            submitting_baktigim_fallar = true;

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "yorumcu/ayarlar/baktigim-fallar",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("#baktigim-fallar-form input[type=submit]").val("Kaydediliyor...");
                    $("#baktigim-fallar-form input[type=submit]").attr("disabled", "");
                },
                success : function(result) {
                    if (result == "error")
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    else if (result == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }

                    $("#baktigim-fallar-form input[type=submit]").val("Kaydet");
                    $("#baktigim-fallar-form input[type=submit]").removeAttr("disabled", "");
                    submitting_baktigim_fallar = false;
                },
                error : function(r){
                    console.log(r);
                    submitting_baktigim_fallar = false;
                    $("#baktigim-fallar-form input[type=submit]").val("Kaydet");
                    $("#baktigim-fallar-form input[type=submit]").removeAttr("disabled", "");
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                }
            });

        });

        $("#fiyat-listesi-form").submit(function(e){
            e.preventDefault();
            if (submitting_fiyat_listesi == true)
                return;
            submitting_fiyat_listesi = true;

            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "yorumcu/ayarlar/fiyat-listesi",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("#fiyat-listesi-form input[type=submit]").val("Kaydediliyor...");
                    $("#fiyat-listesi-form input[type=submit]").attr("disabled", "");
                },
                success : function(result) {
                    if (result == "error")
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                    else if (result == "success")
                    {
                        $.notify("Kaydedildi!", "success");
                    }else if (result == "false_n"){
                        $.notify("Sadece rakam kullanınız!", "error");
                    }else if (result == "false"){
                        $.notify("Gerekli alanlar doldurulmalıdır!", "error");
                    }

                    $("#fiyat-listesi-form input[type=submit]").val("Kaydet");
                    $("#fiyat-listesi-form input[type=submit]").removeAttr("disabled", "");
                    submitting_fiyat_listesi = false;
                },
                error : function(r){
                    console.log(r);
                    submitting_fiyat_listesi = false;
                    $("#fiyat-listesi-form input[type=submit]").val("Kaydet");
                    $("#fiyat-listesi-form input[type=submit]").removeAttr("disabled", "");
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                }
            });

        });

    });

</script>
