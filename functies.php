<?php
function db_connect(){

    global $host;
    global $user;
    global $pass;
    global $databasename;
    global $port;

    $conn = mysqli_connect($host, $user, $pass, $databasename, $port);

    mysqli_set_charset($conn, 'utf8mb4');

    return $conn;


}

function testQueryAantal($huidigeLijst){
    print("<BR><BR><BR>");
    var_dump(count($huidigeLijst));
}

function sessieTest($huidigeLijst){
    print("<BR><BR><BR>");
    var_dump($huidigeLijst);
}

function db_exec ($stmt, $conn){

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    mysqli_close($conn);

    print_r( mysqli_fetch_all($result, MYSQLI_ASSOC));

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

function zoekProduct($zoek){

    $conn = db_connect();

    $validate = valideerZoeken($zoek);

    $pieces = explode(" ", $zoek);

    if($validate){
        foreach($pieces as $piece) {
            $sqlnaam[] = "i.StockItemName LIKE '%" . $piece . "%'";
            $sqldetails[] = "i.SearchDetails LIKE '%" . $piece . "%'";
            $sqlid[] = "i.StockItemId LIKE '%" . $piece . "%'";
        }

            $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID WHERE " . implode(" AND ", $sqlnaam) . " or " . implode(" AND ", $sqldetails) . " or " . implode(" OR ", $sqlid);
            return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);


    }else{
        $sql = "SELECT * FROM stockitems";

        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    }
}

function productenLijst(){

    $conn = db_connect();

    $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID";


    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}

function valideerZoeken($zoek){

    $validate = true;
    if(strpos($zoek, "'") !== false || strpos($zoek, "\\") !== false || strpos($zoek, ";") !== false){
        print("<h1 class='alert'>Uw product word niet door ons geleverd</h1>");
        $validate = false;
    }
    return $validate;

}

function productenItem($id){
    $conn = db_connect();

    $sql = "SELECT * FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID WHERE i.stockItemID = $id";

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
//                $result = mysqli_query($conn, $sql);

//                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
//                    $naam = $row["RecommendedRetailPrice"];
//                    print("€ ".ceil($naam). " euro" . "<br>");
//                }
}

function categorieLijst(){

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

function aantalPaginas($aantal, $perPagina){

    $perPagina = intval($perPagina);

 return ceil($aantal/$perPagina);
}

function toevoegenProductWinkelmand($id, $aantal, $toevoegen){
    if($toevoegen){


        if(isset($_SESSION["cart"])){
            if(!in_array($_POST['productID'], $_SESSION["cart"]))
            {
                echo "dat";
                $_SESSION["cart"][$id] = $aantal;
            }else{
                echo "dsa";
            }

        }else{
            $_SESSION["cart"][$id] = $aantal;
        }
    }
}

function verwijdenProductWinkelwagen($id){
    if(isset($_SESSION["cart"])){
        unset($_SESSION["cart"][$id]);
    }
}

function toevoegenProductVerlanglijst($id, $toevoegen){

    if($toevoegen){
        if(isset($_SESSION["verlanglijst"])){
            if (!in_array($id, $_SESSION["verlanglijst"])) {
                $array1 = $_SESSION["verlanglijst"];
                $array2 = array($id);
                $_SESSION["verlanglijst"] = array_merge($array1, $array2);
            }
        }else{
            $_SESSION["verlanglijst"] = array($id);
        }
    }
}

function verwijdenProductVerlanglijst($id){
    if(isset($_SESSION["verlanglijst"])){
        if (in_array($id, $_SESSION["verlanglijst"])) {
            $key = array_search($id, $_SESSION["verlanglijst"]);
            unset($_SESSION["verlanglijst"][$key]);
        }
    }
}

function utf8($text){
    return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
}

function vooraad($ID){

    $conn = db_connect();

    $sql = "SELECT h.QuantityOnHand FROM stockitems as i join stockitemholdings as h on i.StockItemID=h.StockItemID where i.StockItemID = "  . $ID;

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}



function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

