<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 panel_header">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Yorumcu Panel</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="<?=base_url()."yorumcu/logout"?>">Çıkış Yap</a>
        <a class="nav-link" style="color:#dc3545;margin-right:10px;" href="http://192.168.1.47/urlsdeneme/admin"><?=$profil->name?></a>
      </li>
    </ul>
</nav>