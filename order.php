<?php
include('include.php');
?>
<center>
<br><br>
<h1>Gelukt! bedankt voor uw betaling</h1>
<h2>Factuur</h2><a  href="betaal.php" class=""><i<i class="button">Afronden</i></a>
Dit factuur wordt naar <em></em> <?php echo $_POST["email"]?> verstuurd<br><br>
</center>
<order>

    <center> <h2>Factuur</h2><br></center>

    <orderd>
    <ol>

        <li><em>Naam:</em> <?php echo $_POST["voornaam"].' '.$_POST["achternaam"]?></li>
        <li><em>Email:</em> <?php echo $_POST["email"]?></li>
        <li><em>Tel:</em> <?php if(isset($_POST["tel"])){echo$_POST["tel"];}?></li>
        ---------Lever adres---------
        <li><em>Adres:</em> <?php echo ($_POST["adres"])?></li>
        <li><em>Woonplaats:</em> <?php echo ($_POST["woonplaats"])?></li>

<!--        <li><em>Stad:</em> --><?php //echo ( $_POST["stad"])?><!--</li>-->
<!--        <li><em>Ophaalpunt:</em> --><?php //echo ( $_POST["waar"])?><!--</li>-->

    </ol>
        </orderd>















</order>


















<br>



<!--<a href="index.php" class="center"><i<i class="button">Terug naar Home</i></a>-->
