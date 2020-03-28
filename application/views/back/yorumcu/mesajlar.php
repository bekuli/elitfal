<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Mesajlar</h1>
</div>

<div class="mesajlar">

    <div class="row">

        <div class="col-md-3">
            
            <div class="msg-list">
                <ul>
                    <?php foreach ($message_sessions as $row) {?>
                    <li><a href="#" data-id="<?=$row["user"]->id?>"><?=$row["user"]->name?> <?=$row["user"]->surname?></a>
                        <?php if ($row["notify_yorumcu"] == "true") { echo '<i class="fa fa-circle"></i>'; } ?>
                    </li>
                    <?php }?>
                </ul>
            </div>

        </div>

        <div class="col-md-9">
            <div class="msg-baslik">
                <div class="msg-title">

                </div>
            </div>

            <div class="messaging">
                <div class="inbox_msg">
                  <div class="msg_history">

                    

                  </div>
                  <div class="type_msg">
                    
                    <div class="input_msg_write">
                      <form class="msg-form">
                        <input autocomplete="off" type="text" name="message" class="write_msg" placeholder="Mesajınızı Girin" />
                        <button class="msg_send_btn" type="submit">
                          <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                      </form>
                    </div>

                  </div>
                </div>
            </div>
          </div>

      </div>

</div>

<script type="text/javascript">

    var cur_id = null;
    
    $(document).ready(function(){
        $(".msg-list a").click(function(e){
            e.preventDefault();
            var id = $(this).attr("data-id");
            var ad = $(this).text();
            var dot = $(this).parent().find("i");

            $.ajax({
                url : base_url + "yorumcu/get_messages/" + id,
                contentType : false,
                beforeSend: function(){
                    $(".msg_history").html(loading_set);
                },
                success : function(result) {
                    cur_id = id;
                    dot.remove();
                    $(".msg_history").html("");
                    if (result == false)
                        return;

                    $(".msg-title").text(ad);

                    var data = JSON.parse(result);
                    for (var i = 0; i < data.length; i++)
                    {
                        var msg = data[i];
                        if (msg.from_who == "user"){
                            $(".msg_history").append('<div class="gelen_msg">'
                              +'<div class="alinan_msg">'
                                +'<p>'+msg.message+'</p>'
                                +'<span class="time_date">'+msg.date_send+'</span>'
                              +'</div>'
                            +'</div>');
                        }else{
                            $(".msg_history").append('<div class="giden_msg">'
                              +'<div class="yollanan_msg">'
                                +'<p>'+msg.message+'</p>'
                                +'<span class="time_date">'+msg.date_send+'</span>'
                              +'</div>'
                            +'</div>');
                        }
                    }

                    var messageBody = $('.msg_history')[0];
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                },
                error : function(r){
                    
                }
            });
        });

        $(".msg-form").submit(function(e){
          e.preventDefault();
          if (cur_id == null)
            return;

          var msg = $(".write_msg").val();
          if (msg.trim() == "")
            return;

          var form_data = new FormData($(this)[0]);
          $(".write_msg").val("");

          $.ajax({
            url : base_url + "yorumcu/send_message/"+cur_id,
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