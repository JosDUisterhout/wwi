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
<a  href="afhalen.php" class="afhaal"><i<i class="button">Ophaalpunt</i></a>
<form action="order.php" method="post" >
<vradres>
<br>
        lever adres <br>
        <label> <input type="text" name="voornaam"placeholder="Voornaam" required> </label><br>
        <label> <input type="text" name="achternaam"placeholder="achternaam" required></label><br>
        <label> <input type="text" name="email"placeholder="Email" required></label><br>
        <label> <input type="text" name="adres"placeholder="Adres" required> </label><br>
        <label> <input type="text" name="woonplaats"placeholder="Woonplaats" required></label><br>
        <label> <input type="text" name="tel"placeholder="Telefoon"> </label><br>
    <input type="hidden" name="form_submitted" value="1" />
    <br>
<br>
    <input type="submit" value="Opslaan" name="submit" /> <br><br>
</form>
</vradres>

<br>
<?php
//if(isset($_SESSION["data"]) && !empty($_SESSION["cart"])){
//foreach ($_SESSION["data"] as $key => $aantal) {
//    $vrn = $_POST['voornaam'];
//    $act = $_POST['achternaam'];
//    $email = $_POST['email'];
//    $adres= $_POST['adres'];
//    $wo = $_POST['woonplaats'];
//    $tel = $_POST['tel'];
//}}
?>

</html>
