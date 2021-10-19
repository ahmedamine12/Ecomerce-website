<?php
require('navbar.php');
require('connexion.php');
$reqMarque = "SELECT * FROM marques";
$reqCatego = "SELECT * FROM categories";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<header>
	<title>Ajout des produits</title>
</header>

<style>
	#galeria {
		display: flex;
	}

	#galeria img {
		width: 85px;
		height: 85px;
		border-radius: 10px;
		box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
		opacity: 85%;
	}
</style>

<div class="container panel panel-primary margetop ">
	<div class="mt-5 panel-heading">
		<h3>Inserer un produit: </h3>
		<div class="panel-body bg-light p-3 border">
			<form method="post" action="insertProduit.php" class="form" enctype="multipart/form-data">
					<label for="nom">Ajoutez des images pour votre produit  : </label>
				<div class=" col-6 input-group mb-3">
					<div class=" custom-file">
						<label class="custom-file-label" for="files[]">Parcourir votre répértoire des images</label>
						<input type="file" class="custom-file-input" name="files[]" multiple onChange="previewMultiple(event)" id="adicionafoto">
					</div>
				</div>
				<div class="mt-5" id="galeria"></div>

				<div class="row mt-5">
					<div class="form-group col-4">
						<label for="nom">Nom produit : </label>
						<input type="text" name="nom" placeholder="Nom du produit" class="form-control col-6" />
					</div>

					<div class="col-4">
						<div class="form-group ">
							<label for="marque">marque : </label>
							<select name="marque" class="form-control col-6" id="marque" onchange="showUser(this.value)">
								<option> choisir marque ...</option>
								<?php foreach ($conn->query($reqMarque) as $marque) { ?>
									<option value="<?php echo  $marque['id_marque'] ?>"> <?php echo $marque['nom_marque'] ?> </option>
								<?php	} ?>
							</select>
						</div>
					</div>

					<div class="form-group col-4">
						<div id="txtHint">
							<label for="modele">modéle : </label>
							<select name="modele" class="form-control col-5">

							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-4">
						<label for="description">Description du produit :</label>
						<textarea id="description" name="description" rows="5" class="form-control" required></textarea>
					</div>
					<div class="form-group col-4">
						<label for="categorie">catégorie : </label>
						<select name="categorie" class="form-control col-6" id="categorie">
							<option> choisir categorie ...</option>
							<?php foreach ($conn->query($reqCatego) as $catego) { ?>
									<option value="<?php echo  $catego['id_categorie'] ?>"> <?php echo $catego['nom_categorie'] ?> </option>
								<?php	} ?>
						</select>
					</div>

				</div>

				<div class="form-group col-3">
					<label for="prix">prix : </label>
					<div class="input-group  col-8">
						<input type="text" name="prix" id="prix" class="form-control" placeholder="0,00" aria-label="Amount (valeur en dirham)">
						<div class="input-group-append">
							<span class="input-group-text">DH</span>
						</div>
					</div>
				</div>
				<div class=" form-group col-12 mt-5">
					<button type="submit" name="submit" value="Upload" class="btn btn-success float-right"> Enregistrer</button>
				</div>

			</form>
		</div>
	</div>

	<script>
		function showUser(str) {
			if (str == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "generer_modele.php?q=" + str, true);
				xmlhttp.send();
			}
		}


		function previewMultiple(event) {
			if ($("#adicionafoto")[0].files.length > 6) {
				alert("Vous pouvez au maximum choisir que 6 images !");
				$("#adicionafoto")[0].preventDefault();
			}
			var saida = document.getElementById("adicionafoto");
			var quantos = saida.files.length;
			for (i = 0; i < quantos; i++) {
			
				console.log(event.target.files[i]);
				var urls = URL.createObjectURL(event.target.files[i]);
				console.log(urls);
				document.getElementById("galeria").innerHTML += '<img class="mx-2" src="' + urls + '">';
			}
		}
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

	<?php require('footer.php'); ?>