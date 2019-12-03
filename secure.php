<?php

print'u bent ingelogd als ' . $_POST['gebruikersnaam'];
print '<table align="center"><form method="POST" >';
print '<td><input type="submit" name="uitloggen" value="log uit"></td>';

if(isset($_POST['uitloggen'])){

    session_destroy();
    header('location: index.php');
}
else{
    header('location: inlog.php');
}
