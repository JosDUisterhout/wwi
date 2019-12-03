<?php

include('include.php');
echo '<br><br><br>';
if(isset($_SESSION['gebruikersnaam'])){
    print ("u bent ingelogd als ". $_SESSION['gebruikersnaam']);

?>
<form method="post">
    <td><input type="submit" name="uitloggen" value="Uitloggen"></td>
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