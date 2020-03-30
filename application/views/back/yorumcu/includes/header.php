<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="top-nav navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 panel_header">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Yorumcu Panel</a>
    <ul class="navbar-nav" >
      

      <li class="dropdown nav-item text-nowrap bildirim">
        <a class="bildirim nav-link dropdown-toggle" id="bildirim" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> <span id="notfycount"></span></a>
        <div class="dropdown-menu bildirim-list" aria-labelledby="bildirim">
        </div>
      </li>

      <li class="nav-item text-nowrap">
        <a class="nav-link" style="color:#dc3545;" href="<?=base_url()?>yorumcu/profil"><?=$profil->name?></a>
      </li>

      <li class="nav-item text-nowrap">
        <a class="nav-link" href="<?=base_url()."yorumcu/logout"?>">Çıkış Yap</a>
        
      </li>
      
    </ul>
</nav>

<style>
	.top-nav .navbar-nav{
		display: block;
		margin-right:15px;
	}

	.top-nav .navbar-nav li.nav-item{
		float:left;
		margin-right:15px;
	}

	.dropdown.open .dropdown-menu{
		display: block;
		
	}

	.dropdown .dropdown-menu{
		position: absolute !important;
	}

	.bildirim-list{
		padding:0px;
		width: 190px;
		overflow: hidden;
		font-size:14px;
	}
	.bildirim-list a{
	display: block;
	color:#333;
	padding: 5px;
	border-bottom: 1px solid #ececec;
	}

	.bildirim-list a:hover{
		text-decoration: underline;
	}


	.bildirim-list  a:last-child{
		border-bottom: 0px;
	}
	</style>