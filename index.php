<?php
include('include.php');

global $producten;
global $categorieen;

$startPerPagina = 30;


if(isset($_GET['paginaNummer'])){

    foreach($_GET['paginaNummer'] as $pnr){

        $_SESSION['paginaNummer'] = $pnr;
    }
}



if(isset($_GET['aantal'])){
    $_SESSION['perPagina'] = $startPerPagina * $_GET['perPagina'];
    $_SESSION['paginaNummer'] = 1;

}
if(!isset($_SESSION['perPagina'])){$_SESSION['perPagina'] = 30;}


$max = $_SESSION['perPagina'];


if(isset($_SESSION['paginaNummer']) AND $_SESSION['paginaNummer'] != 1){
    $huidigeLijst = array_slice($producten, ($_SESSION['paginaNummer'] -1) * $max, $max);
}
elseif(!isset($_SESSION['paginaNummer']) OR $_SESSION['paginaNummer'] == 1){


    $huidigeLijst = array_slice($producten, 0, $max);
    $_SESSION['paginaNummer'] = 1;



}




?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>


<div id="zoek"  class="hero-image">
    <div class="hero-text">
        <h1>WWI</h1>


    </div>
</div>

<div class="m0a">
    <form action="" style = "background-image : linear-gradient(rgb(137, 18, 17), rgba(95,16,16,0.98))">

        <button class="btn active" type="submit" name="categorieen[]" value="overzicht" >Overzicht
        <?php foreach($categorieen as $categorie){
            print("<button class=\"btn active\" type=\"submit\" name=\"categorieen[]\" value=\"" . $categorie['StockGroupName'] . "\" >" .  $categorie['StockGroupName'] . "</button>");
        } ?>

    </form>
</div>



<form id="nummering" style = "background-image : linear-gradient(rgba(95,16,16,0.98), #3a0a0a)">
    <?php

    $aantal = aantalPaginas(count($producten), $max);
    $huidig = 0;

    if($aantal > 1){

    while($huidig < $aantal){

        $huidig++;
        print("<button class='pagina-buttons' type='submit' name='paginaNummer[]' value='" . $huidig ."'>" . $huidig . "</button>");
    }
    }


    ?>

</form>

<form style = "background-image : linear-gradient(#3a0a0a, black)">
    <select class="pagina-opslaan"  name="perPagina" class = "btn active">
        <option value="1"><?php print(30)?></option>
        <option value="2"><?php print(60)?></option>
        <option value="3"><?php print(90)?></option>
    </select>

    <input class= "pagina-opslaan" name="aantal" value="opslaan" type="submit">
</form>

<div class="grid-container">
    <?php

        foreach($huidigeLijst as $product){
            $id = $product["StockItemID"];
            $foto = $product["Photo"];
            $naam = $product['StockItemName'];
            $vooraad = $product["QuantityOnHand"];
            $productPrijs = $product['RecommendedRetailPrice'];
            echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' .  $naam  . "
                  <img src='plaatjeswwi/id$id.jpg' onerror='this.src=\"plaatjeswwi/default.jpg\"'>" .'<br>');

            if ($vooraad >= 100000) {
                print ("Voorraad status: Ruim op vooraad");
            } elseif
            ($vooraad >= 20000) {
                print ("Voorraad status: Op vooraad");
            } elseif
            ($vooraad <= 100) {
                print ("Voorraad status: Schaars");
            } elseif
            ($vooraad == 0) {
                print ("Voorraad status: Niet op vooraad");
            }
            print (" <br> ");
            print(" € ".ceil($productPrijs). " euro" . "<br>".'</div>');
        }




    ?>

</div>

<form id="nummering">
    <?php

    $aantal = aantalPaginas(count($producten), $max);
    $huidig = 0;

    if($aantal > 1){

    while($huidig < $aantal){

           $huidig++;
           print("<button class='pagina-buttons' type='submit' name='paginaNummer[]' value='" . $huidig ."'>" . $huidig . "</button>");
       }
    }
    ?>
</form>



</body>
</html>
