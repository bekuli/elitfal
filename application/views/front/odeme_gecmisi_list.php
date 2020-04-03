<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-summary">
                İşlem
            </div>
            <div class="urltable-th ut-clicks">
                Miktar
            </div>
            <div class="urltable-th ut-clicks">
                Sonuç
            </div>
            <div class="urltable-th ut-clicks">
               Tarih
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="url-table">

        <?php

        if (!empty($odeme_list))
        {
            foreach ($odeme_list as $row)
            {
               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="urlbox-row">
                            <div class="urlbox-td urlbox-head">
                                <span class="hidden-text">İşlem: </span>
                                <?php
                                    if ($row["islem"] == "user-buy")
                                        echo "Fal satın alım";
                                    elseif ($row["islem"] == "user-deposit")
                                        echo "Kredi satın alım";
                                    elseif ($row["islem"] == "admin-deposit")
                                        echo "Admin para yatırması";
                                    elseif ($row["islem"] == "admin-withdraw")
                                        echo "Admin para çekmesi";
                                ?>

                            </div>
                            <div class="urlbox-td urlbox-clicks">
                                <span class="hidden-text">Miktar: </span>
                                <?php
                                    if ($row["islem"] == "user-buy")
                                        echo "<div class='withdraw'>-";
                                    elseif ($row["islem"] == "user-deposit")
                                        echo "<div class='deposit'>+";
                                    elseif ($row["islem"] == "admin-deposit")
                                        echo "<div class='deposit'>+";
                                    elseif ($row["islem"] == "admin-withdraw")
                                        echo "<div class='withdraw'>-";

                                    echo $row["miktar"]."</div>";
                                ?>
                            </div>
                            <div class="urlbox-td urlbox-clicks">
                                <?php
                                    if ($row["odeme_sonucu"] == 1)
                                        echo "Başarılı";
                                    else
                                        echo "Başarısız";
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

    if (!empty($odeme_list))
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