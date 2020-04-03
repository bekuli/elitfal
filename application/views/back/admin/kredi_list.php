<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                Açıklama
            </div>
            <div class="urltable-th ut-m">
                Fiyat
            </div>
            <div class="urltable-th ut-m">
                Kredi
            </div>
            <div class="urltable-th ut-actions">
                
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($kredi_list))
        {
            foreach ($kredi_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">
                                <span class="hidden-text">Açıklama: </span>
                                <?=$row["aciklama"]?>
                            </div>
                            <div class="urlbox-td urlbox-m">
                                <span class="hidden-text">Fiyat: </span>
                                <?=$row["fiyat"]?> TL

                            </div>
                            <div class="urlbox-td urlbox-m">
                                <span class="hidden-text">Kredi: </span>
                                <?=$row["kredi"]?>
                            </div>

                            <div class="urlbox-td urlbox-actions" data-id="<?=$row["id"]?>">

                                <a data-toggle="tooltip" data-placement="bottom" data-action="edit" title="Düzenle" href="#"><i class="fas fa-edit"></i></a>
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

    if (!empty($kredi_list))
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