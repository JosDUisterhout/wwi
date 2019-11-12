<?php
include('includes.php');
$producten = productenLijst(25);
?>

<!DOCTYPE html>
<html>
<head>
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
            zoekProduct($zoek);
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
