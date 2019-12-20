<?php
include('include.php');

global $producten;
global $categorieen;
global $startPerPagina;

if(isset($_POST['Pay'])){
    bestellingbetalen();
}

verwerkPaginaNR();

perPagina($startPerPagina);

$max = $_SESSION['perPagina'];

$huidigeLijst = laadPagina($producten);


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
    <form action="" class="achtergrond1">

        <button class="btn active" type="submit" name="categorieen[]" value="overzicht" >Overzicht
            <?php foreach($categorieen as $categorie){
                print("<button class=\"btn active\" type=\"submit\" name=\"categorieen[]\" value=\"" . $categorie['StockGroupName'] . "\" >" .  $categorie['StockGroupName'] . "</button>");
            } ?>

    </form>
</div>



<form id="nummering" class="achtergrond2">
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

<form class="achtergrond3" <?php if(count($producten) <= 30){print("display:none");}?>">
    <select class="pagina-opslaan" style="<?php if(count($producten) <= 30){print("display:none");}?>"  name="perPagina" class = "btn active">

        <?php
        for($i = 1; $i <= 3; $i++){
            $select = $startPerPagina * $i;
            if($select == $_SESSION['perPagina']){$actief = "selected=\"selected\"";}
            else{$actief = "";}
            print("<option $actief value=\"$select\">$select</option>");
        }
        ?>
    </select>

    <input style="<?php if(count($producten) <= 30){print("display:none");}?>" class= "pagina-opslaan" name="aantal" value="opslaan" type="submit">
</form>

<div class="grid-container">
    <?php
    foreach($huidigeLijst as $product){
        $id = $product["StockItemID"];
        $foto = $product["Photo"];
        $naam = $product['StockItemName'];
        $vooraad = $product["QuantityOnHand"];
        $productPrijs = $product['RecommendedRetailPrice'] * $product['DiscountAmount'];
        echo('<div class="grid-item" onclick="location.href=\'producten.php?id=' . $id . '\';"> ' .  $naam  . " 
                  <img class='fancy-image-index' src='plaatjeswwi/id$id.jpg' onerror='this.src=\"plaatjeswwi/default.jpg\"'>" .'<br>');
        print("<div class='grid-text'>");
        print(checkVooraad($vooraad));
        print (" <br> ");
        print(" € ".round($productPrijs, 2). " euro" . "<br>".'</div></div>');
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
<form method="post">
    <input type="submit" class="button" name="spring" value="insert" style="display: none"  />

</form><?php
if(isset($_POST['spring'])) {
print("<br> <br> <br> test");

print("<style type='text/css'>.hero-image{ background-image: linear-gradient(rgba(152,152,152,0.5), rgba(16,200,118,0.66)), url(springsale.jpg);

        /* Set a specific height */
        height: 60%;



        /* Position and center the image to scale nicely on all screens */
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        background-size: 100% 100%;
        margin-top: 40px;
        max-width: 100%;
    }
    .btn:hover{
    background-color: #4b9d84;
    color: #39cbf9;
}

/*.btn.active {*/
/*    background-color: #6c1120;*/
/*    color: white;*/
/*}*/


.grid-container {
    display: grid;
    /*grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));*/
    background-color: rgb(0,0,0);
    background-image: linear-gradient(#52e5ae, white);
    padding: 10px;
}

.grid-item {
    background-color:  rgb(255, 255, 255);

    border: 1px solid rgba(0, 0, 0, 0.8);
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    position: relative;
    padding: 20px 20px 60px;

}
.grid-text{
    position: absolute;
    bottom: 20px;
    width: calc(100% - 40px);
}

.grid-picture{
    max-heigt: 100%;
    max-width: 100%;
}
.grid-item:hover{
    opacity:90%;
    box-shadow: 5px 10px 5px #39ff70;
}
.grid-item > img{
    transition: transform 0.4s;
}

.grid-item:hover > img{
    -webkit-transform: scale(0.9);
}

.topnav {
    overflow: hidden;
    background-color: black;
    /*opacity: .4;*/
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1;
}

.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav-winkelwagen {
    padding: 8px 16px !important;
}

.topnavright {
    float: right !important;
}

.topnav a:hover {
    background-color: #ddd;
    color: black;
}

.topnav a.active {
    background-color: #39cbf9;
    color: white;
}

.topnav .icon {
    display: none;
}


.topnav-icon{
    font-size: 1em !important;
}

.fa-stack[data-count]:after{
    position:absolute;
    right:0%;
    top:0%;
    content: attr(data-count);
    font-size:40%;
    padding:.6em;
    border-radius:999px;
    line-height:.75em;
    color: #06a884;
    text-align:center;
    min-width:1em;
    font-weight:bold;
    background: white;
    border-style:solid;
}
.fa-circle {
    color: transparent;
}
.achtergrond1{
    background-image : linear-gradient(rgb(45, 212, 92), rgba(50, 110, 201, 0.98));
}
.achtergrond2{
    background-image : linear-gradient(rgba(50, 110, 201, 0.98), #0a193a);
}
.achtergrond3{
    background-image : linear-gradient(#0a193a, #52e5ae);
}
.btn {
    border: 1px solid #9f9f9f;
    outline: none;
    padding: 12px 16px;
    background-color: #f6ff96;
    cursor: pointer;
    -webkit-transition-duration: 0.1s;
    transition-delay: 0.1s;
    color: #9f9f9f;
}
</style>");
}
?>
</body>
</html>
