<?php
include('include.php');

global $producten;

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div class="hero-image">
    <div class="hero-text">
        <h1>WWI</h1>


    </div>
</div>
<div class="grid-container">
    <?php
        foreach($producten as $product){
            $id = $product["StockItemID"];
            $foto = $product["Photo"];
            echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' . $product["StockItemName"] . '<br>
            <img alt="test" src="data:image/png;base64,' . base64_encode($foto) . '"> 
            </div>');
        }
    ?>
</div>


</body>
</html>
