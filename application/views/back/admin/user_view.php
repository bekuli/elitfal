<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<table>
    <tbody>
        <tr>
            <td><b>İsim</b></td>
            <td> : </td>
            <td><?=$user_data->name?> <?=$user_data->surname?></td>
        </tr>
        <tr>
            <td><b>Eposta</b></td>
            <td> : </td>
            <td><?=$user_data->email?></td>
        </tr>
        <tr>
            <td><b>Telefon</b></td>
            <td> : </td>
            <td><?=$user_data->telefon?></td>
        </tr>
        <tr>
            <td><b>Kredi</b></td>
            <td> : </td>
            <td><?=$user_data->kredi?></td>
        </tr>
        <tr>
            <td><b>Kayıt Tarihi</b></td>
            <td> : </td>
            <td><?=date("m/d/Y", strtotime($user_data->tarih));?></td>
        </tr>
        <tr>
            <td><b>Hesap Durumu</b></td>
            <td> : </td>
            <td><?php
                if ($user_data->status == 1)
                    echo "Aktif";
                else
                    echo "Deaktif";
                ?></td>
        </tr>
        <tr>
            <td><b>Cinsiyet</b></td>
            <td> : </td>
            <td><?=$user_data->cinsiyet?></td>
        </tr>
        <tr>
            <td><b>İlişki Durumu</b></td>
            <td> : </td>
            <td><?=$user_data->iliski_durumu?></td>
        </tr>
        <tr>
            <td><b>Doğum Tarihi</b></td>
            <td> : </td>
            <td><?=date("m/d/Y", strtotime($user_data->dogum_tarihi));?></td>
        </tr>
    </tbody>
</table>