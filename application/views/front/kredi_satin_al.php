<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
	<div class="row">	
		<div class="col-lg-12">
			<div class="kredi-listesi">	
				<?php 
					foreach ($krediler as $row)
					{
						?>
						<div class="col-md-3">
							<div class="kredi-kutusu">
						
								<div class="kredi">
									<?=$row["kredi"]?> Kredi
								</div>

								<div class="kredi-aciklama">
									<?=$row["aciklama"]?>
								</div>
						
								<div class="kredi-fiyat">
									<?=$row["fiyat"]?> TL
								</div>

								<a href="">

									<div class="kredi-al-btn">
										Satın Al
									</div>

								</a>

							</div>
						</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>	
</div>

<style>
	body{background: #f1f1f1}
</style>