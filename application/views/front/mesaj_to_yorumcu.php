<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h3 class="text-center">Meaj Alanı</h3>
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

  .inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
  }

  .container {
    max-width: 1170px;
    margin-top: auto; 
  }

  .alinan_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }

 .alinan_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
 }

 .time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}

.yollanan_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}

.giden_msg {
  overflow: hidden;
  margin: 26px 0 26px;
}

.yollanan_msg {
  float: right;
  width: 15%;
  margin-right: 5px;
}

.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
}

.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}

.massaging {
  padding: 0 0 50px 0;
}

.msg_history {
  height: 516px;
  overflow-y: auto;
}

</style>