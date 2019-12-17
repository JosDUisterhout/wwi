<?php

include('include.php');

?>

<?php
if(isset($_SESSION['gebruikersnaam'])){
    print ("<br><br>u bent ingelogd als: <br> ". $_SESSION['gebruikersnaam'] . "<br> WELKOM" );
    ?>
<form method="post">
    <h1 class="registreren">

    </h1>
    <h2>Hieronder ziet uw al uw bestellingen:</h2>
        <hr>
        <?php
        $bestellingen = getBestelling($_SESSION['gebruikersID']);
        if($bestellingen){
            foreach ($bestellingen as $bestelling){
                $productID = $bestelling['StockItemID'];
                $productNaam = $bestelling['StockItemName'];
                $productdails = $bestelling["SearchDetails"];
                $aantal = $bestelling['aantal'];
                $productPrijs = $aantal * $bestelling['RecommendedRetailPrice'];
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
                        <h4 style="color: gray"><?php print($aantal); ?></h4>

                    </div>
                    <div class="cart_prijs">
                        <div style="text-align: right">
                            <h3><?php print("Prijs:"); ?></h3><br>
                            <div style="color: #27ae60; font-size: 40px; font-weight: bold;">
                                &euro; <?php print($productPrijs); ?>
                            </div>
                            <div>
                                euro
                            </div>
                        </div>
                    </div>

                </div>
                <hr>


                <?php
            }
        }

        ?>


        <tr><td><input class="redbutton" type="submit" name="uitloggen" value="Uitloggen"</td></tr>
        <tr><td><input class="button" type="submit" name="homepage" value="Terug naar homepage"></td></tr>
</form>
<?php
if(isset($_POST['uitloggen'])){
    unset($_SESSION['gebruikersnaam']);
    header('Location: index.php');
}

}
else{
    header('Location: inlog.php');
}
if(isset($_POST['homepage'])){
    header("location: index.php");
}
