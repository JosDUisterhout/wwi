<?php
include('include.php');

global $producten;
global $categorieen;

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div id="zoek"  class="hero-image">
    <div class="hero-text">
        <h1>WWI</h1>


    </div>
</div>

<div class="m0a">
    <form action="#zoek">
        <button class="btn active" type="submit" name="overzicht">Overzicht</button>
        <?php foreach($categorieen as $categorie){
            print("<button class=\"btn\" type=\"submit\" name=\"categorieen[]\"  value=\"" . $categorie['StockGroupName'] . "\">" .  $categorie['StockGroupName'] . "</button>");
        } ?>
        <input type="hidden" name="get">
    </form>
</div>

<div class="grid-container">
    <?php
        foreach($producten as $product){
            $id = $product["StockItemID"];
            $foto = $product["Photo"];
            echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' . $product["StockItemName"] . '<br>
            </div>');
        }
    ?>
</div>




</body>
</html>
