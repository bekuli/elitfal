<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="display:block !important">
    <div class="row">
        <div class="col-lg-9 marauto ust">
            <h1 class="h2" style="float:left">Fal : <?=$this->fal->fal_turu_name_to_org($fal_data->fal_turu)?></h1> 
            <a href="<?=base_url()?>yorumcu/falistekleri/<?=$fal_data->id?>/cevapla" class="btn btn-primary cevapla" style="float:right">Cevapla</a>  
        </div>
        <div class="col-lg-3">
            <h3>
            <?php

                $query = $this->db->get_where("users", array("id" => $fal_data->user_id));
                if ($query !== false && $query->num_rows() > 0)
                {
                    echo $query->row()->name;
                }

            ?>
            </h3>


        </div>
    </div>
</div>

<div class="row">
<?php

    include "falistekleri_sablonlari/".$fal_data->fal_turu.".php";
?>

    <div class="col-lg-3 marbot20">

        <div class="card border-light ">
            <div class="card-header">
                Profil
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Ad</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["ad"]?></td>
                        </tr>
                        <tr>
                            <td>Soyad</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["soyad"]?></td>
                        </tr>
                        <tr>
                            <td>Sektör</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["sektor"]?></td>
                        </tr>
                        <tr>
                            <td>Cinsiyet</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["cinsiyet"]?></td>
                        </tr>
                        <tr>
                            <td>İlişki</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["iliski"]?></td>
                        </tr>
                        <tr>
                            <td>Doğum Tarihi</td>
                            <td>:</td>
                            <td><?=$fal_icerik["bilgiler"]["tarih"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>


<style>
    .tbd{
        cursor:default;
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

    .card-list{
        margin:0px;
        padding:0px;
        list-style: none;
    }

    .card-list li{
        float:left;
        margin-right:5px;
        margin-bottom:5px;
        background: url(<?=base_url()?>src/img/tarot-card.png);
        width: 56px;
        height:74px;
    }

    .card-list li.active{
        background: url(<?=base_url()?>src/img/tarot-card-active.png);
    }

    .card-list .label{
        text-align: center;
        color:#fff;
        font-weight: bold;
        font-family: montserrat, sans-serif;
        line-height: 74px;

    }

    .kahve-fali-img{
        width: 200px;
        margin-right: 10px;
        margin-bottom: 10px;
        float:left;
    }

    .kahve-fali-img img{
        width:100%;
    }

</style>

<script type="text/javascript">
    $(document).ready(function(){
        $(".tbd").each(function(){
            $(this).css("height", $(this)[0].scrollHeight+10);
        });

        $(".ust").on("click", ".cevapla", function(e){
            e.preventDefault();
            
            var url = $(this).attr("href");
            window.history.pushState("", "", url);
            set_page(url);
        });
    });

    
</script>