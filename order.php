

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
    if(isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $aantal){
            $product = productenItem($key);
            $productID = $product[0]['StockItemID'];
            $productNaam = $product[0]['StockItemName'];
            $productPrijs = $aantal * ceil($product[0]['RecommendedRetailPrice']);
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
        <em>Woonplaats:</em> <?php echo ($_POST["woonplaats"])?><br>
<br>
        <?php print ("Order Nr: 1234")?>

    </ol>
        </orderd>

</order>

<!--<br>-->
<?php
//$to_email = "ivanknigge1997@gmail.com";
//$subject = "Simple Email Test via PHP";
//$body = "Hi,nn This is test email send by PHP Script";
//$headers = "From: ivanknigge1997@gmail.com";
//
//if (mail($to_email, $subject, $body, $headers)) {
//    echo "Email successfully sent to $to_email...";
//} else {
//    echo "Email sending failed...";
//}
//?>
