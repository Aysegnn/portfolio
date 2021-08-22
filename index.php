<?php include 'include/header.php'; ?>

<?php
$anasayfa = $conn->prepare("SELECT *FROM anasayfa WHERE id=:idd");
$anasayfa->execute(["idd"=>1]);
$row=$anasayfa->fetch(PDO::FETCH_OBJ);

?>
				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt"><?= $row->yazi1;?></h2>
								<p><?= $row->yazi2;?></p>
							</header>

							<footer>
								<a href="#portfolio" class="button scrolly">Çalışmalarım</a>
							</footer>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>Çalışmalar</h2>
							</header>

							<p></p>

							
<?php
  $calismalar=$conn->query("SELECT * FROM calismalar")->fetchAll(PDO::FETCH_OBJ);
?>

							<div class="row">
								<?php
                                   foreach($calismalar as $row){
								?>
								<div class="4u 12u$(mobile)">
									<article class="item">
										<a href="detay.php?id=<?= $row->id ?>" class="image fit"><img src="C:/xampp/htdocs/portfolio/admin/assets/uploads/<?= $row->resim?>" alt=""  height="200"/></a>
										<header>
											<h3><?= $row->baslik?></h3>
										</header>
									</article>
									
								</div>
							
								<?php
								   }
								?>
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							<a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>

							<p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus
							ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae
							laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem
							parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper
							dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec
							ornare iaculis.</p>

						</div>
					</section>

				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<p>Elementum sem parturient nulla quam placerat viverra
							mauris non cum elit tempus ullamcorper dolor. Libero rutrum ut lacinia
							donec curae mus. Eleifend id porttitor ac ultricies lobortis sem nunc
							orci ridiculus faucibus a consectetur. Porttitor curae mauris urna mi dolor.</p>

							<form method="post" action="#">
								<div class="row">
									<div class="6u 12u$(mobile)"><input type="text" name="name" placeholder="Name" /></div>
									<div class="6u$ 12u$(mobile)"><input type="text" name="email" placeholder="Email" /></div>
									<div class="12u$">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
									<div class="12u$">
										<input type="submit" value="Send Message" />
									</div>
								</div>
							</form>

						</div>
					</section>

		<?php include 'include/footer.php'; ?>
