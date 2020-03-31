<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<table class="table">
    <tbody>
        <tr>
            <td><b>Profil Fotoğrafı</b></td>
            <td> : </td>
            <td><img onerror="this.src='<?=base_url()?>src/img/pp.png';" width="75" class="img-circle" src="<?=base_url()?>uploads/<?=$yorumcu_data->pp?>"></td>
        </tr>
        <tr>
            <td><b>İsim</b></td>
            <td> : </td>
            <td><?=$yorumcu_data->name?></td>
        </tr>
        <tr>
            <td><b>Eposta</b></td>
            <td> : </td>
            <td><?=$yorumcu_data->email?></td>
        </tr>
        <tr>
            <td><b>Kayıt Tarihi</b></td>
            <td> : </td>
            <td><?=date("m/d/Y", strtotime($yorumcu_data->tarih));?></td>
        </tr>
        <tr>
            <td><b>Hesap Durumu</b></td>
            <td> : </td>
            <td><?php
                if ($yorumcu_data->status == 1)
                    echo "Aktif";
                else
                    echo "Deaktif";
                ?></td>
        </tr>
        <tr>
            <td><b>Son Online</b></td>
            <td> : </td>
            <td><?=date("m/d/Y H:i:s", strtotime($yorumcu_data->last_online));?></td>
        </tr>
        <tr>
            <td><b>Baktığı fallar</b></td>
            <td> : </td>
            <td>
                <?php
                    $bfallar = $this->fal->yorumcu_baktigi_fallar($yorumcu_data->baktigi_fallar);
                    $i = 0;
                    foreach ($bfallar as $key => $value)
                    {
                        if ($i == count($bfallar)-1)
                            echo $this->fal->fal_turu_name_to_org($key);
                        else
                            echo $this->fal->fal_turu_name_to_org($key).", ";
                        $i++;
                    }
                ?>
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
                            <td><?=$yorumcu_data->fiyat_listesi["kahve_fali"]?></td>
                        </tr>
                        <tr>
                            <td><b>Tarot Falı</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["tarot_fali"]?></td>
                        </tr>
                        <tr>
                            <td><b>Yıldızname</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["yildizname"]?></td>
                        </tr>
                        <tr>
                            <td><b>Rüya Yorumu</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["ruya_yorumu"]?></td>
                        </tr>
                        <tr>
                            <td><b>Katina Falı</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["katina_fali"]?></td>
                        </tr>
                        <tr>
                            <td><b>Su Falı</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["su_fali"]?></td>
                        </tr>
                        <tr>
                            <td><b>Dert Ortağı</b></td>
                            <td> : </td>
                            <td><?=$yorumcu_data->fiyat_listesi["dert_ortagi"]?></td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>
        <tr>
                <td><b>Kısa Açıklama</b></td>
                <td> : </td>
                <td><textarea style="height:100px;cursor: default" disabled="" class="form-control"><?=$yorumcu_data->aciklama?></textarea></td>
            </tr>
            <tr>
                <td><b>Uzun Açıklama</b></td>
                <td> : </td>
                <td><textarea style="height:200px;cursor: default" disabled="" class="form-control"><?=$yorumcu_data->aciklama_uzun?></textarea></td>
            </tr>
    </tbody>
</table>
