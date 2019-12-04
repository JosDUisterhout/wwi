<?php
include('include.php');
session_start();
?>
<form method="post">
    <br><br><br>
<table align="center"><form method="POST" >
<tr><td><label for="gebruikersnaam">gebruikersnaam<br></label><input type="text" name="gebruikersnaam" placeholder="gebruikersnaam"></td>
<tr></tr><td><label for="wachtwoord">wachtwoord<br></label><input type="password" name="wachtwoord" placeholder="wachtwoord"></td>
<tr></tr><td><label for="wachtwoord2">wachtwoord bevestigen<br></label><input type="password" name="wachtwoord2" placeholder="wachtwoord bevestigen"></td>
<tr></tr><td><label for="emailadres">emailadres<br></label><input type="text" name="emailadres" placeholder="emailadres"></td>
<tr></tr><td><input type="submit" name="registreren" value="registreren"></td>
</form>
<?php

if (isset($_POST['registreren'])) {

    if(registreergebruikersnaam($_POST['gebruikersnaam'])){


            print("gebruikersnaam is al in gebruik <br> kies alstublieft een ander");


} elseif ($_POST['wachtwoord'] != $_POST['wachtwoord2']){
        print ("wachtwoorden komen niet overeen <br> probeer het nog eens");
    } elseif (!emailvalidator($_POST['emailadres'])){
        print ("emailadres is onjuist ingevuld <br> probeer het nog eens");

    }
    elseif (registreeremailadress($_POST['emailadres'])){
        print ("emailadres is al in gebruik <br> kies alstublieft een ander");
    }
    else {
        registreer($_POST['gebruikersnaam'],$_POST['wachtwoord'],$_POST['emailadres']);
        header('location: inlog.php');

    }
}


?>