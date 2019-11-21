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
    print('<br><br><br>');
    $pieces = explode(" ", $zoek);
    if($validate){
        foreach($pieces as $piece){
            $sqlnaam[] = "StockItemName LIKE '%".$piece."%'";
            $sqldetails[] = "SearchDetails LIKE '%".$piece."%'";
            $sqlid[] = "StockItemId LIKE '%".$piece."%'";
        }

        $sql = "SELECT * FROM stockitems WHERE ".implode(" AND ", $sqlnaam)." or ".implode(" AND ", $sqldetails)." or ".implode(" OR ", $sqlid);

        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    }else{
        $sql = "SELECT * FROM stockitems";

        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    }
}

function productenLijst(){

    $conn = db_connect();

    $sql = "SELECT * FROM stockitems ";

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

    $sql = "SELECT * FROM stockitems WHERE stockItemID = $id";

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

    $sql = "SELECT * FROM stockitems WHERE StockItemID IN (SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID IN(SELECT StockGroupID FROM stockgroups WHERE StockGroupName = '" . $categorie . "'))";

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

function aantalPaginas($aantal, $perPagina){

 return(ceil($aantal/$perPagina));
}

function toevoegenProductWinkelmand($id, $toevoegen){

//    session_start();
    if($toevoegen){
        if(isset($_SESSION["cart"])){
            if (!in_array($id, $_SESSION["cart"])) {
                $array1 = $_SESSION["cart"];
                $array2 = array($id);
                $_SESSION["cart"] = array_merge($array1, $array2);
            }
        }else{
            $_SESSION["cart"] = array($id);
        }
    }
}

function verwijdenProductWinkelwagen($id){
    if(isset($_SESSION["cart"])){
        if (in_array($id, $_SESSION["cart"])) {
            $key = array_search($id, $_SESSION["cart"]);
            unset($_SESSION["cart"][$key]);
        }
    }
}
function utf8($text){
    return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
}


