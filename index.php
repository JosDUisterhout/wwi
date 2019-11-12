<?php

include('includes.php');

if(isset($_GET['submit'])){

    if(isset($_GET['afd']) AND isset($_GET['functie'])){
        $nummer = $_GET['afd'];
        $functie = $_GET['functie'];
    }

    $medewerkers = selectQuery($nummer, $functie);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form>
    afdeling<input type="text" name="afd"><br>
    functie <input type="text" name="functie"><br>
    <input type="submit" name="submit">
</form>

    <table>
        <?php
        if(isset($_GET['submit'])) {
            print("<tr>");
            foreach ($medewerkers[0] as $key => $value) {
                print("<th>$key</th>");
            }
            print("</tr>");

            foreach ($medewerkers as $medewerker => $gegevens) {

                print("<tr>");
                foreach ($gegevens as $key => $value) {
                    print("<td>$value</td>");
                }
                print("</tr>");
            }
        }
        ?>
    </table>
</body>
</html>

