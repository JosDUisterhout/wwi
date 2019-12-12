<?php

include('include.php');

?>
<form method="post">
    <h1><?php
    if(isset($_SESSION['gebruikersnaam'])){
        print ("<br><br><br><br><br><br>u bent ingelogd als <br> ". $_SESSION['gebruikersnaam'] . "<br>" );
    ?></h1>
    <td><input class="uiloggenbutton" type="submit" name="uitloggen" value="Uitloggen"></td>
    <td><input class="registreerbutton" type="submit" name="homepage" value="terug naar homepage"></td>
</form>
<?php
if(isset($_POST['uitloggen'])){
    unset($_SESSION['gebruikersnaam']);
    header('Location: inlog.php');
}

}
else{
    header('Location: inlog.php');
}
if(isset($_POST['homepage'])){
    header("location: index.php");
}