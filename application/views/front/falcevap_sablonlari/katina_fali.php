<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-12 marbot20">

    <div class="cevap-card ">
        <div class="cevap-card-baslik">Fal Bilgileri</div>
        <div class="cevap-card-body">

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Kart Seçimi (10 Adet)</h5>
                </div>
                <div class="col-md-9">
                    
                    <ul class="card-list-cevap">

                        <?php

                        for ($i = 1; $i <= 78; $i++){
                            $isactive = false;

                            

                            foreach ($fal_icerik["kartlar"] as $row){
                                if ($i == $row)
                                {
                                    $isactive = true;
                                    break;
                                }
                            }


                            echo '<li ';

                            if ($isactive == true)
                                echo 'class="active"';

                            echo '>';


                            echo'</li>';
                        }

                        ?>

                </div>

            </div>


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