<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form action="<?=base_url()."admin/yorumcular/".$user_data->id."/kredi-azalt-update"?>"method="POST" id="kredi-azalt-form">
    <table style="width:100%">
        <tbody>
            <tr>
                <td><b>Hesaptaki Kredi</b></td>
                <td> : </td>
                <td><?=$kredi?></td>
            </tr>
            <tr>
                <td><b>Kredi Miktarı</b></td>
                <td> : </td>
                <td><input type="number" name="kredi" class="form-control" value="0"></td>
            </tr>
        </tbody>
    </table>
</form>