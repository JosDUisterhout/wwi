<?php
include('include.php');
session_start();
?>
<br><br><br>
<table align="center" ><form method="POST" >
<tr><td><label for="gebruikersnaam">gebruikersnaam<br></label><input type="text" name="gebruikersnaam"></td>
<tr></tr><td><label for="wachtwoord">wachtwoord<br></label><input type="password" name="wachtwoord"></td>
<tr></tr><td><input type="submit" name="inloggen" value="Inloggen"></td>

<tr></tr><td><input type="submit" name="registreren" value="registreren"></td>
<?php
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

