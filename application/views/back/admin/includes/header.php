<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 panel_header top-nav">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Panel</a>
    <ul class="navbar-nav px-3" style="display: block; width: 100%;"> 
    	<li class="nav-item text-nowrap">
        	<a class="nav-link" href="#" id="mobil-menu"><i class="fa fa-bars"></i></a>
      	</li>
      	<li class="nav-item text-nowrap" style="float: right;">
        	<a class="nav-link" href="<?=base_url()."admin/logout"?>">Çıkış Yap</a>
      	</li>
    </ul>
</nav>

<script type="text/javascript">
	
	$(document).ready(function(){
		$("#mobil-menu").click(function(e){
			e.preventDefault();
			$("#nav").toggleClass("aktif");
		});
	});

</script>

<style>
	.top-nav .navbar-nav{
		display: block;
		margin: 0px 15px;
	}

	.top-nav .navbar-nav li.nav-item{
		float:left;
		margin-right:15px;
	}
</style>