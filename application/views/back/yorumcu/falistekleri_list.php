<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                Fal Türü
            </div>
            <div class="urltable-th ut-clicks">
                Ad Soyad
            </div>
            <div class="urltable-th ut-credits">
                Kredi
            </div>
            <div class="urltable-th ut-password">
                Tarih
            </div>
            <div class="urltable-th ut-expires-at">
               Durum 
            </div>
            <div class="urltable-th ut-actions">
                
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($fal_list))
        {
            foreach ($fal_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">
                                <?=$this->fal->fal_turu_name_to_org($row["fal_turu"])?>

                            </div>
                            <div class="urlbox-td urlbox-clicks">
                                <?php 

                                    $query = $this->db->get_where("users", array("id" => $row["user_id"]));
                                    if ($query !== false && $query->num_rows() > 0)
                                    {
                                        echo $query->row()->name." ".$query->row()->surname;
                                    }

                                ?>

                            </div>
                            <div class="urlbox-td urlbox-credits">
                                <?=$row["odeme"]?>
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
                                <span class="hidden-text">Durum: </span>
                                <div>
                                <?php 
                                    if ($row["status"] == 1)
                                        echo '<span class="badge badge-success">Cevaplandı</span>';
                                    else
                                        echo '<span class="badge badge-danger">Cevaplanmadı</span>';
                                    ?>
                                </div>
                            </div>

                            <div class="urlbox-td urlbox-actions" data-id="<?=$row["id"]?>">

                                <a data-toggle="tooltip" data-placement="bottom" data-action="view" title="Görüntüle" href="<?=base_url()?>yorumcu/falistekleri/<?=$row["id"]?>"><i class="fas fa-eye"></i></a>
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

    if (!empty($fal_list))
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