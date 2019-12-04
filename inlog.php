<?php
include('include.php');
session_start();
echo '<br><br><br>';
echo '<table align="center"><form method="POST" >';
echo '<tr><td><label for="gebruikersnaam">gebruikersnaam</label><input type="text" name="gebruikersnaam"></td>';
echo '<td><label for="wachtwoord">wachtwoord</label><input type="password" name="wachtwoord"></td>';
echo '<td><input type="submit" name="inloggen" value="Inloggen"></td>';

echo '<td><input type="submit" name="registreren" value="registreren"></td>';

if(isset($_POST['registreren'])){
    header('location: registreer.php');
}

if(isset($_POST['inloggen'])){


    if (inlog($_POST['gebruikersnaam'] , $_POST['wachtwoord']) AND inlog($_POST['gebruikersnaam'] , $_POST['wachtwoord'])[0]["gebruikersNaam"] == $_POST['gebruikersnaam']){
        $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
    header('location: secure.php');

    }
     else {
        print ("gebruikersnaam en/of wachtwoord zijn onjuist ingevuld <br> probeer het nog eens ");
    }
}

