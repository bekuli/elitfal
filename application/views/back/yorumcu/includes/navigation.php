<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="col-md-2 d-none d-md-block sidebar" id="nav">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "home"){?>active<?php } ?>" data-title="Dashboard" href="<?= base_url()?>yorumcu/">
            <i class="fas fa-home"></i>
            Anasayfa
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($page_name == "falistekleri"){?>active<?php } ?>" data-title="Fal İstekleri" href="<?= base_url()?>yorumcu/falistekleri">
            <i class="fas fa-link"></i>
            Fal İstekleri
          </a>
        </li>
	  <li class="nav-item">
		  <a class="nav-link <?php if ($page_name == "yorumlar"){?>active<?php } ?>" data-title="" href="<?= base_url()?>yorumcu/yorumlar">
			  <i class="fas fa-comment"></i>
			  Yorumlar
		  </a>
	  </li>
    	<li class="nav-item">
    	  <a class="nav-link <?php if ($page_name == "mesajlar"){?>active<?php } ?>" data-title="" href="<?= base_url()?>yorumcu/mesajlar">
    		<i class="fas fa-inbox"></i>
    		Mesajlar
    	  </a>
    	</li>
    	<li class="nav-item">
    	  <a class="nav-link <?php if ($page_name == "odemeler"){?>active<?php } ?>" data-title="" href="<?= base_url()?>yorumcu/odemeler">
    		<i class="fas fa-lira-sign"></i>
    		Ödemeler
    	  </a>
    	</li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page_name == "profil"){?>active<?php } ?>" data-title="" href="<?= base_url()?>yorumcu/profil">
            <i class="fas fa-user"></i>
            Profil
          </a>
        </li>

    	<li class="nav-item">
    	  <a class="nav-link <?php if ($page_name == "ayarlar"){?>active<?php } ?>" data-title="" href="<?= base_url()?>yorumcu/ayarlar">
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