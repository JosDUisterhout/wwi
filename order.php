

<?php

//TODO: rekening houden met verschillende verzendmethoden e-mail staat niet bij ophaalpunt

include('include.php');
?>
<center>
<br><br>
<h1>Gelukt! bedankt voor uw besteling</h1>
<h2>Factuur</h2>
Dit factuur wordt naar <em></em> <?php echo $_POST["email"]?> verstuurd<br><br><a  href="betaal.php" value="afronder"><i<i   class="button">Afronden</i></a>
</center>
<order>

    <center> <h2>Factuur</h2><br></center>
    <proorder>
    <?php

    $totaalprijs = 0;
//    var_dump($_SESSION["cart"]);
//    die;
    if(isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $aantal){
            $product = productenItem($key);
            $productID = $product[0]['StockItemID'];
            $productNaam = $product[0]['StockItemName'];
            $productPrijs = $aantal * ceil($product[0]['RecommendedRetailPrice']);
            $productdails = $product[0]["SearchDetails"];
            $voorraad = $product[0]["QuantityOnHand"];
            $totaalprijs = $totaalprijs + $productPrijs;
            //print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:100px; max-height:100px; min-width: 50px; min-height: 50px' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");
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
        <em>Woonplaats:</em> <?php echo ($_POST["woonplaats"])?><br>
<br>
        <?php print ("Order Nr: 1234")?>

    </ol>
        </orderd>

</order>

<br>
<?php




?>

