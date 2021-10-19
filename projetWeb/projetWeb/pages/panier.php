<?php
require('navbar.php');
require('connexion.php');
?>
<div class="container mt-5">
    <div class="row">
        <aside class="col-lg-9">
            <div class="card">

                <div class="table-responsive">

                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th></th>
                                <th scope="col">Produit</th>
                                <th scope="col" width="120">Quantité</th>
                                <th scope="col" width="120">Prix unitaire</th>
                                <th scope="col" width="120">Prix total</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200"> </th>
                            </tr>
                        </thead>
                        <tbody id="pannierTable">


                        </tbody>
                    </table>

                </div> <!-- table-responsive.// -->

                <div class="card-body border-top">
                    <div class=" d-flex justify-content-end">
                        <button id="clear2" class=" btn btn-danger ">Vider</button>
                    </div>
                </div> <!-- card-body.// -->

            </div> <!-- card.// -->

        </aside> <!-- col.// -->
        <aside class="col-lg-3">
            <div class="card">
                <div class="card-body">

                    <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd  class="text-right text-dark b">
                            <strong id="prix"></strong>
                        </dd>
                    </dl>
                    <hr>
                    <p class="text-center mb-3">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZa9stluxuArfKQHtToXyOJoDSyNgmHsLOrA&usqp=CAU" height="35">
                    </p>
                    <a href="paiement.php" class="btn btn-primary btn-block"> passer au paiement </a>
                    <a href="produits.php" class="btn btn-light btn-block">Continuer l'achat</a>
                </div> <!-- card-body.// -->
            </div> <!-- card.// -->

        </aside> <!-- col.// -->
    </div> <!-- row.// -->
</div>
<script src="function.js">

    
    </script>
<script>
    
    document.querySelector('#clear2').addEventListener('click', function (e) {
    document.getElementById('prix').innerHTML = parseInt(cart.total) +"DH";
 
 cart.clearItems();
 document.getElementById('pannierTable').innerHTML = '';

});


</script>
<script>
    var panier = JSON.parse(localStorage.getItem('cart'));
    var content = document.getElementById('pannierTable');

    var som = 0;
    var i = 0;

    if (panier != null) {
        content.innerHTML = panier.map(product => {
            som += product.total;

            return "\
            <tr>\
            <td>\
            <div class='aside'><img style=' width: 50px; ; height:50px;' src='../images/produits/" + product.img + "' class='img-sm'></div>\
            </td>\
                                <td>\
                                    <figure class='itemside align-items-center'>\
                                        <figcaption class='info'>\
                                            <a href='#' class='title text-dark'>" + product.name + "</a>\
                                        </figcaption>\
                                    </figure>\
                                </td>\
                                <td>\
                                " + product.count + "x</td>\
                                <td>\
                                    <div \class='price-wrap'>\
                                        <small class='text-muted'>" + product.price + "</small>\
                                    </div> <!-- price-wrap .// -->\
                                </td>\
                                <td>\
                                    <div \class='price-wrap'>\
                                        <v\ar class='price'>" + product.total + " DH</var>\
                                    </div> <!-- price-wrap .// -->\
                                </td>\
                            </tr>";
        }).join('');
    } else {
        document.write("le pannier est vide");
 
    }


    var total = document.getElementById('prix');
    total.innerHTML = som + " dh";
    

</script>

