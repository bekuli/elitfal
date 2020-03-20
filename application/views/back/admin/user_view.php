<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<table>
    <tbody>
        <tr>
            <td><b>İsim</b></td>
            <td> : </td>
            <td><?=$user_data->name?></td>
        </tr>
        <tr>
            <td><b>Eposta</b></td>
            <td> : </td>
            <td><?=$user_data->email?></td>
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
    </tbody>
</table>