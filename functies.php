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

    $sql = "SELECT * FROM stockitems JOIN stockitemholdings USING (StockItemID) WHERE stockItemID = $id";

    return mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
}

function getOneProductById($id){

    $rows = productenItem($id);
    return array_pop($rows);
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
            $_SESSION["cart"][$id] = $aantal;

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

function verwerkPaginaNR(){
    if(isset($_GET['paginaNummer'])){

        foreach($_GET['paginaNummer'] as $pnr){

            $_SESSION['paginaNummer'] = $pnr;
        }
    }
}

function laadPagina($producten){

    $max = $_SESSION['perPagina'];

    if(isset($_SESSION['paginaNummer']) AND $_SESSION['paginaNummer'] != 1){
        return array_slice($producten, ($_SESSION['paginaNummer'] -1) * $max, $max);
    }
    elseif(!isset($_SESSION['paginaNummer']) OR $_SESSION['paginaNummer'] == 1){

        $_SESSION['paginaNummer'] = 1;
        return array_slice($producten, 0, $max);

    }
    else{return false;}
}

function perPagina($startPerPagina){

    if(isset($_GET['aantal']) AND isset($_GET['perPagina'])){
        $_SESSION['perPagina'] = $_GET['perPagina'];
        $_SESSION['paginaNummer'] = 1;

    }
    if(!isset($_SESSION['perPagina'])){$_SESSION['perPagina'] = $startPerPagina;}
}

function redirect($url){
    header("Location: $url");
}
