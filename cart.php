<?php

include('include.php');

?>
<br>
<br>
<br><a href="Bestellen.php" class="topnavright"><i class="button">Afrekenen</i></a>


<div>
    <h1>Winkelmandje</h1>
</div>
<hr>
<?php


$totaalprijs = 0;
if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $key => $aantal){
        $product = productenItem($key);
        $productID = $product[0]['StockItemID'];
        $productNaam = $product[0]['StockItemName'];
        $productPrijs = $aantal * ceil($product[0]['RecommendedRetailPrice']);
        $productdails = $product[0]["SearchDetails"];
        $voorraad = $product[0]["QuantityOnHand"];
        $totaalprijs = $totaalprijs + $productPrijs
?>

<div class="cartrow flex-container">
    <div class="cursor" onclick="location.href='producten.php?id=<?php print($productID); ?>';">
        <img class="fancy-image-verlanglijst" src="plaatjeswwi/id<?php print($productID)?>.jpg" onerror='this.src="plaatjeswwi/default.jpg"'>
    </div>
    <div class="cart_naam">
        <h3><?php print($productNaam); ?></h3><br>
        <h4 style="color: gray"><?php print($productdails); ?></h4>
    </div>
    <div class="cart_aantal_style">
        <h3><?php print("Aantal"); ?></h3><br>
        <select class="selectstyle" id="<?php print($productID); ?>" onchange="myFunction(this.id)">
            <?php

                if($voorraad >= 10){
                    $x = 1;
//                    print('test');
                    while($x <= 10) {
                        if($x == $aantal){
                            print("<option value=\"$x\" selected=\"selected\">$x</option>");
                        }else{
                            print("<option value=\"$x\">$x</option>");
                        }

                        $x++;
                    }
                }else{
//print('test');
                    $z = 4;
                    $x = 1;
                    while($x <= $voorraad){
                        print("<option value=\"6\">$x</option>");
                        $x++;
                    }
                }
            ?>
        </select>
    </div>
    <div class="cart_prijs">
        <div style="text-align: right">
            <div style="color: #27ae60; font-size: 40px; font-weight: bold;">
                &euro; <?php print(ceil($productPrijs)); ?>
            </div>
            <div>
                euro
            </div>
            <div style="display: inline-block; padding-top: 10px;">
                <form method="post" action="cart.php">
                    <input type="hidden" name="productID" value='<?php print($productID);?>'>
                    <button type="submit" name="remove_cart" class="delete_button cursor"><i class="fa fa-trash"> </i></button>
                </form>
            </div>
        </div>
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
<div class="cartrow flex-container">
    <div class="cart_totaalprijs">
        <h2><?php
            print("Totaalprijs: € $totaalprijs euro");?></h2>
    </div>
</div>

<script>
    function myFunction(id) {

        var aantal = document.getElementById(id).value;
        console.log(aantal);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("productID="+ id +"&productAantal="+ aantal +"&cart=''");

        location.reload();
    }
</script>
