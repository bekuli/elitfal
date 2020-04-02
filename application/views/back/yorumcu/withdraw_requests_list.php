<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-tarih">
                Tarih
            </div>
            <div class="urltable-th ut-miktar">
                Miktar
            </div>
            <div class="urltable-th ut-sonuc">
                Sonuç
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
                            <div class="urlbox-td urlbox-tarih">

                                <?php
                                    if (!empty($row["tarih"]))
                                        echo date("d/m/Y H:i:s", strtotime($row["tarih"]));
                                    else
                                        echo "-";
                                ?>
                            </div>
                            <div class="urlbox-td urlbox-miktar">
                                <span class="hidden-text">Miktar: </span>
                                <?=$row["miktar"]?>

                            </div>
                            <div class="urlbox-td urlbox-sonuc">
                                <span class="hidden-text">Sonuç: </span>
                                <?php

                                if (empty($row["sonuc"]))
                                    echo "Cevap bekleniyor";
                                else
                                    echo $row["sonuc"];

                                ?>

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