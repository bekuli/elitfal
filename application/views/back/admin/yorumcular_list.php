<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                İsim
            </div>
            <div class="urltable-th ut-clicks">
                Eposta
            </div>
            <div class="urltable-th ut-expires-at">
                Kayıt Tarihi
            </div>
            <div class="urltable-th ut-status">
                Hesap Durumu
            </div>
            <div class="urltable-th ut-actions">
                
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($yorumcular_list))
        {
            foreach ($yorumcular_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">
                                <div class="urlbox-url">
                                <?php 
                                $name = $row["name"];
                                if (strlen($name) > 40)
                                    echo substr($name,0,40)."...";
                                else
                                    echo $name;
                                ?>
                                </div>

                            </div>
                            <div class="urlbox-td urlbox-email">
                                <?=$row["email"]?>
                            </div>
                            <div class="urlbox-td urlbox-expires-at">

                                <?php
                                    if (!empty($row["tarih"]))
                                        echo date("m/d/Y", strtotime($row["tarih"]));
                                    else
                                        echo "-";

                                ?>
                            </div>
                            <div class="urlbox-td urlbox-status">
                                <span class="hidden-text">Status: </span>
                                <div>
                                <?php 
                                    if ($row["status"] == 1)
                                        echo "Aktif";
                                    else
                                        echo "Deaktif";
                                    ?>
                                </div>
                            </div>

                            <div class="urlbox-td urlbox-actions" data-id="<?=$row["id"]?>">

                                <a data-toggle="tooltip" data-placement="bottom" data-action="view_yorumcu" title="Hesabı Görüntüle" href="#"><i class="fas fa-eye"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" data-action="edit" title="Hesabı Düzenle" href="#"><i class="fas fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" data-status="<?=$row["status"]?>" data-action="status" title="Hesabı 
                                <?php 
                                    if ($row["status"] == 1)
                                        echo "Deaktifleştir";
                                    else
                                        echo "Aktifleştir";
                                ?>" href="#"><i class="fas fa-power-off"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" data-action="delete" title="Hesabı Kaldır" href="#"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

        <?php 

            }

            ?>

            

            <?php
        }else{
            echo '<center style="margin-top:20px">Gösterilecek veri bulunmamaktadır...</center>';
        }

        ?>

    </div>

    

</div>

<?php

    if (!empty($yorumcular_list))
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

<style type="text/css">
    .urlbox-email,.urltable-head .ut-clicks{max-width: 400px !important}
</style>