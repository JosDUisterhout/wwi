<?php
include('include.php');

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
            print('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' . $product["StockItemName"] . '</div>');
        }
    ?>
</div>


</body>
</html>
