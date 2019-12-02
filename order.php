

<?php

//TODO: rekening houden met verschillende verzendmethoden e-mail staat niet bij ophaalpunt

include('include.php');
?>
<center>
<br><br>
<h1>Gelukt! bedankt voor uw betaling</h1>
<h2>Factuur</h2>
Dit factuur wordt naar <em></em> <?php echo $_POST["email"]?> verstuurd<br><br><a  href="betaal.php" class=""><i<i class="button">Afronden</i></a>
</center>
<order>

    <center> <h2>Factuur</h2><br></center>
    <proorder>
    <?php

    $totaalprijs = 0;
    if(isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $product) {
            $product = productenItem($product);
            $productID = $product[0]['StockItemID'];
            $productNaam = $product[0]['StockItemName'];
            $productPrijs = $product[0]['RecommendedRetailPrice'];
            $productdails = $product[0] ["SearchDetails"];
            $totaalprijs = $totaalprijs + $productPrijs;

            echo '<br>';
            print($productNaam . ' ' . $productPrijs);

            //print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:100px; max-height:100px; min-width: 50px; min-height: 50px' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");
        }

    }print("<br> <br> <br> totaalprijs: " .$totaalprijs);
    ?>
    </proorder>
    <orderd>
    <ol>

        <li><em>Naam:</em> <?php echo $_POST["voornaam"].' '.$_POST["achternaam"]?></li>
        <li><em>Email:</em> <?php echo $_POST["email"]?></li>
        <li><em>Tel:</em> <?php if(isset($_POST["tel"])){echo$_POST["tel"];}?></li>
        ---------Lever adres---------
        <li><em>Adres:</em> <?php echo ($_POST["adres"])?></li>
        <li><em>Woonplaats:</em> <?php echo ($_POST["woonplaats"])?></li>


    </ol>
        </orderd>

</order>

<br>




