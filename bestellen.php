<?php
include('include.php');


?>
<br>
<br>
<br>
<br>
<!DOCTYPE html>
<html>
<a href="acount.php" class="center"><i<i class="button">Log in</i></a><br><br>
<form action="bestellen.php" method="GET">
<vradres>

        <label> Bezorgen <input type="radio"name="afhalen" value="1" required></label><br><br>
        <label> <input type="text" name="voornaam"placeholder="Voornaam" > </label><br>
        <label> <input type="text" name="achternaam"placeholder="achternaam"></label><br>
        <label> <input type="text" name="email"placeholder="Email"></label><br>
        <label> <input type="text" name="adres"placeholder="Adres"> </label><br>
        <label> <input type="text" name="woonplaats"placeholder="Woonplaats"></label><br>
        <label> <input type="text" name="tel"placeholder="Telefoon"> </label><br>

    <br>
        <label> Afhalen <input type="radio"name="afhalen" value="1"> </label><br><br>
        <label> <input type="text" name="stad"placeholder="Stad"> </label><br><br>
    <select name="cars">
        <option value="Afhaalpunt 1">Afhaalpunt 1</option>
        <option value="Afhaalpunt 2">Afhaalpunt 2</option>
        <option value="Afhaalpunt 3">Afhaalpunt 3</option>
        <option value="Afhaalpunt 4">Afhaalpunt 4</option>
    </select>
<br>
    <input type="submit" value="Submit" />
</form>
</vradres>
<a href="betaal.php" class="center"><i<i class="button">Afronden</i></a>
<br>
<?php

?>

</html>
