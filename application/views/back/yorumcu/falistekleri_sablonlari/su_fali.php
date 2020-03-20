<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-9 marbot20">

    <div class="card border-light ">
        <div class="card-header">Fal Bilgileri</div>
        <div class="card-body">

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Açılım</h5>
                </div>
                <div class="col-md-12">
                    <?php

                        if ($fal_icerik["acilim"] == "genel_acilim")
                            echo 'Genel Açılım';
                        else
                            echo 'İlişki Açılımı'

                    ?>
                </div>
            </div>

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Doğum Bilgileri</h5>
                </div>
                <div class="col-md-12">
                    <table class="table">
                    <thead>
                        <tr>
                            <th style="width:35%"></th>
                            <th style="width:5%"></th>
                            <th style="width:60%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Doğum Günü</td>
                            <td>:</td>
                            <td><?=$fal_icerik["dogum_bilgileri"]["dogum_gunu"]?></td>
                        </tr>
                        <tr>
                            <td>Doğum Yeri</td>
                            <td>:</td>
                            <td><?=$fal_icerik["dogum_bilgileri"]["dogum_yeri"]?></td>
                        </tr>
                        <tr>
                            <td>Doğum Saati</td>
                            <td>:</td>
                            <td><?=$fal_icerik["dogum_bilgileri"]["dogum_saati"]?></td>
                        </tr>
                        <tr>
                            <td>Anne Adı</td>
                            <td>:</td>
                            <td><?=$fal_icerik["dogum_bilgileri"]["anne_adi"]?></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>

            <?php
            if ($fal_icerik["acilim"] == "iliski_acilimi"){
            ?>

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Partner Bilgileri</h5>
                </div>
                <div class="col-md-12">
                    <table class="table">
                    <thead>
                        <tr>
                            <th style="width:35%"></th>
                            <th style="width:5%"></th>
                            <th style="width:60%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Partner Adı</td>
                            <td>:</td>
                            <td><?=$fal_icerik["partner_bilgileri"]["partner_adi"]?></td>
                        </tr>
                        <tr>
                            <td>Partnerin Anne Adı</td>
                            <td>:</td>
                            <td><?=$fal_icerik["partner_bilgileri"]["partner_anne_adi"]?></td>
                        </tr>
                        <tr>
                            <td>Partnerin Burcu</td>
                            <td>:</td>
                            <td><?=$fal_icerik["partner_bilgileri"]["partner_burcu"]?></td>
                        </tr>
                        <tr>
                            <td>Partnerin Hakkında</td>
                            <td>:</td>
                            <td><?=$fal_icerik["partner_bilgileri"]["partner_hakkinda"]?></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>

            <?php } ?>

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Soru</h5>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control tbd" disabled="" style="min-height: 200px"><?=$fal_icerik["soru"]?></textarea>
                </div>
            </div>

        </div>
    </div>

</div>