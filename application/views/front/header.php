<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>">ELİT FAL</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">
            <li><a href="<?=base_url()?>">Anasayfa</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fal Türleri <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Katina</a></li>
                <li><a href="#">Kahve</a></li>
                <li><a href="#">Tarot</a></li>
                <li><a href="#">Su</a></li>
                <li><a href="#">Yıldızname</a></li>
                <li><a href="#">Rüya</a></li>
                <li><a href="#">Dert Ortağı</a></li>
              </ul>
            </li>
            <li><a href="<?=base_url()?>yorumcular">Yorumcular</a></li>
            <li><a href="<?=base_url()?>kredi-satin-al">Kredi Satın Al</a></li>
            <li><a href="#">Yorumcu Ol</a></li>
            <li><a href="#">İletişim</a></li>
          </ul>
          <ul class="nav navbar-nav header-right navbar-right" style="display: flex;align-items: center; height: 50px" >
            <?php
              if ($this->fal->check_login() == false) { ?>
            <li><a href="" class="buton-red">GİRİŞ</a></li>
            <li><a href="" class="buton-red">ÜYE OL</a></li>
          <?php }else{ ?>
            <li><a href="<?=base_url()?>profil"><?=$user_data->name." ".$user_data->surname?></a></li>
            <li><a href="<?=base_url()?>profil" class="buton-red">Profil</a></li>
            <li><a href="<?=base_url()?>logout" class="buton-red">Çıkış Yap</a></li>
          <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="nav-margin"></div>