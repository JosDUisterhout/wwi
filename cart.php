<?php

include('include.php');

?>
<br><a href="Bestellen.php" class="topnavright"><i class="button">Afrekenen</i></a>
    <br>
    <br>

<div>
    <h1>Winkelmandje</h1>
</div>
<hr>
<?php
if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $product){
        $product = productenItem($product);
        $productID = $product[0]['StockItemID'];
        $productNaam = $product[0]['StockItemName'];
        $productPrijs = $product[0]['RecommendedRetailPrice'];
        $productdails = $product[0] ["SearchDetails"];
?>


<div class="cartrow flex-container">
    <div class="cursor" onclick="location.href='producten.php?id=<?php print($productID); ?>';">
        <img class="cart_image" src="plaatjeswwi/id<?php print($productID)?>.jpg" onerror='this.src="plaatjeswwi/default.jpg"'>
    </div>
    <div class="cart_naam">
        <h3><?php print($productNaam); ?></h3><br>
        <h4><?php print($productdails); ?></h4>
    </div>
    <div class="cart_prijs">
        <h3><?php print("€ ".ceil($productPrijs). " euro"); ?></h3>
        <form method="post" action="cart.php">
            <input type="hidden" name="productID" value='<?php print($productID);?>'>
            <button type="submit" name="remove_cart" class="delete_button cursor"><i class="fa fa-trash"> </i></button>
        </form>
    </div>

</div>
        <hr>

<?php
    }
}else{
    ?>
<div class="flex-container">
    <div class="">
        <h3><?php print("Winkelmandje is leeg, DOE ER WAT AAN!!!"); ?></h3>
    </div>
</div>
<?php
}
?>

