<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<form action="<?=base_url()."admin/users/".$user_data->id."/update"?>"method="POST" id="user-edit-form">
    <table style="width:100%">
        <tbody>
            <tr>
                <td><b>Kredi Miktarı</b></td>
                <td> : </td>
                <td><input type="number" name="username" class="form-control" value="0"></td>
            </tr>
        </tbody>
    </table>

    <input type="hidden" name="user_id" value="<?=$user_data->id?>"
</form>