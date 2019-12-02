<?php
include "../functies.php";
session_start();
foreach ($_SESSION["verlanglijst"] as $key => $product){
        if($product === $_POST["productID"]){
        unset($_SESSION["verlanglijst"][$key]);
    }
}

redirect('/wwi/verlanglijst.php');
?>