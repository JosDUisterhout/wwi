<?php

include('include.php');

?>
<form method="post">
    <h1 class="registreren"><?php
    if(isset($_SESSION['gebruikersnaam'])){
        print ("<br><br><br><br><br>u bent ingelogd als <br> ". $_SESSION['gebruikersnaam'] . "<br> WELKOM" );
    ?></h1>
        <tr><td><input class="uiloggenbutton" type="submit" name="uitloggen" value="Uitloggen"</td></tr>
        <tr><td><input class="registreerbutton" type="submit" name="homepage" value="terug naar homepage"></td></tr>
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