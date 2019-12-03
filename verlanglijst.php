<?php
include('include.php');
?>
    <div style="margin-top: 60px;">
        <h1>Verlanglijstje</h1>
    </div>
    <hr>
<?php
if(isset($_SESSION["verlanglijst"])){
    foreach ($_SESSION["verlanglijst"] as $productId){
        $product = getOneProductById($productId);
        $productID = $product['StockItemID'];
        $productNaam = $product['StockItemName'];
        $productPrijs = $product['RecommendedRetailPrice'];
        $productdails = $product["SearchDetails"];
        ?>
        <div class="cartrow flex-container">
            <div class="cursor" onclick="location.href='producten.php?id=<?php print($productID); ?>';">
                <img class="fancy-image-verlanglijst" src="plaatjeswwi/id<?php print($productID)?>.jpg" onerror='this.src="plaatjeswwi/default.jpg"'>
            </div>
            <div class="cart_naam">
                <h3><?php print($productNaam); ?></h3>
                <h4 style="color: gray;"><?php print($productdails); ?></h4>
            </div>
            <div class="cart_prijs">
                <div style="text-align: right;">
                    <div style="color: #27ae60; font-size: 40px; font-weight: bold;">
                    &euro; <?php print(ceil($productPrijs)); ?>
                    </div>
                    <div>
                    euro
                    </div>
                </div>

                <div style="display: inline-block">
                <form method="post" action="verlanglijstje/verwijderen.php">
                    <input type="hidden" name="productID" value='<?php print($productID);?>'>
                    <button type="submit" name="remove_verlanglijst" class="delete_button cursor mt-10"><i class="fa fa-trash"></i></button>
                </form>
                </div>

                <div style="display: inline-block">
                <form method="post" action="verlanglijstje/toevoegenAanWinkelmand.php">
                    <input type="hidden" name="productID" value='<?php print($productID);?>'>
                    <button type="submit" name="to_cart" class="move_button cursor mt-10"><i class="fa fa-shopping-cart"></i></button>
                </form>
                </div>

            </div>
        </div>
        <hr>

        <?php
    }
}
?>
