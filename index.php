<?php
include('includes.php');
$producten = productenLijst();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: #2196F3;
            padding: 10px;
        }
        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 20px;
            font-size: 30px;
            text-align: center;
        }
    </style>
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
