<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                Miktar
            </div>
            <div class="urltable-th ut-clicks">
                Yorumcu
            </div>
            <div class="urltable-th ut-clicks">
                Sonuç
            </div>
                <div class="urltable-th ut-clicks">
                Tarih
            </div>
            <div class="urltable-th ut-actions">
                
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($withdraw_list))
        {
            foreach ($withdraw_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">
                                <span class="hidden-text">Miktar: </span>
                                <?=$row["miktar"]?> Kredi (<?=$row["miktar_tl"]?> TL)

                            </div>

                            <div class="urlbox-td urlbox-clicks">
                                <span class="hidden-text">Yorumcu: </span>
                                <?php
                                    $query = $this->db->get_where("yorumcu", array("id" => $row["yorumcu_id"]));
                                    if ($query !== false && $query->num_rows() > 0)
                                    {
                                        echo $query->row()->name;
                                    }
                                ?>

                            </div>

                            <div class="urlbox-td urlbox-clicks">
                                <span class="hidden-text">Sonuç: </span>
                                <?php

                                if (empty($row["sonuc"]))
                                    echo "Cevap bekleniyor";
                                else
                                    echo $row["sonuc"];

                                ?>

                            </div>

                            <div class="urlbox-td urlbox-clicks">

                                <?php
                                    if (!empty($row["tarih"]))
                                        echo date("d/m/Y H:i:s", strtotime($row["tarih"]));
                                    else
                                        echo "-";
                                ?>
                            </div>

                            <div class="urlbox-td urlbox-actions" data-r-id="<?=$row["id"]?>" data-id="<?=$row["yorumcu_id"]?>">
                                <a data-toggle="tooltip" data-placement="bottom" data-action="answer" title="Cevap Ver" href="#"><i class="fas fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="bottom" data-action="view" title="Profili Görüntüle" href="#"><i class="fas fa-eye"></i></a>
                                
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

    if (!empty($withdraw_list))
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
    $('.urlbox-row [data-toggle="tooltip"]').tooltip();
</script>