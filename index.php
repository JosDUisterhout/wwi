<?php
include('includes.php');

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

    <form method="get">
        <input type="text" name="zoek" placeholder="Zoeken" />
        <input type="submit" name="submit" />
    </form>

    <table>
        <?php
        if(isset($_GET['submit'])) {
            $zoek = $_GET["zoek"];
            $producten = zoekProduct($zoek);
        }
        else{
            $producten = productenLijst(25);
        }
        ?>
    </table>
<div class="grid-container">
    <?php

    foreach($producten as $product){
    print('<div class="grid-item">Product ' . $product["StockItemName"] . '</div>');
    }
     ?>
</div>

</body>
</html>
