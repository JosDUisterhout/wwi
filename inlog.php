<?php
include('functie.php');
session_start();

echo '<table align="center"><form method="POST" >';
echo '<tr><td><label for="gebruikersnaam">gebruikersnaam</label><input type="text" name="gebruikersnaam"></td>';
echo '<td><label for="wachtwoord">wachtwoord</label><input type="password" name="wachtwoord"></td>';
echo '<td><input type="submit" name="inloggen" value="Inloggen"></td>';



if(isset($_POST['inloggen'])){
    if (inlog($_POST['gebruikersnaam'] , $_POST['wachtwoord'])){
    header('location: secure.php');

    }
     else {
        print ("gebruikersnaam en/of wachtwoord zijn onjuist ingevuld <br> probeer het nog eens ");
    }
}

