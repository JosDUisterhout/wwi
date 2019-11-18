<?php
function db_connect(){

    global $host;
    global $user;
    global $pass;
    global $databasename;
    global $port;

    return mysqli_connect($host, $user, $pass, $databasename, $port);

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

    if($validate){
        $sql = "SELECT * FROM stockitems WHERE StockItemName LIKE '%$zoek%' or SearchDetails LIKE '%$zoek%' or StockItemId = '$zoek'";
        return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    }else{
        $sql = "SELECT * FROM stockitems LIMIT 25";

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
        print("voer iets fatsoenlijks in");
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

