<?php


require('connexion.php');
require('navbar.php');


?>
<script src=""></script>
<style>
    .rounded {
        border-radius: 1rem
    }

    .nav-pills .nav-link {
        color: #555
    }

    .nav-pills .nav-link.active {
        color: white
    }

    input[type="radio"] {
        margin-right: 5px
    }

    .bold {
        font-weight: bold
    }
</style>

<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Chosissez le type de paiement</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    <div class=" shadow-sm pt-2 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav nav-pills rounded nav-fill">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> carte bancaire</a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> chèque </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> espèce </a> </li>
                        </ul>
                    </div> <!-- End -->

                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <!-- <form role="form" method="POST" action="payer.php"> -->
                            <div class="form-group"> <label for="username">
                                    <h6>Nom propriétaire</h6>
                                </label> <input type="text" name="username" id="username" placeholder="Card Owner Name" required class="form-control "> </div>
                            <div class="form-group"> <label for="cardNumber">
                                    <h6>Numero carte</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="cardNumber" id="cardNumber" placeholder="numero de carte valide" class="form-control " required>
                                    <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group"> <label><span class="hidden-xs">
                                                <h6>date d'expiration</h6>
                                            </span></label>
                                        <div class="input-group"> <input type="number" placeholder="Mois" name="mois" id="mois" class="form-control" required> <input type="number" placeholder="Année" id="annee" name="annee" class="form-control" required> </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label> <input type="text" name="cvv" id="cvv" required class="form-control"> </div>
                                </div>
                            </div>
                            <div class="card-footer"> <button onclick="valider('c')" class="subscribe btn btn-primary btn-block shadow-sm"> Confirmer </button>
                                <!-- </form> -->
                            </div>
                        </div> <!-- End -->

                        <!-- Chèque info -->
                        <div id="paypal" class="tab-pane fade pt-3">
                            <h6 class="pb-2">Informations sur chèque</h6>
                            <div class="form-group ">
                                <label for="date_encaiss">
                                    <h6>date d'encaissement :</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="date_encaiss" id="date_encaiss" placeholder="date d'encaissement du chèque" class="form-control " required>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="date_encaiss">
                                    <h6>montant :</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="montant" id="montant" placeholder="montant du chèque" class="form-control " required>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="banque">
                                    <h6>banque : </h6>
                                </label>
                                <select name="banque" class="form-control " id="banque">
                                    <option> choisir banque ...</option>
                                    <?php
                                    $reqBq = "SELECT * FROM banques";
                                    foreach ($conn->query($reqBq) as $banque) { ?>
                                        <option value="<?php echo  $banque['id_banque'] ?>"> <?php echo $banque['nom_banque'] ?> </option>
                                    <?php    } ?>
                                </select>
                            </div>
                            <p>
                                <button type="button" onclick="valider('q')" class="mt-5 btn btn-primary "> confirmer</button>
                            </p>
                        </div> <!-- End -->

                        <!-- espece -->
                        <div id="net-banking" class="tab-pane fade pt-3">
                            <div class="form-group "> <label for="Select Your Bank">
                                    <h6>Payer en espèce</h6>
                                </label>
                                <div class="input-group"> <input type="text" name="espece" id="espece" placeholder="montant espèce" class="form-control mt-5 " required>
                                </div>
                                <div class="form-group">
                                    <p> <button type="button" onclick="valider('e')" class="mt-5 btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i> Confirmer </button> </p>
                                </div>
                            </div> <!-- End -->

                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="card ">
                        <div class="card-header">
                            <div class=" shadow-sm pt-2 pl-2 pr-2 pb-2">
                                type de livraison
                            </div>
                            <div class="form-group ">
                                <select name="livraison" id="livraison" class="form-control " id="livraison">
                                    <option value="1"> choisir type de livraison ...</option>
                                    <option value="2"> à domicile </option>
                                    <option value="3"> point de livraison </option>
                                    <option value="4"> passer au magazin </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>


            <script type="text/javascript">
                function valider(typepaiment) {
                    var ancienpannier = JSON.parse(localStorage.getItem('cart'));
                    var prods = [];

                    for (var index = 0; index < ancienpannier.length; index++) {
                        var prod = {};
                        for (var key in ancienpannier[index]) {
                            prod[key] = ancienpannier[index][key];
                        }
                        prods.push(prod);
                    }
                    console.log(prods);

                    var infos = [];
                    switch (typepaiment) {
                        case 'c':
                            infos.push(document.getElementById('username').value);
                            infos.push(document.getElementById('cardNumber').value);
                            break;
                        case 'q':
                            infos.push(document.getElementById('date_encaiss').value);
                            infos.push(document.getElementById('montant').value);
                            infos.push(document.getElementById('banque').value);
                            break;
                        case 'e':
                            infos.push(document.getElementById('espece').value);
                            break;
                        default:
                            break;
                    }

                    var typeLivraison = document.getElementById('livraison').value

                    $.ajax({
                        url: "payer.php",
                        method: "post",
                        data: {
                            prods: JSON.stringify(prods),
                            type: typepaiment,
                            infos: infos,
                            livraison: typeLivraison
                        },
                        success: function(res) {
                            document.open();
                            document.write(res);
                            document.close();
                        }
                    })
                     localStorage.clear();
                }
            </script>




            <script>
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>