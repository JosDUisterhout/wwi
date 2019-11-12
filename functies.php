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

    $sql = "SELECT * FROM stockitems WHERE StockItemName LIKE '%$zoek%' or SearchDetails LIKE '%$zoek%' or StockItemId = '$zoek'";

//    var_dump(mysqli_query($conn, $sql));
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

function productenLijst($limit){

    $conn = db_connect();

    $sql = "SELECT StockItemName FROM stockitems LIMIT " . "$limit";



<<<<<<< Updated upstream
    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

}
=======
>>>>>>> Stashed changes
