<?php
include('include.php');

global $producten;
global $categorieen;
if(isset($_GET['aantal'])){
    $max = 30 * $_GET['perPagina'];
}
else{$max = 30;}

if(isset($_GET['paginaNummer'])){

    foreach($_GET['paginaNummer'] as $pnr){


    $huidigeLijst = array_slice($producten, ($pnr -1) * $max, $max);


}
}
else{
    $huidigeLijst = array_slice($producten, 0, $max);

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

        <button class="btn active" >Overzicht</button>
        <?php foreach($categorieen as $categorie){
            print("<button class=\"btn active\" type=\"submit\" name=\"categorieen[]\" value=\"" . $categorie['StockGroupName'] . "\" >" .  $categorie['StockGroupName'] . "</button>");
        } ?>

    </form>
</div>

<form id="nummering" style = "background-image : linear-gradient(rgba(95,16,16,0.98), #3a0a0a)">
    <?php

    $aantal = aantalPaginas(count($producten), $max);
    $huidig = 0;

    while($huidig < $aantal){

        $huidig++;
        print("<button class='pagina-buttons' type='submit' name='paginaNummer[]' value='" . $huidig ."'>" . $huidig . "</button>");
    }

    ?>

</form>

<form style = "background-image : linear-gradient(#3a0a0a, black)">
    <select class="pagina-opslaan"  name="perPagina" class = 'btn active'>
        <option value="1"><?php print(30)?></option>
        <option value="2"><?php print(60)?></option>
        <option value="3"><?php print(90)?></option>
    </select>

    <input class= 'pagina-opslaan' name="aantal" value="opslaan" type="submit">
</form>

<div class="grid-container">
    <?php
        foreach($huidigeLijst as $product){
            $id = $product["StockItemID"];
            $foto = $product["Photo"];
            $naam = $product['StockItemName'];
            echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';">Product ' .  $naam  . "
                  <img src='plaatjeswwi/id$id.jpg' class='grid-picture' onerror='this.src=\"plaatjeswwi/default.jpg\"'>" .'<br></div>');
        }
    ?>
</div>

<form id="nummering">
    <?php

    $aantal = aantalPaginas(count($producten), $max);
    $huidig = 0;

    while($huidig < $aantal){

           $huidig++;
           print("<button class='pagina-buttons' type='submit' name='paginaNummer[]' value='" . $huidig ."'>" . $huidig . "</button>");
       }

    ?>
</form>



</body>
</html>
