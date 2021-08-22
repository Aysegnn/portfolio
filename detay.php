<?php include 'include/header.php'; ?>

<?php

if($_GET["id"]){
    $detay=$conn->prepare("SELECT * FROM calismalar WHERE id=:gelenid ");
    $detay->execute(["gelenid"=>$_GET["id"]]);
    $row=$detay->fetch(PDO::FETCH_OBJ);

}
  
?>

					<section id="about" class="three">
						<div class="container">

							<header>
								<h2><?= $row->baslik?></h2>
							</header>

							<a href="#" class="image featured"><img src="C:/xampp/htdocs/portfolio/admin/assets/uploads/<?= $row->resim ?>" alt="" /></a>
 
                            <p>
                               
                            <?php
                                if(!empty($row->aciklama)){
                                    echo $row->aciklama;
                                }
                              ?>
  

                            </p>
							
						</div>
					</section>

				
		<?php include 'include/footer.php'; ?>
