<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-lg-9 marbot20">

    <div class="card border-light ">
        <div class="card-header">Fal Bilgileri</div>
        <div class="card-body">

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Soru</h5>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control tbd" disabled="" style="min-height: 200px"><?=$fal_icerik["soru"]?></textarea>
                </div>
            </div>

            <div class="row satir">
                <div class="col-md-12">
                    <h5>Resimler</h5>
                </div>
                <div class="col-md-12">
                    
                    <?php

                    foreach ($fal_icerik["resimler"] as $row){ ?>
                    <div class="kahve-fali-img">
                        <a href="<?=base_url()?>uploads/<?=$row?>" target="_blank">
                            <img src="<?=base_url()?>uploads/<?=$row?>">
                        </a>
                    </div>

                    <?php }?>

                </div>
            </div>

        </div>
    </div>

</div>