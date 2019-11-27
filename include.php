<?php

include('config.php');
include('functies.php');

$categorieen = categorieLijst();

session_start();



?>

<!--TODO: onderstaande in layout.php-->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

    <div class="topnav" id="myTopnav">
        <a href="index.php" class="active">Home</a>
        <a href="#contact">Contact</a>
        <a href="#login" class="topnavright">Login</a>
        <a href="cart.php" class="topnavright"><i class="fa fa-shopping-cart"></i></a>
        <a href="verlanglijst.php" class="topnavright"><i class="fa fa-gift"></i></a>

        <form method="get" class="zoek">
            <div class="">
                <input type="text" class="zoeken" name="zoek" placeholder="Zoeken" />
                <button type="submit" name="submit" class="zoekbtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="mobielzoek">
    <form method="get" class="mobielzoek">
        <input type="text" class="zoeken" name="zoek" placeholder="Zoeken" />
        <button type="submit" name="submit" class="zoekbtn">
            <i class="fa fa-search"></i>
        </button>
    </form>
    </div>

    <?php


//TODO: naar functie(s)
    if(isset($_GET['submit'])) {
        $zoek = $_GET["zoek"];
        $producten = zoekProduct($zoek);
    }
    elseif(isset($_GET['categorieen'])){
        foreach($_GET['categorieen'] as $cat){
            $_SESSION['paginaNummer'] = 1;
            $_SESSION['categorie'] = $cat;
        }
    }

    if((isset($_SESSION['categorie']) AND $_SESSION['categorie'] == "overzicht")){
        $producten = productenLijst();

    }
    elseif(!isset($_SESSION['categorie'])){
        $_SESSION['categorie'] = 'overzicht';
    $producten = $producten = productenLijst();
        }
    if(isset($_SESSION['categorie'])AND $_SESSION['categorie'] != "overzicht"){
    $producten = categorieClothing($_SESSION['categorie']);
    }



    ?>



    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>
</html>

