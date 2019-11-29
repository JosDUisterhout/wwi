<?php
include('include.php');

if(isset($_POST['to_cart']) AND isset($_POST['productID'])){
    if(!in_array($_POST['productID'], $_SESSION['cart'])){
        $_SESSION['cart'] = $_POST['productID'];
    }
    unset($_SESSION['verlanglijst'][$_POST['productID']]);
}

if(isset($_POST['verlanglijst'])) {
    toevoegenProductVerlanglijst($_POST['productID'], TRUE);
}else{
    toevoegenProductVerlanglijst(0, FALSE);
}

if(isset($_POST['remove_verlanglijst'])){
    verwijdenProductVerlanglijst($_POST['productID']);
}
?>
    <br>
    <br>
    <br>
    <div>
        <h1>Verlanglijstje</h1>
    </div>
    <hr>
<?php
if(isset($_SESSION["verlanglijst"])){
    foreach ($_SESSION["verlanglijst"] as $product){
        $product = productenItem($product);
        $productID = $product[0]['StockItemID'];
        $productNaam = $product[0]['StockItemName'];
        $productPrijs = $product[0]['RecommendedRetailPrice'];
        $productdails = $product[0] ["SearchDetails"];
//        print_r($product);
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
                <form method="post" action="">
                    <input type="hidden" name="productID" value='<?php print($productID);?>'>
                    <button type="submit" name="remove_verlanglijst" class="delete_button cursor"><i class="fa fa-trash"></i></button>
                    <br>
                    <br>

                    <button type="submit" name="to_cart" class="move_button cursor"><i class="fa fa-shopping-cart"></i></button>
                </form>
            </div>

        </div>
        <hr>

        <?php
    }
}
?>