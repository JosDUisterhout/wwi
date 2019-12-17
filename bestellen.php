<?php
include('include.php');
$vrnm = "";
$atnm = "";
$eml = "";
$adr = "";
$pstc = "";
$wnp = "";
$tlf = "";
if (isset($_SESSION['gebruikersnaam'])) {
    $test = bestelinlog($_SESSION['gebruikersnaam']);
    $vrnm = $test[0]['voornaam'];
    $atnm = $test[0]['achternaam'];
    $eml = $test[0]['email'];
    $adr = $test[0]['adres'];
    $pstc = $test[0]['postcode'];
    $wnp = $test[0]['woonplaats'];
    $tlf = $test[0]['telefoon'];
}
    ?>


<html>
<a  href="afhalen.php" class="afhaal"><i<i class="button">Ophaalpunt</i></a>
<form action="order.php" method="post" >
<vradres>
<br>
        lever adres <br>
        <label> <input type="text" name="voornaam"placeholder="Voornaam" required> </label><br>
        <label> <input type="text" name="achternaam"placeholder="achternaam"  required></label><br>
        <label> <input type="text" name="email"placeholder="Email" required  ></label><br>
        <label> <input type="text" name="adres"placeholder="Adres" required  > </label><br>
    <label> <input type="text" name="postcode"placeholder="Postcode" required > </label><br>
        <label> <input type="text" name="woonplaats"placeholder="Woonplaats" required  ></label><br>
        <label> <input type="text" name="tel"placeholder="Telefoon"  > </label><br>
    <input type="hidden" name="form_submitted" value="1" />
    <br>
    <br>
    <br>
    <center>
        <h1>leveradres</h1>
        <br>
        login met uw WWI acount of vul uw gegevens in voor een bezorgadres/ophaalpunt
        <br></center><br>
    <!DOCTYPE html>

    <a href="afhalen.php" class="afhaal"><i<i class="button">Ophaalpunt</i></a>
    <form action="order.php" method="post">
        <vradres>
            <br>
            lever adres <br>
            <label> <input type="text" name="voornaam" placeholder="Voornaam" value="<?php print($vrnm) ?>" required> </label><br>
            <label> <input type="text" name="achternaam" placeholder="achternaam" value="<?php print($atnm) ?>"  required></label><br>
            <label> <input type="text" name="email" placeholder="Email" value="<?php print($eml) ?>"  required></label><br>
            <label> <input type="text" name="adres" placeholder="Adres" value="<?php print($adr) ?>"  required> </label><br>
            <label> <input type="text" name="postcode" placeholder="Postcode" value="<?php print($pstc) ?>"  required> </label><br>
            <label> <input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php print($wnp) ?>"  required></label><br>
            <label> <input type="text" name="tel" value="<?php print($tlf) ?>"  placeholder="Telefoon"> </label><br>
            <input type="hidden" name="form_submitted" value="1"/>
            <br>
            <br>
            <input type="submit" value="Opslaan" name="submit"/> <br><br>
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
