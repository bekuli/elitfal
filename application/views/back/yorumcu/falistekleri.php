<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Fal İstekleri</h1>
</div>

<div class="urltable">

    <div class="row urltable-top">
        <div class="col-xl-6 col-md-6">
            <a href="<?=base_url()?>yorumcu/falistekleri/" data-type="0" class="<?php if ($status == "cevaplanmamis"){?> active <?php }?>btn-fal-cevap">Cevaplanmamış Fallar</a><a href="<?=base_url()?>yorumcu/falistekleri/cevaplanmis" data-type="1" class="btn-fal-cevap<?php if ($status == "cevaplanmis"){?> active <?php }?>">Cevaplanmış Fallar</a>
        </div>
        <div class="col-xl-4 col-md-4">
            
        </div>
        <div class="col-xl-2 col-md-2">
            <form method="POST" action="" id="search-url">
                <div class="input-group urls-search">
                  <input placeholder="Arama" type="text" class="form-control" aria-label="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                  </div>
                </div>
             </form>

        </div>
    </div>

    <div class="urltable-content">

        

    </div>

</div>



<script type="text/javascript">

    var urlprefix = "<?php if ($status == "cevaplanmis"){?>?1<?php }?>";
    var status = "<?php if ($status == "cevaplanmis"){?>1<?php }else{?>0<?php } ?>";

    $(".btn-fal-cevap").click(function(e){
        e.preventDefault();
        $(".btn-fal-cevap.active").removeClass("active");
        $(this).addClass("active");
        if ($(this).attr("data-type") == "1")
        {
            status = "1";
            urlprefix = "?1";
            $(".urltable-content").html(loading_set_np);
            $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list" + urlprefix);
            var url = "<?=base_url()?>yorumcu/falistekleri/cevaplanmis";
            window.history.pushState("", "", url);
            currentPathname = location.pathname;
            cur_url = url;
        }else{
            status = "0";
            urlprefix = "";
            $(".urltable-content").html(loading_set_np);
            $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list" + urlprefix);
            var url = "<?=base_url()?>yorumcu/falistekleri";
            window.history.pushState("", "", url);
            currentPathname = location.pathname;
            cur_url = url;
        }
    });
    
    $(document).ready(function () {

        $(".urltable-content").html(loading_set_np);
        $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list" + urlprefix);

        $(".urltable-content").on("click", "a[data-action]", function(e){
            e.preventDefault();
            
            if ($(this).attr("data-action") == "view"){
                var url = $(this).attr("href");
                window.history.pushState("", "", url);
                set_page(url);
                $("#nav").find("a").removeClass("active");
            }
        });
        
        

        $(".urltable-content").on("click", ".urltable-pagination a",function(e){
            e.preventDefault();
            
            if ($(this).attr("page") != "active")
            {
                var q = $(this).attr("search");
                if (typeof q !== typeof undefined && q !== false)
                    $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list/" + $(this).attr("page") + "/" + $(this).attr("search") + urlprefix);
                else
                    $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list/" + $(this).attr("page") + urlprefix);
            }
        });

        $("#search-url").submit(function(e){
            e.preventDefault();
            $(".urltable-content").load("<?=base_url()?>yorumcu/falistekleri_list/1/"+$("#search-url input").val() + urlprefix);
        });
    });
    
    
</script>

<style type="text/css">
    .btn-fal-cevap{
        background: #007bff;
        color:#fff;
        padding: 11px;
        margin-bottom: 5px;
        display: inline-block;
        border:1px solid #007bff;
        text-decoration: none;
        font-size:14px;
    }

    .btn-fal-cevap:hover{
        background: #005dc1;
        color:#fff;
        text-decoration: none;
    }

    .btn-fal-cevap.active{
        background: #fff;
        color:#007bff;
    }

    .ut-clicks{
        max-width: 250px !important;
    }

    .urlbox-clicks{
        max-width: 250px !important;
    }

    .ut-credits{
        max-width: 200px !important;
    }

    .urlbox-credits{
        max-width: 200px !important;
    }
</style>