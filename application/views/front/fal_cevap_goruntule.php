<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="cevap-sayfa">
				<div class="row">
					<div class="col-lg-12 marbot20">
					    <div class="cevap-card ">
					        <div class="cevap-card-baslik">Fal Yorumu - <?=$this->fal->fal_turu_name_to_org($fal_data->fal_turu)?></div>
					        <div class="cevap-card-body">

					            <div class="row satir">
					                <div class="col-md-12">
					                    <textarea class="form-control tbd" disabled="" style="min-height: 200px"><?=$fal_data->fal_cevap?></textarea>
					                </div>
					            </div>

					        </div>
					    </div>

					</div>
				</div>

				<div class="row">
				<?php
				    include "falcevap_sablonlari/".$fal_data->fal_turu.".php";
				?>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="profil-karti-g" style="margin-top:30px">
				<div class="pp">
					<img class="img-circle" src="<?=base_url()?>uploads/yorumcupp.jpg">
				</div>

				<div class="isim">
					<?=$fal_data->yorumcu["name"]?>
				</div>

				<div class="online-status">
                	<span class="badge active">Çevrimiçi</span>
                </div>

				<div class="review-stars">
                    <i class="active fa fa-star"></i>
                    <i class="active fa fa-star"></i>
                    <i class="active fa fa-star"></i>
                    <i class="active fa fa-star"></i>
                    <i class=" fa fa-star"></i>
                    <span class="comment-count">(51)</span>
                </div>

                <div class="mesaj-gonder-btn">
                	<a href="<?=base_url()?>mesaj">Mesaj Gönder</a>
                </div>
            </div>
        </div>
	</div>
</div>

<style>
	body{background: #f1f1f1}

    .tbd{
        cursor:default !important;
        background: #fcfcfc !important;
        border-radius: 0px !important;
    }

    .satir{
        margin-bottom:20px;
    }

    th{
        border:0px !important;
        padding:0px !important;
    }

    table{
        margin-bottom: 0px !important;
    }

    .card-list-cevap{
        margin:0px;
        padding:0px;
        list-style: none;
    }

    .card-list-cevap li{
        float:left;
        margin-right:5px;
        margin-bottom:5px;
        background: url(<?=base_url()?>src/img/tarot-card.png);
        width: 56px;
        height:74px;
    }

    .card-list-cevap li.active{
        background: url(<?=base_url()?>src/img/tarot-card-active.png);
    }

    .card-list-cevap .label{
        text-align: center;
        color:#fff;
        font-weight: bold;
        font-family: montserrat, sans-serif;
        line-height: 74px;

    }

    .kahve-fali-img{
        width: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
        float:left;
    }

    .kahve-fali-img img{
        width:100%;
    }

</style>