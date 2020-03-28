<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  
  <div class="msg-baslik">
    <div class="row msg-user-wrapper">

      <div class="col-md-6 msg-user-wrapper">
        <div class="msg-pp">
          <img class="img-circle" src="<?=base_url()?>uploads/yorumcupp.jpg">
        </div>
        <div class="msg-title msg-name">
          Beyza
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
          
        <div class="giden_msg">
          <div class="yollanan_msg">
            <p>Selam</p>
            <span class="time_date"> 11:05      |  Mayıs 9 </span>
          </div>
        </div>

        <div class="gelen_msg">
          <div class="alinan_msg">
            <div class="alinan_withd_msg">
              <p>Selam</p>
              <span class="time_date"> 11:06      |  Mayıs 9 </span>
            </div>
          </div>
        </div>

        <div class="giden_msg">
          <div class="yollanan_msg">
            <p>naber</p>
            <span class="time_date"> 11:10      |  Mayıs 9 </span>
          </div>
        </div>

        <div class="gelen_msg">
          <div class="alinan_msg">
            <div class="alinan_withd_msg">
              <p>iyi senden</p>
              <span class="time_date"> 15:50      |  Mayıs 9 </span>
            </div>
          </div>
        </div>

      </div>
      <div class="type_msg">
        
        <div class="input_msg_write">
          <input type="text" class="write_msg" placeholder="Mesajınızı Girin" />
          <button class="msg_send_btn" type="button">
            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
          </button>
        </div>

      </div>
    </div>
  </div>
</div>

<style>

	body{background: #f1f1f1}


</style>