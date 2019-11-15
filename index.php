<?php
include('include.php');

global $producten;

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
            $foto = $product["Photo"];
            echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' . $product["StockItemName"] . '<br>
            <img alt="test" src="data:image/png;base64,' . base64_encode($foto) . '"> 
            </div>');
        }
    ?>
</div>


</body>
</html>
