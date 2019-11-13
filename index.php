<?php
include('include.php');

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>


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
