<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form action="<?=base_url()."admin/kredi/".$data->id."/update"?>"method="POST" id="kredi-edit-form">
    <table style="width:100%">
        <tbody>
            <tr>
                <td><b>Fiyat (TL)</b></td>
                <td> : </td>
                <td><input type="number" name="fiyat" class="form-control" value="<?=$data->fiyat?>"></td>
            </tr>
            <tr>
                <td><b>Kredi</b></td>
                <td> : </td>
                <td><input type="number" name="kredi" class="form-control" value="<?=$data->kredi?>"></td>
            </tr>
            <tr>
                <td><b>Açıklama</b></td>
                <td> : </td>
                <td><input type="text" name="aciklama" class="form-control" value="<?=$data->aciklama?>"></td>
            </tr>
        </tbody>
    </table>
</form>