<?php
include('include.php');


?>
<br>
<br>
<br><center>
<h1>leveradres</h1>
<br>
login met uw WWI acount of vul uw gegevens in voor een bezorgadres/ophaalpunt
<br></center><br>
<!DOCTYPE html>
<html>
<a href="acount.php" class="center"><i<i class="button">Log in</i></a><br><br>
<a  href="bestellen.php" class="afhaal"><i<i class="button">Bezorgen</i></a>
<form action="order.php" method="post" >
    <vradres>

        <br>
        lever adres <br>
        <label> <input type="text" name="voornaam"placeholder="Voornaam" required> </label><br>
        <label> <input type="text" name="achternaam"placeholder="achternaam" required></label><br>
        <label> <input type="text" name="stad"placeholder="Stad"required> </label><br>
        <label> <input type="text" name="tel"placeholder="Telefoon"> </label><br>
        <select name="waar"><br>
            <option value="Postkantoor">Postkantoor</option><br>
            <option value="Afhaalpunt 2">Afhaalpunt 2</option><br>
            <option value="Afhaalpunt 3">Afhaalpunt 3</option><br>
            <option value="Afhaalpunt 4">Afhaalpunt 4</option><br>

            <br>
            <input type="submit" value="Opslaan" name="submit" /> <br><br>
</form>
</vradres>

<br>


</html>

