<?php
session_start();
if (!isset($_SESSION['client']))
	header('location:index.html');
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<style>
	.circle-icon {
		width: 50px;
		height: 50px;
		clip-path: ellipse(30% 50%);
	}
</style>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<header class="section-header">
	<section class="header-top-light border-bottom">
		<div class="container">
			<nav class="d-flex flex-column flex-md-row">
				<?php if($_SESSION['client']['type'] == 'A') { ?>
				<ul class="nav">
				<li class="nav-item"><a href="produits.php" class="nav-link"> accueil </a></li>
					<li class="nav-item"><a href="remplire_produits.php" class="nav-link"> remplire </a></li>
					<li class="nav-item"><a href="demandes.php" class="nav-link"> demandes </a></li>
					<li class="nav-item"><a href="ventes.php" class="nav-link"> ventes </a></li>
				
				</ul>
				<?php } ?>
			</nav>
		</div>
	</section>

	<section class="header-main shadow-lg border-bottom">
		<div class="container">
			<div class="row py-3 align-items-center">
				<div class="col-lg-3 col-sm-4 col-12">
					<div class="brand-wrap">
						<img class="logo" src="../images/logo2.png" height="90">
					</div>
				</div>

				<div class="col-lg-4 col-xl-5 col-sm-8 col-9">
					<form method="GET" class="search" action="produits.php">

						<div class="input-group w-100">

							<input type="text" class="form-control" style="width:55%;" name="search" placeholder="Search">

							<select name="id_categorie" id="id_categorie" class="custom-select">
								<option value="0">Tout</option>
								<?php
								require_once "connexion.php";
								$sql = "SELECT * from categories";
								$requet = $conn->query($sql);
								$articles = $requet->fetchAll();
								foreach ($articles as $article) {
								?>
									<option value="<?php echo $article["id_categorie"] ?>"> <?php echo $article["nom_categorie"] ?> </option>
								<?php } ?>
							</select>
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">
									<i class="bi bi-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-5 col-xl-4 col-sm-12">
					<div class="row ">

						<div class=" ml-5 widgets-wrap mx-2 float-md-right">
							<div class="icon">
								<div><?php echo $_SESSION['client']['nom']." ".$_SESSION['client']['prenom']; ?>
									<img width="30px" height="30px" class="rounded-circle" src="../images/clients/<?php print $_SESSION['client']['photo']; ?>">
								</div>
							</div>
						</div>

						<?php
						if (!empty($_SESSION)) { ?>
							<div class="widgets-wrap mx-2 float-md-right">
								<a href="destroy_client.php"><i class="bi bi-box-arrow-in-right"></i></a>
							</div>
						<?php } ?>




						<div class="widget-header " data-toggle="dropdown" data-offset="20,10">
							<div class="widgets-wrap mx-2 float-md-right">
								<a href="#">
									<div class="icon">
										<i class="bi bi-cart"></i>
									</div>
								</a>
							</div>

							<div class="dropdown-menu shadow-lg dropdown-menu-right">
								<div class="container cart">
									<h1>Panier</h1>
									<div class="row mb-5 center ">
										<div class="col-6">
											<button class="clear btn btn-danger" id="clear">Abondonner</button>
										</div>
										<div class="col-6">
											<a href="panier.php" class="clear btn btn-success" onclick="myFunction()">Détails</a>
										</div>
									</div>
									<div id="cartItems">Panier Vide</div>
									prix total : <strong id="totalPrice">0 DH</strong>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</header>



<script>
	function myFunction() {
		location.replace("panier.php")
	}
</script>