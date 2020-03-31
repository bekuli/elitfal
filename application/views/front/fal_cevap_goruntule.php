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
					<img class="img-circle" onerror="this.src='<?=base_url()?>src/img/pp.png';" src="<?=base_url()?>uploads/<?=$fal_data->yorumcu["pp"]?>">
				</div>

				<div class="isim">
					<?=$fal_data->yorumcu["name"]?>
				</div>

				<div class="online-status">
                	<?php
                    if (strtotime($fal_data->yorumcu["last_online"]) + 10 < time()){
                    ?>
                    <span class="badge">Çevrimdışı</span>
                    <?php }else{ ?>
                    <span class="badge active">Çevrimiçi</span>
                    <?php } ?>
                </div>

				<div class="review-stars">
                    <?php
                        for ($i = 0; $i < $puan; $i++)
                            echo '<i class="active fa fa-star"></i>';
                        for ($i = $puan; $i < 5; $i++)
                            echo '<i class=" fa fa-star"></i>';
                        ?>
                        <span class="comment-count">(<?=count($comments)?>)</span>
                </div>

                <div class="mesaj-gonder-btn">
                	<a href="<?=base_url()?>mesaj/<?=$fal_data->yorumcu["id"]?>">Mesaj Gönder</a>
                </div>
            </div>
        </div>

        <?php if ($this->fal->empty_fal($fal_data->comment)) { ?>
        <div class="comment col-md-3">
            <div class="yorum-gonder-kart">
                <div class="yorum-ack">
                    Falınızı beğendinizmi? yorum yapmayı unutmayın
                </div>
                
                <div class="yorum-gonder-btn">
                    <a href="#">
                        Yorum Gönder
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>

	</div>
</div>

<?php if ($this->fal->empty_fal($fal_data->comment)) { ?>

<div class="comment modal fade" id="yorum-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Yorum Gönder</h4>
      </div>
      <div class="modal-body">
        <form method="post">
            <label>Yorumunuz</label>
            <textarea name="comment" class="form-control" id="yorum-text"></textarea><br>
            <label>Oyunuz</label>
            <div class="pt-form-grup" id="yorum_oyla_grup">
                <div class="yorum_oyla">
                  <div class="review-stars">
                    <i class="fa fa-star" data-oy="1"></i><i class="fa fa-star" data-oy="2"></i><i class="fa fa-star" data-oy="3"></i><i class="fa fa-star" data-oy="4"></i><i class="fa fa-star" data-oy="5"></i>
                  </div>
                </div>

                <input type="hidden" id="oy_value" name="oy_value">
            </div>
            <br>
            <button type="submit" class="btn btn-def">Gönder</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var submitting_yorum = false;
    var oylandi = 0;
    var oylandihover = 0;
    var oylandibefore = 0;
    var oyvalue = 0;

    $(document).ready(function(){
        $(".yorum-gonder-btn a").click(function(e){
            e.preventDefault();
            $("#yorum-modal").modal();

            setTimeout(
            function() {
              $("#yorum-text").focus();
            }, 500);
        });

        $("#yorum-modal form").submit(function(e){
            e.preventDefault();

            if ($.trim($('#yorum-modal textarea').val()) == ""){
                $.notify("Yorum boş gönderilemez", "error");
                return;
            }

            if (oyvalue == 0){
                $.notify("Oylamadınız!", "error");
                return;
            }

            $("#yorum-modal form button").val("Gönderiliyor...");
            $("#yorum-modal form button").attr("disabled", "");

            if (submitting_yorum == true)
                return;
            submitting_yorum = true;
            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "profil/cevap/<?=$fal_data->id?>/comment",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                success : function(result) {
                    if (result == "true"){
                        $.notify("Yorumunuz gönderildi!", "success");
                        $("#yorum-modal").modal('hide');
                        setTimeout(
                        function() {
                          $(".comment").each(function(){
                            $(this).remove();
                        });
                        }, 500);
                        
                    }else{
                        $.notify("Bilinmeyen bir hata oluştu!", "error");
                        submitting_yorum = false;
                        $("#yorum-modal form button").val("Gönder");
                        $("#yorum-modal form button").removeAttr("disabled", "");
                    }
                    
                },
                error : function(r){
                    $.notify("Bilinmeyen bir hata oluştu!", "error");
                    submitting_yorum = false;
                    $("#yorum-modal form button").val("Gönder");
                    $("#yorum-modal form button").removeAttr("disabled", "");
                }
            });
        });

        //Yorum oyla
        
        $(".yorum_oyla>.review-stars>i").hover(function(){
            if (oylandihover == 0)
            {
                oylandi = 0;
                var imgindex = $(this).attr("data-oy");
                for (var i = 1; i <= imgindex; i++)
                    $("i[data-oy="+i+"]").addClass("active");
                for (var i = 5; i > imgindex; i--)
                    $("i[data-oy="+i+"]").removeClass("active");
            }
            
        }, function(){
            if (oylandi == 0)
            {
                var imgindex = $(this).attr("data-oy");
                for (var i = 5; i >= imgindex; i--)
                    $("i[data-oy="+i+"]").removeClass("active");
            }
            oylandihover = 0;
            
        });
        
        $(".yorum_oyla>.review-stars").hover(function(){
            
        }, function(){
            if (oylandi == 0)
            {
                if (oylandibefore !== 1)
                {
                    for (var i = 1; i <= 5; i++)
                        $("i[data-oy="+i+"]").removeClass("active");
                }
                else
                {
                    for (var i = 5; i > oyvalue; i--)
                        $("i[data-oy="+i+"]").removeClass("active");
                    for (var i = 1; i <= oyvalue; i++)
                        $("i[data-oy="+i+"]").addClass("active");
                }
            }
            oylandihover = 0;
        });
        
        $(".yorum_oyla>.review-stars>i").click(function(){
            $("#oy_value").val($(this).attr("data-oy"));
            oylandi = 1;
            oylandihover = 1;
            oylandibefore = 1;
            oyvalue = $(this).attr("data-oy");
            
        });
            
        // */Yorum oyla end

    });
</script>

<?php } ?>

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

    .yorum_oyla .review-stars i.active{
        color:orange;
    }

    .yorum_oyla .review-stars{
        display: inline-block;
    }

    .yorum_oyla .review-stars i{
        cursor:pointer;
        font-size:20px;
        padding-right:5px;
    }


</style>