<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  
  <div class="msg-baslik">
    <div class="row msg-user-wrapper">

      <div class="col-md-6 msg-user-wrapper">
        <div class="msg-pp">
          <img class="img-circle" onerror="this.src='<?=base_url()?>src/img/pp.png';" src="<?=base_url()?>uploads/<?=$yorumcu->pp?>">
        </div>
        <div class="msg-title msg-name">
          <?=$yorumcu->name?>
        </div>
      </div>

      <div class="col-md-6" style="width: 100%">
        <div class="msg-title" style="float:right">
          Mesajlar
        </div>
      </div>

    </div>
  </div>

  <div class="messaging">
    <div class="inbox_msg">
      <div class="msg_history">
          <?php

            foreach ($messages as $row)
            {
                ?>
                  <div class="<?php if ($row["from_who"] == "user"){echo'giden';}else{echo'gelen';}?>_msg">
                    <div class="<?php if ($row["from_who"] == "user"){echo'yollanan';}else{echo'alinan';}?>_msg">
                      <p><?=$row["message"]?></p>
                      <span class="time_date"><?=$row["date_send"]?></span>
                    </div>
                  </div>
                <?php
            }

          ?>
        

      </div>
      <div class="type_msg">
        
        <div class="input_msg_write">
          <form class="msg-form">
            <input autofocus="" autocomplete="off" type="text" name="message" class="write_msg" placeholder="Mesajınızı Girin" />
            <button class="msg_send_btn" type="submit">
              <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<style>

	body{background: #f1f1f1}


</style>

<script type="text/javascript">
  var messageBody = $('.msg_history')[0];
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
  $(document).ready(function(){
    
    $(".msg-form").submit(function(e){
      e.preventDefault();
      var msg = $(".write_msg").val();
      if (msg.trim() == "")
        return;

      var form_data = new FormData($(this)[0]);
      $(".write_msg").val("");

      $.ajax({
        url : base_url + "mesaj/<?=$yorumcu->id?>/gonder",
        type : "post",
        data : form_data,
        contentType : false,
        processData : false,
        beforeSend: function(){
          var today = new Date();
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

          $(".msg_history").append('<div class="giden_msg">'
                  +'<div class="yollanan_msg">'
                    +'<p>'+msg+'</p>'
                    +'<span class="time_date">'+date+' '+time+'</span>'
                  +'</div>'
                +'</div>');
          var messageBody = $('.msg_history')[0];
          messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        },
        success : function(result) {
          if (result == "error")
          {
            $.notify("Bilinmeyen bir hata oluştu, mesajınız gönderilmedi!", "error");
          }
        },
        error : function(r){
          console.log(r);
          $.notify("Bilinmeyen bir hata oluştu, mesajınız gönderilmedi!", "error");
        }
      });

    });

  });

</script>