<?php

include('include.php');
echo '<br><br><br>';
if(isset($_SESSION['gebruikersnaam'])){
    print ("u bent ingelogd als ". $_SESSION['gebruikersnaam']);

?>
<form method="post">
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