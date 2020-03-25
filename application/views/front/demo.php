<?php defined('BASEPATH') OR exit('No direct script access allowed');

$user_data = null;

if ($this->fal->check_login() == true)
{
	$query = $this->db->get_where("users", array("id" => $this->session->userdata("id"), "status" => 1));
    if ($query !== false && $query->num_rows() > 0)
    {
        $user_data = $query->row();
    }
}

include "top.php";?>

<div class="header">
	<div class="header-top">
		<div class="container">
			<div class="user-datas">
				<ul>
					<li><a href="">Giriş</a></li>
					<li><a href="">Kayıt</a></li>
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
          <a class="navbar-brand" href="<?=base_url()?>"><img width="183" src="<?=base_url()?>src/img/logo.png"></a>
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
            <li><a href="<?=base_url()?>kredi-satin-al">Fiyatlandırma</a></li>
            <li><a href="#">Yorumcu Ol</a></li>
            <li><a href="#">İletişim</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</div>

<header>
	<div class="landing-bg"></div>


	<div class="landing-icerik">
		
		<div class="container">
			<div class="title-1">
				CANLI FAL SİTESİNE HOŞGELDİNİZ
			</div>
		</div>

	</div>
</header>
asd
<?php
include "footer.php";
?>

<style>

	.header{
		position: absolute;
		width: 100%;
		z-index: 99
	}
	.header .header-top{
		position: relative;
		background: rgba(255, 255, 255, 0.1);
	}

	.header .header-top ul{
		margin:0px;
		padding:10px 0px;
		float:right;
		height: 100%;
	}

	.header .header-top ul li{
		float:left;
		margin-left:15px;
	}

	.header .header-top ul li a{
		color:rgba(255, 255, 255, 0.7);
		font-weight: normal;
		font-family: 'montserrat', sans-serif;
	}

	header .landing-bg{
		width: 100%;
		height: 100%;
		position: absolute;
		-webkit-transition:40s;
		transition: 40s;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
		background-image : url(<?=base_url()?>src/img/home-landing.jpg);
		-webkit-animation: zoom 60s linear infinite alternate;
	    -moz-animation: zoom 60s linear infinite alternate;
	    -o-animation: zoom 60s linear infinite alternate;
	}

	@-webkit-keyframes zoom {
    0% {
        -webkit-transform: scale(1);
        transform: scale(1)
    }
    50% {
        -webkit-transform: scale(1.1);
        transform: scale(1.4)
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1)
    }
}

@keyframes zoom {
    0% {
        -webkit-transform: scale(1);
        transform: scale(1)
    }
    50% {
        -webkit-transform: scale(1.1);
        transform: scale(1.4)
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1)
    }
}
	


	.header nav{
		background:none !important;
		border:none;
	}

	.header nav .navbar-nav{
		float:right;
		margin-right:-15px;

	}

	.header nav .navbar-nav > li > a{
		color:#fff;
		font-weight: normal;
		font-family: 'montserrat', sans-serif;
		font-size:18px;
		border:2px solid transparent;
	}

	.header nav .navbar-nav > li > a:hover{
		color:#fff;
		border:2px solid rgba(255, 255, 255, 0.5) !important;
		-webkit-transition:0.5s;
		transition: 0.5s;
		outline:0;
	}

	.header nav .navbar-nav > li > a:focus{
		color:#fff;
		border:2px solid rgba(255, 255, 255, 0.5) !important;
	}

	 .header nav .navbar-nav > .open > a{
	 	color:#fff !important;
		border:2px solid rgba(255, 255, 255, 0.5) !important;
	 }

	 .header nav .navbar-nav .dropdown-menu{
	 	background: rgba(255, 255, 255, 0.1);
	 }

	 .header nav .navbar-nav .dropdown-menu > li > a{
	 	color:#fff;
	 }

	 .header nav .navbar-nav .dropdown-menu > li > a:hover{
	 	background: rgba(255, 255, 255, 0.5) !important;
	 	-webkit-transition:0.5s;
		transition: 0.5s;
	 }

	.header #navbar{
		padding:0px;
		width:100%;
	}

	.header .navbar-brand{
		height:auto;
	}

	.header nav > .container{
		display: flex;
		align-items: center;
	}

	header{
		position: relative;
		overflow: hidden;
	}

	header .landing-icerik{
		display: flex;
		height: 100vh;
		-webkit-box-shadow: inset -1px 0px 71px -12px rgba(0, 0, 0, 0.67);
    	box-shadow: inset -1px 0px 71px -12px rgba(0, 0, 0, 0.67);
    	position: relative;
    	padding-top:200px;
	}

	header .landing-icerik .title-1{
		color:#fff;
		font-family: montserrat, sans-serif;
		font-size:50px;
	}

</style>