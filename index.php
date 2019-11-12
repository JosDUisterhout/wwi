<?php

include('includes.php');

//if(isset($_GET['submit'])){
//
//    if(isset($_GET['afd']) AND isset($_GET['functie'])){
//        $nummer = $_GET['afd'];
//        $functie = $_GET['functie'];
//    }
//
////    $medewerkers = selectQuery($nummer, $functie);
//
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <form method="get">
        <input type="text" name="zoek" placeholder="Zoeken" />
        <input type="submit" name="submit" />
    </form>

    <table>
        <?php
        if(isset($_GET['submit'])) {
            $zoek = $_GET["zoek"];
            zoekProduct($zoek);
        }
        ?>
    </table>
</body>
</html>

