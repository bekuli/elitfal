<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                Tarih
            </div>
            <div class="urltable-th ut-m">
                Ad Soyad
            </div>
            <div class="urltable-th ut-m">
                Email
            </div>
            <div class="urltable-th ut-m">
                Telefon Numarası
            </div>
            <div class="urltable-th ut-actions">
                
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($basvuru_list))
        {
            foreach ($basvuru_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">

                                <?php
                                    if (!empty($row["tarih"]))
                                        echo date("d/m/Y H:i:s", strtotime($row["tarih"]));
                                    else
                                        echo "-";
                                ?>
                            </div>
                            <div class="urlbox-td urlbox-m">
                                <span class="hidden-text">Ad Soyad: </span>
                                <?=$row["name"]?>

                            </div>
                            <div class="urlbox-td urlbox-m">
                                <span class="hidden-text">Email: </span>
                                <?=$row["email"]?>
                            </div>
                            <div class="urlbox-td urlbox-m">
                                <span class="hidden-text">Telefon: </span>
                                <?=$row["tel"]?>
                            </div>

                            <div class="urlbox-td urlbox-actions" data-id="<?=$row["id"]?>">

                                <a data-toggle="tooltip" data-placement="bottom" data-action="view" title="Mesajı Görüntüle" href="#"><i class="fas fa-eye"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" data-action="delete" title="Sil" href="#"><i class="fas fa-trash"></i></a>
                            </div>

                            
                        </div>
                    </div>
                </div>

        <?php 

            }

            ?>

            

            <?php
        }else{
            echo '<center style="margin-top:20px">Gösterilcek bişey bulunmamaktadır...</center>';
        }

        ?>

    </div>

    

</div>

<?php

    if (!empty($basvuru_list))
    {
        ?>
    <div class="urltable-pagination">
        <nav>
            <ul class="pagination">

                <?php 
                if (isset($pagination)) 
                    echo $pagination;
                ?>
            </ul>
        </nav>
        
    </div>

<?php } ?>

<script>
    $('.urltable-content [data-toggle="tooltip"]').tooltip();
</script>

<style type="text/css">.ut-m, .urlbox-m{max-width:300px !important}</style>