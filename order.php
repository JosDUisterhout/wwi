

<?php

//TODO: rekening houden met verschillende verzendmethoden e-mail staat niet bij ophaalpunt

include('include.php');
bestelling($_POST);
?>
<center>
<br><br>
<h1>Gelukt! bedankt voor uw besteling</h1>
<h2>Factuur</h2>
Dit factuur wordt naar <em></em> <?php echo $_POST["email"]?> verstuurd<br><br>
    <a  href="betaal.php" value="afronder"><i<i   class="button">Afronden</i></a>

</center>
<order>

    <center> <h2>Factuur</h2><br></center>
    <proorder>
    <?php

    $totaalprijs = 0;
    if(isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $aantal){
            $product = productenItem($key);
            $productID = $product[0]['StockItemID'];
            $productNaam = $product[0]['StockItemName'];
            $productPrijs = ($productPrijs = number_format(geefkorting($product[0]['RecommendedRetailPrice'], $product[0]['DiscountAmount'])  * $aantal, 2, '.', '' ));
            $productdails = $product[0]["SearchDetails"];
            $voorraad = $product[0]["QuantityOnHand"];
            $totaalprijs = $totaalprijs + $productPrijs;
            echo '<br>';
            print($productNaam . ' ' . $productPrijs);
        }
    }
    print("<br> <br> <br> totaalprijs: " .$totaalprijs);
    ?>
    </proorder>
    <orderd>
    <ol>

        <em>Naam:</em> <?php echo $_POST["voornaam"].' '.$_POST["achternaam"]?><br>
        <em>Email:</em> <?php echo $_POST["email"]?><br>
        <em>Tel:</em> <?php if(isset($_POST["tel"])){echo$_POST["tel"];}?><br>
        ---------Lever adres---------<br>
        <em>Adres:</em> <?php echo ($_POST["adres"])?><br>
        <em>Postcode:</em> <?php echo ($_POST["postcode"])?><br>
        <em>Woonplaats:</em> <?php echo ($_POST["woonplaats"])?><br>

<br>
        <?php
        print ("Order Nr: " . $_SESSION['orderNR'])?>

    </ol>
        </orderd>

</order>
