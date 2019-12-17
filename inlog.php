<?php
include('include.php');

if(isset($_SESSION['gebruikersnaam'])){
    header('Location: secure.php');
}
?>
<br><br><br>
    <form class="registreren" method="post" style="width:30%">
<table align="center" ><form method="POST">
<tr><td><label for="gebruikersnaam">gebruikersnaam<br></label><input class="registrerentext" type="text" name="gebruikersnaam" placeholder="gebruikersnaam"></td>
<tr></tr><td><label for="wachtwoord">wachtwoord<br></label><input class="registrerentext" type="password" name="wachtwoord"placeholder="wachtwoord"></td>
<tr></tr><td><input class="registreerbutton" type="submit" name="inloggen" value="Inloggen"></td>

<tr></tr><td><input class="registreerbutton" type="submit" name="registreren" value="registreren"></td>
    </form>
<?php
if(isset($_POST['registreren'])){
    header('location: registreer.php');
}

if(isset($_POST['inloggen'])){


    if (inlog($_POST['gebruikersnaam'] , $_POST['wachtwoord'])){
        $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
        $klant = inlog($_POST['gebruikersnaam'] , $_POST['wachtwoord']);
        $_SESSION['gebruikersID'] = $klant[0]['klantID'];
        header('location: secure.php');

    }
     else {
        print ("gebruikersnaam en/of wachtwoord zijn onjuist ingevuld <br> probeer het nog eens ");
    }
}

