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
		
			
			<div class="landing-top">
				<div class="container">
					<div class="title-1">
						CANLI FAL BAKTIRMA SİTESİNE HOŞGELDİNİZ
					</div>
				</div>
			</div>
			
			<div class="landing-mid">
				<div class="container">
					<div class="row">

						<div class="col-md-6">
							<div class="landing-title">
								BU AYIN POPÜLER YORUMCULARI
							</div>
						</div>

						<div class="col-md-6">
							<div class="landing-title">
								FAL TÜRLERİ
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="landing-bot">
				<div class="container">
					<div class="row">

						<div class="col-md-6 landing-yorumcular">

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>uploads/yorumcupp.jpg" class="img-circle">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

						</div>

						<div class="col-md-6 landing-fal-turleri" >

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-kahve.png">
										</div>
										<div class="landing-box-title">
											KAHVE FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-tarot.png">
										</div>
										<div class="landing-box-title">
											TAROT FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-yildiz.png">
										</div>
										<div class="landing-box-title">
											YILDIZNAME
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-ruya-yorumu.png">
										</div>
										<div class="landing-box-title">
											RÜYA YORUMU
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-katina.png">
										</div>
										<div class="landing-box-title">
											KATİNA AŞK FALI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-dert.png">
										</div>
										<div class="landing-box-title">
											DERT ORTAĞI
										</div>
									</a>
								</div>
							</div>

							<div class="col-md-4 landing-box-wrapper">
								<div class="landing-box">
									<a href="">
										<div class="landing-box-img">
											<img src="<?=base_url()?>src/img/icon-landing-su.png">
										</div>
										<div class="landing-box-title">
											SU FALI
										</div>
									</a>
								</div>
							</div>

							

						</div>

					</div>
				</div>
			</div>

	</div>
</header>
asd
<?php
include "footer.php";
?>