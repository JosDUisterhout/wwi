<?php
function db_connect()
{

    global $host;
    global $user;
    global $pass;
    global $databasename;
    global $port;

    $conn = mysqli_connect($host, $user, $pass, $databasename, $port);

    mysqli_set_charset($conn, 'utf8mb4');

    return $conn;


}

function testQueryAantal($huidigeLijst)
{
    print("<BR><BR><BR>");
    var_dump(count($huidigeLijst));
}

function sessieTest($huidigeLijst)
{
    print("<BR><BR><BR>");
    var_dump($huidigeLijst);
}

function db_exec($stmt, $conn)
{

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    mysqli_close($conn);

    print_r(mysqli_fetch_all($result, MYSQLI_ASSOC));

}

//function selectQuery($nummer, $functie){
//$conn = db_connect();
//
//$stmt = mysqli_prepare($conn,"SELECT naam, functie, afd FROM Medewerker WHERE afd=? AND functie=?");
//
//mysqli_stmt_bind_param($stmt, 'is', $nummer, $functie);
//
//return db_exec($stmt, $conn);
//}

function zoekProduct($zoek)
{

    $conn = db_connect();
    $validate = valideerZoeken($zoek);

    $pieces = explode(" ", $zoek);

    if ($validate)
    {
        foreach ($pieces as $piece)
        {
            $sqlnaam[] = "i.StockItemName LIKE '%" . $piece . "%'";
            $sqldetails[] = "i.SearchDetails LIKE '%" . $piece . "%'";
            $sqlid[] = "i.StockItemId LIKE '%" . $piece . "%'";
        }

        $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID WHERE " . implode(" AND ", $sqlnaam) . " or " . implode(" AND ", $sqldetails) . " or " . implode(" OR ", $sqlid);

        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);


    } else
    {
        $sql = "SELECT * FROM stockitems";

        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    }
}

function productenLijst()
{

    $conn = db_connect();

    $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID";


    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}

function valideerZoeken($zoek)
{

    $validate = true;
    if (strpos($zoek, "'") !== false || strpos($zoek, "\\") !== false || strpos($zoek, ";") !== false)
    {
        print("<h1 class='alert'>Uw product word niet door ons geleverd</h1>");
        $validate = false;
    }

    return $validate;
}

function productenItem($id)
{
    $conn = db_connect();

    $sql = "SELECT * FROM stockitems JOIN stockitemholdings USING (StockItemID) WHERE stockItemID = $id";

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

function getOneProductById($id)
{

    $rows = productenItem($id);

    return array_pop($rows);
}

function categorieLijst()
{

    $conn = db_connect();

    $sql = "SELECT StockGroupName, StockGroupID FROM stockgroups WHERE StockGroupID IN (SELECT StockGroupID FROM stockitemstockgroups)";

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}

function categorieClothing($categorie)
{

    $conn = db_connect();

    $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID WHERE i.StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID IN(SELECT StockGroupID FROM stockgroups WHERE StockGroupName = '" . $categorie . "'))";


    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

function aantalPaginas($aantal, $perPagina)
{


    $perPagina = intval($perPagina);

    return ceil($aantal / $perPagina);
}

function toevoegenProductWinkelmand($id, $aantal, $toevoegen)
{
    if ($toevoegen)
    {

        $_SESSION["cart"][$id] = $aantal;

    }
}

function verwijdenProductWinkelwagen($id)
{
    if (isset($_SESSION["cart"]))
    {
        unset($_SESSION["cart"][$id]);
    }
}

function toevoegenProductVerlanglijst($id, $toevoegen)
{

    if ($toevoegen)
    {
        if (isset($_SESSION["verlanglijst"]))
        {
            if ( ! in_array($id, $_SESSION["verlanglijst"]))
            {
                $array1 = $_SESSION["verlanglijst"];
                $array2 = [$id];
                $_SESSION["verlanglijst"] = array_merge($array1, $array2);
            }
        } else
        {
            $_SESSION["verlanglijst"] = [$id];
        }
    }
}

function verwijdenProductVerlanglijst($id)
{
    if (isset($_SESSION["verlanglijst"]))
    {
        if (in_array($id, $_SESSION["verlanglijst"]))
        {
            $key = array_search($id, $_SESSION["verlanglijst"]);
            unset($_SESSION["verlanglijst"][$key]);
        }
    }
}

function utf8($text)
{
    return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
}

function vooraad($ID)
{

    $conn = db_connect();

    $sql = "SELECT h.QuantityOnHand FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID where i.StockItemID = " . $ID;

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}


function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function verwerkPaginaNR()
{
    if (isset($_GET['paginaNummer']))
    {

        foreach ($_GET['paginaNummer'] as $pnr)
        {

            $_SESSION['paginaNummer'] = $pnr;
        }
    }
}

function laadPagina($producten)
{

    $max = $_SESSION['perPagina'];

    if (isset($_SESSION['paginaNummer']) AND $_SESSION['paginaNummer'] != 1)
    {
        return array_slice($producten, ($_SESSION['paginaNummer'] - 1) * $max, $max);
    } elseif ( ! isset($_SESSION['paginaNummer']) OR $_SESSION['paginaNummer'] == 1)
    {

        $_SESSION['paginaNummer'] = 1;

        return array_slice($producten, 0, $max);

    } else
    {
        return false;
    }
}

function perPagina($startPerPagina)
{

    if (isset($_GET['aantal']) AND isset($_GET['perPagina']))
    {
        $_SESSION['perPagina'] = $_GET['perPagina'];
        $_SESSION['paginaNummer'] = 1;

    }
    if ( ! isset($_SESSION['perPagina']))
    {
        $_SESSION['perPagina'] = $startPerPagina;
    }
}

function redirect($url)
{
    header("Location: $url");
}

// inloggen


function inlog($gebruikersnaam, $wachtwoord)
{

    $wachtwoord = hash('sha256', $wachtwoord);

    $conn = db_connect();

    $sql = "SELECT klantID, gebruikersnaam FROM klanten WHERE gebruikersnaam = '$gebruikersnaam' and wachtwoord = '$wachtwoord'";

    return ((mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC)));

}

//staat naam in db?
function registreergebruikersnaam($gebruikersnaam)
{

    $conn = db_connect();

    $sql = "SELECT klantID FROM klanten WHERE gebruikersnaam = $gebruikersnaam";

    if ( ! mysqli_query($conn, $sql))
    {
        return false;
    } else
    {
        return true;
    }

}

//staat email in db?
function registreeremailadress($emailadres)
{

    $conn = db_connect();

    $sql = "SELECT email FROM klanten WHERE email = $emailadres";


    if ( ! mysqli_query($conn, $sql))
    {
        return false;
    } else
    {
        return true;
    }

}

function registreer($gebruikersnaam, $password, $emailadress, $voornaam, $achternaam, $postcode, $woonplaats, $adres, $telefoon)
{

    $password = hash('sha256', $password);

    $conn = db_connect();

    $sql = "INSERT INTO klanten (gebruikersnaam,wachtwoord,email,voornaam,achternaam,postcode,woonplaats,adres,telefoon) values ('" . $gebruikersnaam . "','" . $password . "','" . $emailadress . "','" . $voornaam . "','" . $achternaam . "','" . $postcode . "','" . $woonplaats . "','" . $adres . "','" . $telefoon . "')";

    mysqli_query($conn, $sql);
}

function emailvalidator($emailadress)
{
    if (preg_match("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,4}$^", $emailadress))
    {
        $geldig = true;
    } else
    {
        $geldig = false;
    }

    return $geldig;
}

function checkVooraad($vooraad)
{
    if ($vooraad >= 100000)
    {
        return ("Voorraad status: Ruim op vooraad");
    } elseif
    ($vooraad <= 100)
    {
        return ("Voorraad status: Schaars");
    } elseif
    ($vooraad == 0)
    {
        return ("Voorraad status: Niet op vooraad");
    } else
    {
        return ("Voorraad status: Op vooraad");
    }
}

function kortingGenerator($prijs)
{
    $kortinggenerator = rand(1, 10);
    switch ($kortinggenerator)
    {
        case 1:
        case 2:
        case 3:
            print("<i class='productenprijs'>€ $prijs</i>");
            break;
        case 4:
        case 5:
        case 6:
            $kortingprijs = number_format($prijs * 0.75, 2, '.', '');
            print("<i class='productenprijs'>€ $kortingprijs</i><br>");
            print("<div class='kortingtekst'>Adviesprijs: <strike>€$prijs</strike></div>");
            print("<div class='kortingtekstbottom'>Je bespaart 25%!</div>");
            break;
        case 7:
        case 8:
            $kortingprijs = number_format($prijs * 0.5, 2, '.', '');
            print("<i class='productenprijs'>€ $kortingprijs</i><br>");
            print("<div class='kortingtekst'>Adviesprijs: <strike>€$prijs</strike></div>");
            print("<div class='kortingtekstbottom'>Je bespaart 50%!</div>");
            break;
        case 9:
            $kortingprijs = number_format($prijs * 0.35, 2, '.', '');
            print("<i class='productenprijs'>€ $kortingprijs</i><br>");
            print("<div class='kortingtekst'>Adviesprijs: <strike>€$prijs</strike></div>");
            print("<div class='kortingtekstbottom'>Je bespaart 65%!</div>");
            break;
        case 10:
            $kortingprijs = number_format($prijs * 0.2, 2, '.', '');
            print("<i class='productenprijs'>€ $kortingprijs</i><br>");
            print("<div class='kortingtekst'>Adviesprijs: <strike>€$prijs</strike></div>");
            print("<div class='kortingtekstbottom'>Je bespaart 80%!</div>");
            break;
    }
}

function bestelling($post)
{
    $voornaam = $post["voornaam"];
    $achternaam = $post["achternaam"];
    $email = $post["email"];
    $tel = $post["tel"];
    $adres = $post["adres"];
    $postcode = $post["postcode"];
    $woon = $post["woonplaats"];

    if (isset($post['submit']))
    {
        $sql = "INSERT INTO klanten (voornaam,achternaam,email,adres,woonplaats,telefoon,postcode) values ('" . $voornaam . "','" . $achternaam . "','" . $email . "','" . $adres . "','" . $woon . "','" . $tel . "','" . $postcode . "')";
        $conn = db_connect();
        if (mysqli_query($conn, $sql))
        {

            $sql = "SELECT klantID FROM klanten WHERE email = '$email'";
            $klantID = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
            bestellingorder($klantID[0]['klantID']);

            return true;
        } else
        {
            $sql = "SELECT klantID FROM klanten WHERE email = '$email'";
            $klantID = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
            bestellingorder($klantID[0]['klantID']);

            return false;
        }
    }


}


function bestellingorder($klantID)
{

    if (isset($_SESSION["cart"]) && ! empty($_SESSION["cart"]))
    {
        $datum = date("Y/m/d");
        $sql = "INSERT INTO bestellingen (klantID, datum) values ('" . $klantID . "','" . $datum . "')";
        $conn = db_connect();
        mysqli_query($conn, $sql);
        $bestellingID = mysqli_insert_id($conn);
        $_SESSION['orderNR'] = $bestellingID;
        foreach ($_SESSION["cart"] as $key => $aantal)
        {
            $product = productenItem($key);
            $productID = $product[0]['StockItemID'];
            $_SESSION['klantID'] = $klantID;
            $sql = "INSERT INTO bestellinglines (stockItemID, bestellingID, aantal) values ('" . $productID . "','" . $bestellingID . "','" . $aantal . "')";
            mysqli_query($conn, $sql);
        }
    }
}

function bestellingbetalen()
{
    if (isset($_SESSION["cart"]) && ! empty($_SESSION["cart"]))
    {
        $klant = $_SESSION['klantID'];
        $orderNR = $_SESSION['orderNR'];
        $sql = "UPDATE bestellingen
                    SET betaalt = 1
                    WHERE klantID = $klant AND bestellingID = $orderNR";
        $conn = db_connect();
        mysqli_query($conn, $sql);

        foreach ($_SESSION["cart"] as $key => $aantal)
        {
            $sql = "UPDATE stockitemholdings
                    SET QuantityOnHand = QuantityOnHand-$aantal
                    WHERE stockItemID = $key";
            mysqli_query($conn, $sql);
        }
        unset($_SESSION['cart']);
        header("location: index.php");
    }
}


function getBestelling($id)
{
    $conn = db_connect();

    $sql = "  SELECT bestellingID, datum
              FROM bestellingen
              WHERE klantID = $id AND betaalt = 1";

    return ((mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC)));
}

function getBestellingLines($orderID)
{
    $conn = db_connect();

    $sql = "  SELECT B.stockItemID, sum(aantal) AS totaalAantal, sum(RecommendedRetailPrice*aantal*DiscountAmount)  AS totaalPrijs
              FROM bestellinglines B JOIN stockitems S on S.stockItemID = B.stockItemID
              WHERE bestellingID = $orderID;";

    return ((mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC)));
}

function factuurItems($orderID)
{
    $conn = db_connect();

    $sql = "  SELECT *
              FROM bestellinglines B JOIN stockitems S on S.stockItemID = B.stockItemID
              WHERE bestellingID = $orderID;";

    return ((mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC)));
}


// automatisch inloggen

function bestelvoornaam($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT voornaam from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function bestelachternaam($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT achternaam from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function bestelemail($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT email from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function besteladres($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT adres from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function bestelpostcode($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT postcode from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function bestelwoonplaats($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT woonplaats from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function besteltelefoon($gebruiksersnaam)
{
    $conn = db_connect();

    $sql = "SELECT telefoon from klanten where gebruikersnaam = $gebruiksersnaam ";

    return mysqli_query($conn, $sql);
}

function bestelinlog($gebruiker)
{
    $conn = db_connect();

    $sql = "SELECT * FROM klanten where gebruikersnaam = '$gebruiker'";

    $test = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

    return $test;
}