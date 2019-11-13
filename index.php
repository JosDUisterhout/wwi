<?php
include('include.php');

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

<script type="application/javascript">

    function doeIets(){
        alert("je hebt op een item geklikt!");
    }
</script>

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
        $id = $product["StockItemID"];
    print('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' . $product["StockItemName"] . '</div>');
    }
     ?>
</div>


</body>
</html>
