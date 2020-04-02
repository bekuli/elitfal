<div class="row">
    <div class="col-md-12">
        <div class="urltable-head">

            <div class="urltable-th ut-islem">
                İşlem
            </div>
            <div class="urltable-th ut-ad">
                Ad Soyad
            </div>
            <div class="urltable-th ut-miktar">
                Miktar
            </div>
            <div class="urltable-th ut-tarih">
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
                                        echo "Satın alım";
                                    elseif ($row["islem"] == "yorumcu-withdraw")
                                        echo "Para çekme";
                                    elseif ($row["islem"] == "admin-deposit")
                                        echo "Admin para yatırması";
                                    elseif ($row["islem"] == "admin-withdraw")
                                        echo "Admin para çekmesi";
                                ?>

                            </div>
                            <div class="urlbox-td urlbox-clicks">
                                <span class="hidden-text">Ad Soyad: </span>
                                <?php 

                                    if ($row["islem"] == "user-buy"){
                                        $query = $this->db->get_where("users", array("id" => $row["user_id"]));
                                        if ($query !== false && $query->num_rows() > 0)
                                        {
                                            echo $query->row()->name." ".$query->row()->surname;
                                        }
                                    }elseif ($row["islem"] == "admin-deposit" || $row["islem"] == "admin-withdraw"){
                                        echo "Admin";
                                    }else
                                        echo "-";

                                ?>

                            </div>
                            <div class="urlbox-td urlbox-clicks">
                                <span class="hidden-text">Miktar: </span>
                                <?php
                                    if ($row["islem"] == "user-buy")
                                        echo "<div class='deposit'>+";
                                    elseif ($row["islem"] == "yorumcu-withdraw")
                                        echo "<div class='withdraw'>-";
                                    elseif ($row["islem"] == "admin-deposit")
                                        echo "<div class='deposit'>+";
                                    elseif ($row["islem"] == "admin-withdraw")
                                        echo "<div class='withdraw'>-";

                                    echo $row["miktar"]."</div>";
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