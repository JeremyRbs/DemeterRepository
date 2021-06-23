<!doctype html>
<html lang="fr">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="../CSS/Style.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<title>Gérant</title>

</head>

<body>
    
        <!-- Navbar-->
        <header class="header">
            <nav class="navbar navbar-expand-lg fixed-top py-3">
                <div class="container"><a href="../../Public/html/accueil.php" class="navbar-brand text-uppercase font-weight-bold">DEMETER</a>
                    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active"><a href="../../Public/html/accueil.php" class="nav-link text-uppercase font-weight-bold">Accueil<span class="sr-only"></span></a></li>
                            <li class="nav-item"><a href="../../Public/html/nosProduits.php" class="nav-link text-uppercase font-weight-bold">Nos produits</a></li>
                            <li class="nav-item"><a href="../../Public/html/pageCuisine.php" class="nav-link text-uppercase font-weight-bold">Cuisine</a></li>
                            <li class="nav-item"><a href="../../Public/html/pageGerant.php" class="nav-link text-uppercase font-weight-bold">Gérant</a></li>
                            <li class="nav-item"><a href="../../Public/html/pageLivraison.php" class="nav-link text-uppercase font-weight-bold">Livreur</a></li>
                        </ul>
                    </div>
                </div>
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a href="../../Public/html/panier.php" class="nav-link text-uppercase font-weight-bold">Panier</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <script>
            $(function () {
                $(window).on('scroll', function () {
                    if ( $(window).scrollTop() > 10 ) {
                        $('.navbar').addClass('active');
                    } else {
                        $('.navbar').removeClass('active');
                    }
                });
            });
        </script>
        
        <main>
            <ul class="tabs">
                <li class="active"><a class="onglet" href="#home">Accueil</a></li>
                <li><a class="onglet" href="#stocks">Gestion des stocks</a></li>
                <li><a class="onglet" href="#recettes">Recettes</a></li>
                <li><a class="onglet" href="#ingredients">Ingrédients</a></li>
                <li><a class="onglet" href="#fournisseur">Fournisseur</a></li>
            </ul>
            <div class="tabs-content">
                <div class="tab-content active" id="home">Cette page est dédiée au gérant.</div>
                <div class="tab-content" id="stocks">
                    
                    <?php require_once ('../../controller/connexion.php'); ?>
                    
                    <br>
                        
                    <div class="row">
                        <div class="col-md-8">
                            <table id="stock" class="table">
                                    <colgroup span="6"></colgroup>
                                    <tr class="table-header">
                                            <th>Ingrédient</th>
                                            <th>Quantité</th>
                                            <th>Unité</th>
                                            <th>Prix HT</th>
                                            <th>Frais</th>
                                    </tr>

                                    <?php
                                        // On récupère tout le contenu de la table PRODUIT sans fournisseur
                                        $sql = $pdo->query('SELECT IdIngred, NomIngred, StockReel, Unite, PrixUHT_Moyen, Frais, DateArchiv FROM INGREDIENT');
                                        while($row = $sql->fetch()) {
                                            
                                            echo "<tr id=".$row["IdIngred"]." class='table-row'><td>"
                                                ."<p>".$row['NomIngred']."</p></td><td>"
                                                ."<p>".$row['StockReel']."</p></td><td>"
                                                ."<p>".$row['Unite']."</p></td><td>"
                                                ."<p>".$row['PrixUHT_Moyen']."</p></td><td>"
                                                ."<p>".$row['Frais']."</p></td></tr>";
                                            
                                            $quantite = $row['StockReel'];
                                            
                                            if($quantite == 0){
                                                $sql_2 = $pdo->query("UPDATE `ingredient` SET `StockReel` = '5' WHERE `ingredient`.`IdIngred` = ".$row["IdIngred"]."");
                                            }
                                        }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="tab-content" id="recettes">
                    
                    <?php require_once ('../../controller/connexion.php'); ?>
                    
                    <br>
                        
                    <div class="row">
                        <div class="col-md-8">
                                <table id="table-recettes" class="table">
                                        <colgroup span="7"></colgroup>
                                        <tr class="table-header">
                                                <th>Photo</th>
                                                <th>Nom</th>
                                                <th>Produits et quantités</th>
                                                <th>Supplément(s)</th>
                                                <th>Taille</th>
                                                <th>Prix HT</th>
                                                <th>Action(s)</th>
                                        </tr>
                                        <?php
                                            // On récupère tout le contenu de la table PRODUIT
                                            $sql = $pdo->query('SELECT * FROM PRODUIT');
                                            while($row = $sql->fetch()) {
                                                echo "<tr id=".$row["IdProd"]." class='table-row'><td>"
                                                    ."<input id='image_rec' class='input' value='".$row['Image']."'></td><td>"
                                                    ."<input id='nom_rec' class='input' value='".$row['NomProd']."'></td><td>"
                                                    ."<input id='ingBase_1_rec' class='input' value='".$row['IngBase1']."'><br>"
                                                    ."<input id='ingBase_2_rec' class='input' value='".$row['IngBase2']."'><br>"
                                                    ."<input id='ingBase_3_rec' class='input' value='".$row['IngBase3']."'><br>"
                                                    ."<input id='ingBase_4_rec' class='input' value='".$row['IngBase4']."'><br>"
                                                    ."<input id='ingBase_5_rec' class='input' value='".$row['IngBase5']."'><br>"
                                                    ."<input id='ingBase_6_rec' class='input' value='".$row['IngBase6']."'><br>"
                                                    ."<input id='ingBase_7_rec' class='input' value='".$row['IngBase7']."'><br>"
                                                    ."<input id='ingBase_8_rec' class='input' value='".$row['IngBase8']."'><br>"
                                                    ."<input id='ingBase_9_rec' class='input' value='".$row['IngBase9']."'><br>"
                                                    ."<input id='ingBase_10_rec' class='input' value='".$row['IngBase10']."'><br>"."</td><td>"
                                                    ."<input id='ingOpt_1_rec' class='input' value='".$row['IngOpt1']."'><br>"
                                                    ."<input id='ingOpt_2_rec' class='input' value='".$row['IngOpt2']."'><br>"
                                                    ."<input id='ingOpt_3_rec' class='input' value='".$row['IngOpt3']."'><br>"
                                                    ."<input id='ingOpt_4_rec' class='input' value='".$row['IngOpt4']."'><br>"
                                                    ."<input id='ingOpt_5_rec' class='input' value='".$row['IngOpt5']."'><br>"
                                                    ."<input id='ingOpt_6_rec' class='input' value='".$row['IngOpt6']."'><br>"."</td><td>"
                                                    ."<select id='taille_rec' name='thelist' value='".$row['Taille']."'>
                                                        <option>S</option>
                                                        <option>M</option>
                                                        <option>L</option>
                                                        <option>XL</option></td><td>"
                                                    ."<input id='prix_rec' class='input' value='".$row['PrixUHT']."'></td><td>"
                                                    .'<input type="submit" class="button btn-modif-recette" value="Modifier">'
                                                    ."<br><br>".'<input type="submit" class="button btn-sup-recette" value="Supprimer">'
                                                    ."</td></tr>";
                                            }
                                        ?>
                                </table>

                            <br><h3>Créer une nouvelle recette :</h3><br>
                            <p>Pour créer sa propre recette, appuyez sur ce bouton :</p><br>
                            <input type="submit" class="button btn-ajout-recette" value="Ajouter"><br>
                            <br><p>Une nouvelle ligne est apparue dans le tableau ! Vous pouvez la modifier grâce au bouton "Modifier" présent dans celle-ci.</p>
                        </div>
                    </div>
                </div>
                
                <script type= text/javascript>
                    
                // On charge la page
                $(function() {

                    $('.btn-ajout-recette').click(function() {
                        
                        $.ajax({ 

                            url: '../../Model/Recette/ajouterRecette.php', 
                            success: function(){
                                alert("Ajouté !");
                            }

                        });
                        
                    });

                    $('.btn-modif-recette').click(function() {
                        let idAvant = $(this).parent().parent().attr('id');
                        let image = $("#image_rec").val();
                        let nom = $("#nom_rec").val();
                        let ingBase_1 = $("#ingBase_1_rec").val();
                        let ingBase_2 = $("#ingBase_2_rec").val();
                        let ingBase_3 = $("#ingBase_3_rec").val();
                        let ingBase_4 = $("#ingBase_4_rec").val();
                        let ingBase_5 = $("#ingBase_5_rec").val();
                        let ingBase_6 = $("#ingBase_6_rec").val();
                        let ingBase_7 = $("#ingBase_7_rec").val();
                        let ingBase_8 = $("#ingBase_8_rec").val();
                        let ingBase_9 = $("#ingBase_9_rec").val();
                        let ingBase_10 = $("#ingBase_10_rec").val();
                        let ingOpt_1 = $("#ingOpt_1_rec").val();
                        let ingOpt_2 = $("#ingOpt_2_rec").val();
                        let ingOpt_3 = $("#ingOpt_3_rec").val();
                        let ingOpt_4 = $("#ingOpt_4_rec").val();
                        let ingOpt_5 = $("#ingOpt_5_rec").val();
                        let ingOpt_6 = $("#ingOpt_6_rec").val();
                        let taille = $("#taille_rec").val();
                        let prix = $("#prix_rec").val();
                        
                        console.log(JSON.stringify({ "IdIngred" : idAvant, "Image" : image, "NomProd" : nom,
                                                    "IngBase1" : ingBase_1, "IngBase2" : ingBase_2, "IngBase3" : ingBase_3,
                                                    "IngBase4" : ingBase_4, "IngBase5" : ingBase_5, "IngBase6" : ingBase_6,
                                                    "IngBase7" : ingBase_7, "IngBase8" : ingBase_8, "IngBase9" : ingBase_9,
                                                    "IngBase10" : ingBase_10, "IngOpt1" : ingOpt_1, "IngOpt2" : ingOpt_2,
                                                    "IngOpt3" : ingOpt_3, "IngOpt4" : ingOpt_4, "IngOpt5" : ingOpt_5,
                                                    "IngOpt6" : ingOpt_6, "Taille" : taille, "PrixUHT" : prix }));
                        
                        $.ajax({ 

                             type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                             url: '../../Model/Recette/modifierRecette.php', 
                             data: JSON.stringify({ "IdProd" : idAvant, "Image" : image, "NomProd" : nom,
                                                    "IngBase1" : ingBase_1, "IngBase2" : ingBase_2, "IngBase3" : ingBase_3,
                                                    "IngBase4" : ingBase_4, "IngBase5" : ingBase_5, "IngBase6" : ingBase_6,
                                                    "IngBase7" : ingBase_7, "IngBase8" : ingBase_8, "IngBase9" : ingBase_9,
                                                    "IngBase10" : ingBase_10, "IngOpt1" : ingOpt_1, "IngOpt2" : ingOpt_2,
                                                    "IngOpt3" : ingOpt_3, "IngOpt4" : ingOpt_4, "IngOpt5" : ingOpt_5,
                                                    "IngOpt6" : ingOpt_6, "Taille" : taille, "PrixUHT" : prix }),
                             success: function(){
                                 alert("Modifié !");
                             }
                         });
                        
                    });

                    $('.btn-sup-recette').click(function() {
                       let id = $(this).parent().parent().attr('id');
                       $.ajax({ 

                        type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                        url: '../../Model/Recette/supprimerRecette.php', 
                        data: JSON.stringify({ "IdProd" : id }),
                        success: function(){
                            alert("Supprimé !");
                        }

                        });
                        
                    })

                });
            
                </script>
                
                <div class="tab-content" id="ingredients">
                    
                    <?php require_once ('../../controller/connexion.php'); ?>
                    
                    <br>

                    <div class="row">
                        <div class="col-md-8">
                                <table id="table-ingredients" class="table">
                                        <colgroup span="7"></colgroup>
                                        <tr class="table-header">
                                                <th>Ingrédient</th>
                                                <th>Quantité</th>
                                                <th>Unité</th>
                                                <th>Prix HT</th>
                                                <th>Fournisseur</th>
                                                <th>Frais</th>
                                                <th>Action(s)</th>
                                        </tr>
                                        <?php
                                    
                                            // On récupère tout le contenu de la table PRODUIT avec fournisseur
                                            //$sql = $pdo->query('SELECT * FROM ingredient JOIN fourn_ingr ON ingredient.IdIngred = fourn_ingr.IdIngred');
                                            while($row = $sql->fetch()) {
                                                echo "<tr id=".$row["IdIngred"]." class='table-row'><td>"
                                                    ."<input id='idVrai_ing' class='input' value='".$row['NomIngred']."'></td><td>"
                                                    ."<input id='stock_ing' class='input' value='".$row['StockReel']."'></td><td>"
                                                    ."<input id='unite_ing' class='input' value='".$row['Unite']."'></td><td>"
                                                    ."<input id='prix_ing' class='input' value='".$row['PrixUHT_Moyen']."'></td><td>"
                                                    ."<input id='four_ing' class='input' value='".$row['NomFourn']."'></td><td>"
                                                    ."<input id='frais_ing' class='input' value='".$row['Frais']."'></td><td>"
                                                    .'<input type="submit" name="mod_ingr" class="button btn-modif-ingredient" value="Modifier">'
                                                    ."<br><br>".'<input type="submit" name="sup_ingr" class="button btn-sup-ingredient" value="Supprimer">'
                                                    ."</td></tr>";
                                            }
                                    
                                            // On récupère tout le contenu de la table PRODUIT sans fournisseur
                                            $sql = $pdo->query('SELECT IdIngred, NomIngred, StockReel, Unite, PrixUHT_Moyen, Frais, DateArchiv FROM INGREDIENT');
                                            while($row = $sql->fetch()) {
                                                echo "<tr id=".$row["IdIngred"]." class='table-row'><td>"
                                                    ."<input id='idVrai_ing' class='input' value='".$row['NomIngred']."'></td><td>"
                                                    ."<input id='stock_ing' class='input' value='".$row['StockReel']."'></td><td>"
                                                    ."<input id='unite_ing' class='input' value='".$row['Unite']."'></td><td>"
                                                    ."<input id='prix_ing' class='input' value='".$row['PrixUHT_Moyen']."'></td><td>"
                                                    ."<input id='nom_ing' class='input' value='".$row['DateArchiv']."'></td><td>"
                                                    ."<input id='frais_ing' class='input' value='".$row['Frais']."'></td><td>"
                                                    .'<input type="submit" class="button btn-modif-ingredient" value="Modifier">'
                                                    ."<br><br>".'<input type="submit" class="button btn-sup-ingredient" value="Supprimer">'
                                                    ."</td></tr>";
                                            }
                                        ?>
                                    
                                </table>

                            <br><h3>Créer un nouvel ingrédient :</h3><br>
                            <p>Pour créer son propre ingrédient, appuyez sur ce bouton :</p><br>
                            <input type="submit" class="button btn-ajout-ingredient" value="Ajouter"><br>
                            <br><p>Une nouvelle ligne est apparue dans le tableau ! Vous pouvez la modifier grâce au bouton "Modifier" présent dans celle-ci.</p>
                        </div>
                    </div>
                </div>
                
                <script type= text/javascript>
                    
                // On charge la page
                $(function() {

                    $('.btn-ajout-ingredient').click(function() {
                        
                        $.ajax({ 

                            url: '../../Model/Ingredient/ajouterIngredient.php', 
                            success: function(){
                                alert("Ajouté !");
                            }

                        });
                       
                    });

                    $('.btn-modif-ingredient').click(function() {
                        
                        let idAvant = $(this).parent().parent().attr('id');
                        let id = $("#idVrai_ing").val();
                        let stock = $("#stock_ing").val();
                        let unite = $("#unite_ing").val();
                        let prix = $("#prix_ing").val();
                        let nom = $("#nom_ing").val();
                        let frais = $("#frais_ing").val();
                        console.log(JSON.stringify({ "IdIngred" : idAvant, "NomIngred" : id, "StockReel" : stock, "Unite" : unite, "PrixUHT_Moyen" : prix, "DateArchiv" : nom, "Frais" : frais }));
                        
                        $.ajax({ 

                             type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                             url: '../../Model/Ingredient/modifierIngredient.php', 
                             data: JSON.stringify({ "IdIngred" : idAvant, "NomIngred" : id, "StockReel" : stock, "Unite" : unite, "PrixUHT_Moyen" : prix, "DateArchiv" : nom, "Frais" : frais }),
                             success: function(){
                                 alert("Modifié !");
                             }
                         });
                        
                    });

                    $('.btn-sup-ingredient').click(function() {
                       let id = $(this).parent().parent().attr('id');
                       $.ajax({ 

                        type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                        url: '../../Model/Ingredient/supprimerIngredient.php', 
                        data: JSON.stringify({ "IdIngred" : id }),
                        success: function(){
                            alert("Supprimé !");
                        }

                        });

                    })

                });
            
                </script>
                
                <div class="tab-content" id="fournisseur">
                    
                    <?php require_once ('../../controller/connexion.php'); ?>
                    
                    <br>

                    <div class="row">
                        <div class="col-md-8">
                                <table id="table-fournisseur" class="table">
                                    <colgroup span="7"></colgroup>
                                    <tr class="table-header">
                                            <th>Nom</th>
                                            <th>Adresse</th>
                                            <th>Code postal</th>
                                            <th>Ville</th>
                                            <th>Téléphone</th>
                                            <th>Par Def</th>
                                            <th>Action(s)</th>
                                    </tr>
                                    <?php
                                        // On récupère tout le contenu de la table PRODUIT
                                        $sql = $pdo->query('SELECT * FROM FOURNISSEUR');
                                        $i = 0;
                                        while($row = $sql->fetch()) {
                                            echo "<tr id='".$row["NomFourn"]."' class='table-row'><td>"
                                                ."<input id='idVrai_four' class='input' value='".$row['NomFourn']."'></td><td>"
                                                ."<input id='adr_four' class='input' value='".$row['Adresse']."'></td><td>"
                                                ."<input id='code_four' class='input' value='".$row['CodePostal']."'></td><td>"
                                                ."<input id='ville_four' class='input' value='".$row['Ville']."'></td><td>"
                                                ."<input id='tel_four' class='input' value='".$row['Tel']."'></td><td>"
                                                ."<input id='def_four' class='input' value='".$row['ParDefaut']."'></td><td>"
                                                .'<input type="submit" class="button btn-modif-four" value="Modifier">'
                                                ."<br><br>".'<input type="submit" class="button btn-sup-four" value="Supprimer">'
                                                ."</td></tr>";
                                            $i++;
                                        }
                                    ?>
                                </table>

                            <br><h3>Créer un nouveau fournisseur :</h3><br>
                            <p>Pour créer son propre fournisseur, appuyez sur ce bouton :</p><br>
                            <input type="submit" class="button btn-ajout-four" value="Ajouter"><br>
                            <br><p>Une nouvelle ligne est apparue dans le tableau ! Vous pouvez la modifier grâce au bouton "Modifier" présent dans celle-ci.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type= text/javascript>
            
            // On charge la page
            $(function() {
               
                $('.btn-ajout-four').click(function() {

                   $.ajax({ 

                        url: '../../Model/Fournisseur/ajouterFournisseur.php', 
                        success: function(){
                            alert("Ajouté !");
                        }

                    });
                    
                });
                
                $('.btn-modif-four').click(function() {
                    
                   let idAvant = $(this).parent().parent().attr('id');
                   let id = $("#idVrai_four").val();
                   let adr = $("#adr_four").val();
                   let code = $("#code_four").val();
                   let ville = $("#ville_four").val();
                   let tel = $("#tel_four").val();
                   let def = $("#def_four").val();
                   
                   $.ajax({ 

                        type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                        url: '../../Model/Fournisseur/modifierFournisseur.php', 
                        data: JSON.stringify({ "IdAvant" : idAvant, "NomFourn" : id, "Adresse" : adr, "CodePostal" : code, "Ville" : ville, "Tel" : tel, "ParDefaut" : def }),
                        success: function(result){
                            console.log(result);
                            alert("Modifié !");
                        }
                    });
                    
                });
                
                $('.btn-sup-four').click(function() {
                    
                   let id = $(this).parent().parent().attr('id');
                   $.ajax({ 

                    type: 'post',   // toujours travailler en post quand on doit envoyer des données au serveur
                    url: '../../Model/Fournisseur/supprimerFournisseur.php', 
                    data: JSON.stringify({ "NomFourn" : id }),
                    success: function(){
                        alert("Supprimé !");
                    }

                    });

                })
                
            });

        </script>
        <script type="text/javascript">
            
            !function(){
                
                for(var afficherOnglet=function(afficherOnglet,animations){
                    
                    if(animations === undefined){
                        animations = true
                    }
                    
                    var li = afficherOnglet.parentNode,
                        div = afficherOnglet.parentNode.parentNode.parentNode,
                        activeTab = div.querySelector(".tab-content.active"),
                        aAfficher = div.querySelector(afficherOnglet.getAttribute("href"));

                    if(li.classList.contains('active')){
                        return false;
                    }

                    if(div.querySelector(".tabs .active").classList.remove("active"),li.classList.add("active"),animations){
                        
                        activeTab.classList.add("fade"),activeTab.classList.remove("in");
                        
                        var transitionend = function(){
                            
                            this.classList.remove("fade");
                            this.classList.remove("active");
                            aAfficher.classList.add("active");
                            aAfficher.classList.add("fade");
                            aAfficher.offsetWidth;
                            aAfficher.classList.add("in");
                            this.removeEventListener("transitionend",transitionend);
                            this.removeEventListener("webkitTransitionEnd",transitionend);
                            this.removeEventListener("oTransitionEnd",transitionend);
                            this.removeEventListener("mozTransitionEnd",transitionend);
                        };
                        
                        activeTab.addEventListener("transitionend",transitionend);
                        activeTab.addEventListener("webkitTransitionEnd",transitionend);
                        activeTab.addEventListener("oTransitionEnd",transitionend);
                        activeTab.addEventListener("mozTransitionEnd",transitionend);
                    
                    }else{
                        
                        aAfficher.classList.add("active");
                        activeTab.classList.remove("active");
                        
                    }
                    
                    
                },
                    
                animations = document.querySelectorAll(".tabs a"),

                li=0; li<animations.length;li++)
                    animations[li].addEventListener("click",function(animations){
                        afficherOnglet(this)
                    });

                var div = function(animations){

                    var li = window.location.hash,
                        div =document.querySelector('a[href="' + li + '"]');

                    if(div !== null && !div.classList.contains('active')){
                        afficherOnglet(div, animations !== undefined)
                    }
                };

            window.addEventListener("hashchange",div),div()

        }();
            
        </script>
        </main>
        
        <!-- Footer -->
        <div class="footer-basic">
            <footer>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="../../Public/html/accueil.php">Accueil</a></li>
                    <li class="list-inline-item"><a href="../../Public/html/nosProduits.php">Nos produits</a></li>
                    <li class="list-inline-item"><a href="../../Public/html/aPropos.php">À propos</a></li>
                    <li class="list-inline-item"><a href="mentionsLegales">Mentions légales</a></li>
                </ul>
                <p class="copyright">Demeter Tacos © 2021</p>
            </footer>
        </div>
    </body>
</html>