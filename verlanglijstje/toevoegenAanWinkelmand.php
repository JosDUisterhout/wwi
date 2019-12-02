<?php
include "../functies.php";

session_start();

toevoegenProductWinkelmand($_POST["productID"], 1, TRUE);

foreach ($_SESSION["verlanglijst"] as $key => $product){

    if($product === $_POST["productID"]){
        unset($_SESSION["verlanglijst"][$key]);
    }
}

redirect('/wwi/cart.php');