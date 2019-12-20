<?php

include('include.php');

if(isset($_POST['uitloggen'])){
    unset($_SESSION['gebruikersnaam']);
    header('Location: index.php');
}
elseif(!isset($_SESSION['gebruikersnaam'])){
    header('Location: inlog.php');
}
if(isset($_POST['homepage'])){
    header("location: index.php");
}

?>
<form method="post">
    <h1 class="registreren">
<?php
        print ("<br><br>U bent ingelogd als: <br> ". $_SESSION['gebruikersnaam'] . "<br> WELKOM" );
?>
    </h1>
        <?php
            $bestellingen = getBestelling($_SESSION['gebruikersID']);
            if($bestellingen){
        ?>
            <h2>Hieronder ziet u al uw bestellingen:</h2>

                <table id="orders">
                    <tr>
                        <th>Ordernummer:</th>
                        <th>Aantal producten gekocht:</th>
                        <th>Totaalprijs:</th>
                        <th>Datum:</th>
                    </tr>




                <?php
            foreach ($bestellingen as $bestelling){
                $bestellingID = $bestelling['bestellingID'];
                $datum = $bestelling['datum'];
                $producten = getBestellingLines($bestellingID);
                $totaalAantal = $producten[0]['totaalAantal'];
                $totaalPrijs = number_format($producten[0]['totaalPrijs'],2,'.', '');
        ?>
                <tr onclick="location.href='factuur.php?id=<?php print($bestellingID); ?>'">
                    <td>#<?php print($bestellingID); ?></td>
                    <td><?php print($totaalAantal); ?></td>
                    <td>€<?php print($totaalPrijs); ?></td>
                    <td><?php print($datum); ?></td>
                </tr>


                <?php
            }
            ?>
            </table><br><br>

    <?php
        }
    ?>


        <tr><td><input class="redbutton" type="submit" name="uitloggen" value="Uitloggen"</td></tr>
        <tr><td><input class="button" type="submit" name="homepage" value="Terug naar homepage"></td></tr>
</form>
