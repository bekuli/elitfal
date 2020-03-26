<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="header <?php if ($page !== "home") { ?>header-normal<?php } ?>">
  <div class="header-top">
    <div class="container">
      <div class="user-datas">
        <ul>
          <li><a class="login-activate" href="#">Giriş</a></li>
          <li><a class="reg-activate" href="#">Kayıt</a></li>
        </ul>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>"><img width="130" src="<?=base_url()?>src/img/logo<?php if ($page !== "home") { ?>-2<?php } ?>.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">
            <li><a href="<?=base_url()?>">Anasayfa</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fal Türleri <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Kahve Falı</a></li>
                <li><a href="#">Tarot Falı</a></li>
                <li><a href="#">Yıldızname</a></li>
                <li><a href="#">Rüya Yorumu</a></li>
                <li><a href="#">Katina Aşk Falı</a></li>
                <li><a href="#">Su Falı</a></li>
                <li><a href="#">Dert Ortağı</a></li>
              </ul>
            </li>
            <li><a href="<?=base_url()?>yorumcular">Yorumcular</a></li>
            <li><a href="<?=base_url()?>kredi-satin-al">Fiyatlandırma</a></li>
            <li><a href="<?=base_url()?>yorumcu-ol">Yorumcu Ol</a></li>
            <li><a href="<?=base_url()?>iletisim">İletişim</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>