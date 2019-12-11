<?php
include('include.php');

?>
<br><br><br>
<form class="registreren" method="post" style="width:30%">
<table align="center">
    <tr><td><label for="gebruikersnaam">gebruikersnaam<br></label><input class="registrerentext" type="text"  name="gebruikersnaam" placeholder="gebruikersnaam"></td></tr>
    <tr><td><label for="voornaam">voornaam<br></label><input class="registrerentext" type="text" name="voornaam" placeholder="voornaam"></td></tr>
    <tr><td><label for="achternaam">achternaam<br></label><input class="registrerentext" type="text" name="achternaam" placeholder="achternaam"></td></tr>
    <tr><td><label for="wachtwoord">wachtwoord<br></label><input class="registrerentext" type="password" name="wachtwoord" placeholder="wachtwoord"></td></tr>
    <tr><td><label for="wachtwoord2">wachtwoord bevestigen<br></label><input class="registrerentext" type="password" name="wachtwoord2" placeholder="wachtwoord bevestigen"></td></tr>
    <tr><td><label for="emailadres">emailadres<br></label><input class="registrerentext" type="email" name="emailadres" placeholder="emailadres"></td></tr>
    <tr><td><label for="postcode">postcode<br></label><input class="registrerentext" type="text" name="postcode" placeholder="postcode"></td></tr>
    <tr><td><label for="woonplaats">woonplaats<br></label><input class="registrerentext" type="text" name="woonplaats" placeholder="woonplaats"></td></tr>
    <tr><td><label for="adres">adres<br></label><input class="registrerentext" type="text" name="adres" placeholder="straat en huisnummer"></td></tr>
    <tr><td><label for="telefoon">telefoon<br></label><input class="registrerentext" type="text" name="telefoon" placeholder="telefoonnummer"></td></tr>
    <tr><td><input class="registreerbutton" type="submit" name="registreren" value="registreren"></td></tr>
    </table>
</form>

<?php

if (isset($_POST['registreren'])) {

    if(registreergebruikersnaam($_POST['gebruikersnaam'])){


            print("gebruikersnaam is al in gebruik <br> kies alstublieft een ander");


} elseif ($_POST['wachtwoord'] != $_POST['wachtwoord2']){
        print ("wachtwoorden komen niet overeen <br> probeer het nog eens");
    } elseif (!emailvalidator($_POST['emailadres'])){
        print ("één van de onderstaande velden is onjuist ingevuld <br> probeer het nog eens");

    }
    elseif (registreeremailadress($_POST['emailadres'])){
        print ("emailadres is al in gebruik <br> kies alstublieft een ander");
    }
    else {
        registreer($_POST['gebruikersnaam'],$_POST['wachtwoord'],$_POST['emailadres'],$_POST['voornaam'],$_POST['achternaam'],$_POST['postcode'],$_POST['woonplaats'],$_POST['adres'],$_POST['telefoon']);
        header('location: secure.php');

    }
}


?>