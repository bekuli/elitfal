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
                                <input type="email" name="email" class="form-control" id="email" value="<?=$profil->email?>">
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
                <form id="baktigim-fallar-form">
                    <div class="card border-light ">
                       <div class="card-header">Baktığım Fallar</div>
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["kahve_fali"])) { echo ' checked="" ';} ?> name="kahve_fali" type="checkbox" class="custom-control-input" id="kahve-fali-c" name="">
                                      <label class="custom-control-label" for="kahve-fali-c">Kahve Falı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["tarot_fali"])) { echo ' checked="" ';} ?> name="tarot_fali" type="checkbox" class="custom-control-input" id="tarot-fali-c">
                                      <label class="custom-control-label" for="tarot-fali-c">Tarot Falı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["yildizname"])) { echo ' checked="" ';} ?> name="yildizname" type="checkbox" class="custom-control-input" id="yildizname-c">
                                      <label class="custom-control-label" for="yildizname-c">Yıldızname</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["ruya_yorumu"])) { echo ' checked="" ';} ?> name="ruya_yorumu" type="checkbox" class="custom-control-input" id="ruya-yorumu-c">
                                      <label class="custom-control-label" for="ruya-yorumu-c">Rüya Yorumu</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["katina_fali"])) { echo ' checked="" ';} ?> name="katina_fali" type="checkbox" class="custom-control-input" id="katina-fali-c">
                                      <label class="custom-control-label" for="katina-fali-c">Katina Aşk Falı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["su_fali"])) { echo ' checked="" ';} ?> name="su_fali" type="checkbox" class="custom-control-input" id="su-fali-c">
                                      <label class="custom-control-label" for="su-fali-c">Su Falı</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                      <input <?php if (isset($profil->baktigi_fallar["dert_ortagi"])) { echo ' checked="" ';} ?> name="dert_ortagi" type="checkbox" class="custom-control-input" id="dert-ortagi-c">
                                      <label class="custom-control-label" for="dert-ortagi-c">Dert Ortağı</label>
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="card-footer">
                            <input name="baktigim-fallar" type="submit" class="btn btn-primary btn-sm" value="Kaydet">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <form id="fiyat-listesi-form">
                    <div class="card border-light ">
                       <div class="card-header">Fal Fiyat Listesi (kredi)</div>
                       <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kahve-fali-fi">Kahve Falı</label>
                                        <input value="<?=$profil->fiyat_listesi["kahve_fali"]?>" type="number" name="kahve_fali" class="form-control" id="kahve-fali-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tarot-fali-fi">Tarot Falı</label>
                                        <input value="<?=$profil->fiyat_listesi["tarot_fali"]?>" type="number" name="tarot_fali" class="form-control" id="tarot-fali-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="yildizname-fi">Yıldızname</label>
                                        <input value="<?=$profil->fiyat_listesi["yildizname"]?>" type="number" name="yildizname" class="form-control" id="yildizname-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ruya-yorumu-fi">Rüya Yorumu</label>
                                        <input value="<?=$profil->fiyat_listesi["ruya_yorumu"]?>" type="number" name="ruya_yorumu" class="form-control" id="ruya-yorumu-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="katina-fali-fi">Katina Aşk Falı</label>
                                        <input value="<?=$profil->fiyat_listesi["katina_fali"]?>" type="number" name="katina_fali" class="form-control" id="katina-fali-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="su-fali-fi">Su Falı</label>
                                        <input value="<?=$profil->fiyat_listesi["su_fali"]?>" type="number" name="su_fali" class="form-control" id="su-fali-fi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dert-ortagi-fi">Dert Ortağı</label>
                                        <input value="<?=$profil->fiyat_listesi["dert_ortagi"]?>" type="number" name="dert_ortagi" class="form-control" id="dert-ortagi-fi">
                                    </div>
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