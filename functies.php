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

    $sql = "SELECT StockItemName, StockGroupID FROM stockitems SI JOIN stockitemstockgroups SISG ON SI.StockItemID = SISG.StockItemID";

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

function categorieLijst(){

    $conn = db_connect();

    $sql = "SELECT StockGroupName, StockGroupID FROM stockgroups";
    
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}
function categorieClothing($categorie)
{

    $conn = db_connect();

    $sql = "select distinct StockGroupName, StockItemName from stockgroups SG JOIN stockitemstockgroups SISG ON SG.StockGroupID = SISG.StockGroupID JOIN stockitems SI ON SI.StockItemID = SISG.StockItemID WHERE StockGroupName = " . $categorie ." ORDER BY StockGroupName, StockItemName;";
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

