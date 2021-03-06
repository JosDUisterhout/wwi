<?php



include('config.php');
include('functies.php');



$categorieen = categorieLijst();
$aantal_winkelmand = 0;
session_start();
if(isset($_POST['cart'])) {
    toevoegenProductWinkelmand($_POST['productID'], $_POST['productAantal'], TRUE);
}else{
    toevoegenProductWinkelmand(0,1, FALSE);
}

if(isset($_POST['remove_cart'])){
    verwijdenProductWinkelwagen($_POST['productID']);
}

if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $key => $aantal){
        $aantal_winkelmand = $aantal_winkelmand + $aantal;
    }
//    $aantal_winkelmand = count($_SESSION["cart"]);
}

$verlanglijstAantal = isset($_SESSION["verlanglijst"]) ? count($_SESSION["verlanglijst"]) : 0;
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
        <a href="index.php" class="active topnav-winkelwagen"><span class="fa-stack fa-2x topnav-icon">
                <i class="fa fa-home fa-stack-2x"></i>
            </span></a>
        <a href="contact.php" class=" topnav-winkelwagen"><span class="fa-stack fa-2x topnav-icon">
                <i class="fa fa-comments fa-stack-2x"></i>
            </span></a>
        <a href="inlog.php" class="topnavright topnav-winkelwagen"><span class="fa-stack fa-2x topnav-icon">
                <i class="fa fa-user fa-stack-2x"></i>
            </span></a>
        <a href="verlanglijst.php" class="topnavright topnav-winkelwagen">
            <?php if($verlanglijstAantal > 0){ ?>
                <span class="fa-stack fa-2x has-badge topnav-icon" data-count="<?php  echo $verlanglijstAantal; ?>">
                <i class="fa fa-stack-2x fa-inverse"></i>
                <i class="fa fa-gift fa-stack-2x"></i>
            </span>
            <?php }else{ ?>
                <span class="fa-stack topnav-icon">
                <i class="fa fa-gift fa-stack-2x"></i>
            </span>
            <?php } ?>

        </a>

    <a href="cart.php" class="topnavright topnav-winkelwagen">
        <?php if($aantal_winkelmand !== 0){ ?>
            <span class="fa-stack fa-2x has-badge topnav-icon" data-count="<?php  print($aantal_winkelmand); ?>">
                <i class="fa fa-stack-2x fa-inverse"></i>
                <i class="fa fa-shopping-cart fa-stack-2x"></i>
            </span>
        <?php }else{ ?>
            <span class="fa-stack topnav-icon">
                <i class="fa fa-shopping-cart fa-stack-2x"></i>
            </span>
        <?php } ?>
    </a>



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
    $_SESSION['paginaNummer'] = 1;
    $_SESSION['categorie'] = 'zoeken';
    $_SESSION['zoekwoord'] = $_GET["zoek"];
}
elseif(isset($_GET['categorieen'])){
    foreach($_GET['categorieen'] as $cat){
        $_SESSION['paginaNummer'] = 1;
        $_SESSION['categorie'] = $cat;
    }
}

if((isset($_SESSION['categorie']) AND $_SESSION['categorie'] == 'zoeken')){
    $producten = zoekProduct($_SESSION['zoekwoord']);
}
else if((isset($_SESSION['categorie']) AND $_SESSION['categorie'] == "overzicht")){
    $producten = productenLijst();
}
elseif(!isset($_SESSION['categorie'])){
    $_SESSION['categorie'] = 'overzicht';
    $producten = productenLijst();
}
if(isset($_SESSION['categorie'])AND $_SESSION['categorie'] != "overzicht" AND $_SESSION['categorie'] != "zoeken"){
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

