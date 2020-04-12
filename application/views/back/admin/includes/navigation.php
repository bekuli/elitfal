<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="col-md-3 col-lg-2 d-none d-md-block sidebar" id="nav">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "home"){?>active<?php } ?>" data-title="Dashboard" href="<?= base_url()?>admin/">
            <i class="fas fa-home"></i>
            Anasayfa
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page_name == "users"){?>active<?php } ?>" data-title="Users" href="<?= base_url()?>admin/users">
            <i class="fas fa-link"></i>
            Kullanıcılar
          </a>
        </li>
	  <li class="nav-item">
		  <a class="nav-link <?php if ($page_name == "yorumcular"){?>active<?php } ?>" data-title="Yorumcular" href="<?= base_url()?>admin/yorumcular">
			  <i class="fas fa-user"></i>
			  Yorumcular
		  </a>
	  </li>
    	<li class="nav-item">
    	  <a class="nav-link <?php if ($page_name == "settings"){?>active<?php } ?>" data-title="odemeler" href="<?= base_url()?>admin/odemeler">
    		<i class="fas fa-lira-sign"></i>
    		Ödemeler
    	  </a>
    	</li>

        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "settings"){?>active<?php } ?>" data-title="kredi" href="<?= base_url()?>admin/kredi">
            <i class="fas fa-coins"></i>
            Kredi
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "settings"){?>active<?php } ?>" data-title="yorumcu_basvurulari" href="<?= base_url()?>admin/yorumcu_basvurulari">
            <i class="fas fa-bookmark"></i>
            Yorumcu Başvuruları
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "settings"){?>active<?php } ?>" data-title="iletisim" href="<?= base_url()?>admin/iletisim">
            <i class="fas fa-address-book"></i>
            İletişim
          </a>
        </li>

    	<li class="nav-item">
    	  <a class="nav-link <?php if ($page_name == "settings"){?>active<?php } ?>" data-title="Settings" href="<?= base_url()?>admin/ayarlar">
    		<i class="fas fa-cog"></i>
    		Ayarlar
    	  </a>
    	</li>

        
      </ul>

    </div>
</nav>

<script type="text/javascript">
    
    $(document).ready(function(){
        $("#nav a").on('click',function(e){

            e.preventDefault();

            var url = $(this).attr("href");
            $("#nav").find("a").removeClass("active");
            $(this).addClass("active");

            window.history.pushState("", "", url);
            set_page(url);
        });
    });

</script>