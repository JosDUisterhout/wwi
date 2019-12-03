<?php
include('functie.php');
session_start();
?>
<form method="post">
<table align="center"><form method="POST" >
<tr><td><label for="gebruikersnaam">gebruikersnaam</label><input type="text" name="gebruikersnaam" placeholder="gebruikersnaam"></td>
<td><label for="wachtwoord">wachtwoord</label><input type="password" name="wachtwoord" placeholder="wachtwoord"></td>
    <td><label for="wachtwoord2">wachtwoord bevestigen</label><input type="password" name="wachtwoord2" placeholder="wachtwoord bevestigen"></td>
    <td><label for="emailadress">emailadress</label><input type="text" name="emailadress" placeholder="emailadress"></td>
<td><input type="submit" name="registreren" value="registreren"></td>
</form>
<?php

if (isset($_POST['registreren'])) {

    if(registreergebruikersnaam($_POST['gebruikersnaam'])){


            print("gebruikersnaam is al in gebruik <br> kies alstublieft een ander");


} elseif ($_POST['wachtwoord'] != $_POST['wachtwoord2']){
        print ("wachtwoorden komen niet overeen <br> probeer het nog eens");
    } elseif (!emailvalidator($_POST['emailadress'])){
        var_dump($_POST);
        print ("emailadress is onjuist ingevuld <br> probeer het nog eens");

    }
    elseif (registreeremailadress($_POST['emailadress'])){
        print ("emailadress is al in gebruik <br> kies alstublieft een ander");
    }
    else {
        registreer($_POST['gebruikersnaam'],$_POST['wachtwoord'],$_POST['emailadress']);
        header('location: secure.php');

    }
}


?>