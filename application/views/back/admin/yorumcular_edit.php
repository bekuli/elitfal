<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form action="<?=base_url()."admin/yorumcular/".$yorumcu_data->id."/update"?>"method="POST" id="yorumcular-edit-form">
    <table class="table">
        <tbody>
            <tr>
                <td><b>Profil Fotoğrafı</b></td>
                <td> : </td>
                <td><img width="75" onerror="this.src='<?=base_url()?>src/img/pp.png';" class="img-circle" id="img-uploaded" src="<?=base_url()?>uploads/<?=$yorumcu_data->pp?>"/>
                    <label for="upload_image" class="btn btn-secondary btn-sm foto-btn">Profil fotoğrafını değiştir</label>
                    <input style="display: none" type="file" name="img" accept=".gif,.jpg,.png,.jpeg,.bmp" id="upload_image" class="images_file_select">
                </td>
            </tr>
            <tr>
                <td><b>İsim</b></td>
                <td> : </td>
                <td><input class="form-control" type="text" name="name" value="<?=$yorumcu_data->name?>"></td>
            </tr>
            <tr>
                <td><b>Eposta</b></td>
                <td> : </td>
                <td><input class="form-control" type="text" name="email" value="<?=$yorumcu_data->email?>"></td>
            </tr>
            <tr>
                <td><b>Şifre</b><br><small>(değiştirilmiycekse boş bırakın)</small></td>
                <td> : </td>
                <td><input class="form-control" type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td><b>Baktığı fallar</b></td>
                <td> : </td>
                <td>
                    <?php
                        $bfallar = $this->fal->yorumcu_baktigi_fallar($yorumcu_data->baktigi_fallar);
                        $yorumcu_data->baktigi_fallar = $bfallar;
                    ?>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["kahve_fali"])) { echo ' checked="" ';} ?> name="kahve_fali" type="checkbox" class="custom-control-input" id="kahve-fali-c" name="">
                              <label class="custom-control-label" for="kahve-fali-c">Kahve Falı</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["tarot_fali"])) { echo ' checked="" ';} ?> name="tarot_fali" type="checkbox" class="custom-control-input" id="tarot-fali-c">
                              <label class="custom-control-label" for="tarot-fali-c">Tarot Falı</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["yildizname"])) { echo ' checked="" ';} ?> name="yildizname" type="checkbox" class="custom-control-input" id="yildizname-c">
                              <label class="custom-control-label" for="yildizname-c">Yıldızname</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["ruya_yorumu"])) { echo ' checked="" ';} ?> name="ruya_yorumu" type="checkbox" class="custom-control-input" id="ruya-yorumu-c">
                              <label class="custom-control-label" for="ruya-yorumu-c">Rüya Yorumu</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["katina_fali"])) { echo ' checked="" ';} ?> name="katina_fali" type="checkbox" class="custom-control-input" id="katina-fali-c">
                              <label class="custom-control-label" for="katina-fali-c">Katina Aşk Falı</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["su_fali"])) { echo ' checked="" ';} ?> name="su_fali" type="checkbox" class="custom-control-input" id="su-fali-c">
                              <label class="custom-control-label" for="su-fali-c">Su Falı</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input <?php if (isset($yorumcu_data->baktigi_fallar["dert_ortagi"])) { echo ' checked="" ';} ?> name="dert_ortagi" type="checkbox" class="custom-control-input" id="dert-ortagi-c">
                              <label class="custom-control-label" for="dert-ortagi-c">Dert Ortağı</label>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td><b>Fiyat Listesi</b></td>
                <td> : </td>
                <td>
                    
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Kahve Falı</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_kf" value="<?=$yorumcu_data->fiyat_listesi["kahve_fali"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Tarot Falı</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_tf" value="<?=$yorumcu_data->fiyat_listesi["tarot_fali"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Yıldızname</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_yn" value="<?=$yorumcu_data->fiyat_listesi["yildizname"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Rüya Yorumu</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_ry" value="<?=$yorumcu_data->fiyat_listesi["ruya_yorumu"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Katina Falı</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_ktf" value="<?=$yorumcu_data->fiyat_listesi["katina_fali"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Su Falı</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_sf" value="<?=$yorumcu_data->fiyat_listesi["su_fali"]?>"></td>
                            </tr>
                            <tr>
                                <td><b>Dert Ortağı</b></td>
                                <td> : </td>
                                <td><input class="form-control" type="number" name="fiyat_do" value="<?=$yorumcu_data->fiyat_listesi["dert_ortagi"]?>"></td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td><b>Kısa Açıklama</b></td>
                <td> : </td>
                <td><textarea style="height:100px" name="aciklama" class="form-control"><?=$yorumcu_data->aciklama?></textarea></td>
            </tr>
            <tr>
                <td><b>Uzun Açıklama</b></td>
                <td> : </td>
                <td><textarea style="height:200px" name="aciklama_uzun" class="form-control"><?=$yorumcu_data->aciklama_uzun?></textarea></td>
            </tr>
        </tbody>
    </table>
</form>




<script type="text/javascript">
    var cropping = false;

    $(document).ready(function(){
        image_crop = $('#image_demo').croppie({
            enableExif: true,
                viewport: {
                width:300,
                height:300,
                type:'square'
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#upload_image').on('change', function(e){
            var fileTypes = ['jpg', 'jpeg', 'png', 'bmp', 'JPG', 'PNG', 'JPEG', 'BMP']; 
            var f = e.target.files[0];
            var extension = f.name.split('.').pop().toLowerCase();
            var isSuccess = fileTypes.indexOf(extension) > -1;

            if (!isSuccess)
            {
                $.notify("Lütfen sadece resim dosyaları seçin!", "error");
                return;
            }

            var reader = new FileReader();
            reader.onload = function (event) {
                image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal();
        });

        $('.crop_image').click(function(event){

            if (cropping == true){
                return;
            }

            cropping = true;

            image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                    url: base_url+"admin/yorumcular/<?=$yorumcu_data->id?>/pp-change",
                    type: "POST",
                    data:{"image": response},
                    beforeSend: function(){
                        $(".crop_image").val("Kaydediliyor...");
                        $(".crop_image").attr("disabled", "");
                    },
                    success:function(result)
                    {
                        if (result.substring(0,7) == "success"){
                            $('#uploadimageModal').modal('hide');
                            $("#img-uploaded").attr("src", result.substring(8));
                            $.notify("Profil fotoğrafı değiştirildi!", "success");
                        }else{
                            $.notify("Bilinmeyen bir hata oluştu!", "error");
                        }

                        $("#upload_image").val("");

                        $('#uploadimageModal').modal('hide');
                        $(".crop_image").val("Kaydet");
                        $(".crop_image").removeAttr("disabled", "");
                        cropping = false;
                    },
                    error:function(r){
                        cropping = false;
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                        $(".crop_image").val("Kaydet");
                        $(".crop_image").removeAttr("disabled", "");
                        $("#upload_image").val("");
                    }
                });
            })
        });
    });
</script>

<style type="text/css">
    #image_demo{
        width: 100% !important;
    }
</style>