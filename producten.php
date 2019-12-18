<?php
include('include.php');
//huidig product
$product = productenItem($_GET['id']);
$productID = $product[0]['StockItemID'];
$productNaam = $product[0]['StockItemName'];
$productPrijs = $product[0]['RecommendedRetailPrice'];
$productdails = $product[0] ["SearchDetails"];
$productid = $product[0]['StockItemID'];
$vooraad = $product[0]['QuantityOnHand'];


//
//$groepID = groepID($productID);




$producten = productenLijst();

$reproduct1= rand(1, count(productenLijst())) -1;
$reproduct2= rand(1, count(productenLijst())) -1;
$reproduct3= rand(1, count(productenLijst())) -1;
$rePrijs1 = number_format($producten[$reproduct1-1]['RecommendedRetailPrice'] * $producten[$reproduct1-1]['DiscountAmount'], 2, '.', '' );
$rePrijs2 = number_format($producten[$reproduct2-1]['RecommendedRetailPrice'] * $producten[$reproduct2-1]['DiscountAmount'], 2, '.', '' );
$rePrijs3 = number_format($producten[$reproduct3-1]['RecommendedRetailPrice'] * $producten[$reproduct3-1]['DiscountAmount'], 2, '.', '' );
$reNaam1 = $producten[$reproduct1-1]['StockItemName'];
$reNaam2 = $producten[$reproduct2-1]['StockItemName'];
$reNaam3 = $producten[$reproduct3-1]['StockItemName'];

<<<<<<< HEAD
//huidig product
$product = productenItem($_GET['id']);
$productID = $product[0]['StockItemID'];
$productNaam = $product[0]['StockItemName'];
$prijsVoorKorting = $product[0]['RecommendedRetailPrice'];
$kortingTekst = 100 - ($product[0]['DiscountAmount'] * 100);
$productPrijs = number_format($product[0]['RecommendedRetailPrice'] * $product[0]['DiscountAmount'], 2, '.', '' );
$productdetails = $product[0] ["SearchDetails"];
$productid = $product[0]['StockItemID'];
$vooraad = $product[0]['QuantityOnHand'];
=======

$cel = $product[0]['IsChillerStock'];

$temp = getTemp($_GET['id']);
if (count($temp)) {
    $temperature = $temp[0]['Temperature'];
}else{
    $temperature = 0;
}


>>>>>>> master
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylesheet.css">
<!---->
<!---->
<!--HIER BEGINT DE STYLE------HIER BEGINT DE STYLE------HIER BEGINT DE STYLE------HIER BEGINT DE STYLE-------->
<!---->
<!---->
<style>
    @media screen and (max-width:1250px){
        .container ul li{
            width:40%;
            margin-left: 40px;
        }
</style>
<body>

        <div class="wrapper">
            <!DOCTYPE html>
            <html>
            <meta name="viewport" content="width=device-width, initial-scale=1">


            <style>
                @media screen and (max-width:1250px){
                    .container ul li{
                        width:40%;
                        margin-left: 40px;

                    }
            </style>




            <!---->
            <!---->
            <!--PAGINA INDELING------PAGINA INDELING------PAGINA INDELING------PAGINA INDELING------PAGINA INDELING-->
            <!---->
            <!---->



        <div class="grid-container-producten">






            <div class="grid-item">
                <div class="productNaam">
                    <?php
                    print'<h4>' . $productNaam. '</h4><br>'.'<br>';
                    ?>
                </div>
                <?php

                print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:215% !important;' onclick='openModal();currentSlide(1)' class='productenpaginaplaatje' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                ?>

            </div>
                <div class="grid-item">
                    <?php
                    // print("€ ".round($productPrijs, 2). " euro" . "<br>");
                    //kortingGenerator($productPrijs);
                    print($productdetails);
                    print('<br><br>');
<<<<<<< HEAD
                    if($product[0]['DiscountAmount'] != 1) {
                        print("<i class='productenprijs'>€ $productPrijs</i><br>");
                        print("<div class='kortingtekst'>Adviesprijs: <strike>€ $prijsVoorKorting</strike></div>");
                        print("<div class='kortingtekstbottom'>Je bespaart $kortingTekst%!</div>");
                    } else {
                        print("<i class='productenprijs'>€ $productPrijs</i><br>");
=======
                    kortingGenerator($productPrijs);
                    if($cel == 1) {
                        print("<button <i class=\"fa fa-snowflake-o\"></i> <span class='coolknop'> De temperatuur van dit product is: $temperature °C</span></button>");
>>>>>>> master
                    }
                    ?>

                    <div class="cartbtn">
                        <form method="post" action="verlanglijstje/toevoegenAanWinkelmand.php" class="productenpagina">
                            <input type="hidden" name="productID" value='<?php print($productID);?>'>
                            <input type="hidden" name="productAantal" value='1'>
                            <button type="submit" name="cart" class="button">In winkelmandje</button>
                        </form>
                        <form method="post" action="verlanglijstje/toevoegenAanVerlanglijst.php" class="productenpagina">
                            <input type="hidden" name="productID" value='<?php print($productID);?>'>
                            <input type="hidden" name="productAantal" value='1'>
                            <button type="submit" name="verlanglijst" class="verlanglijst_button"><i class="fa fa-gift"></i> In verlanglijstje</button>
                        </form>
                    </div>
                    <br>

                    <?php
                    $watching = rand(1,50);
                    print(checkVooraad($vooraad));
                    print("<br> <br>");
                    print("Mensen met dit product in hun winkelwagen: $watching")
                    ?>
                    <h2>Specificaties</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas integer eget aliquet nibh praesent tristique magna sit amet. Cras adipiscing enim eu turpis egestas pretium aenean pharetra magna. Risus quis varius quam quisque id diam vel. Fermentum leo vel orci porta non pulvinar neque laoreet. Tristique senectus et netus et malesuada. In nulla posuere sollicitudin aliquam. Cursus eget nunc scelerisque viverra mauris in. Fermentum leo vel orci porta. Ut etiam sit amet nisl purus in mollis. Dui id ornare arcu odio ut sem nulla pharetra. Mauris pharetra et ultrices neque ornare aenean.
                    </p>

                </div>




            <?php
            $default ="<img src='src=plaatjeswwi/default.jpg' style='width:150px' style='width:150px' class='productenpaginaplaatje'>";
            ?>

            <div class="grid-item">
                <h2>Demo</h2>
                <play>
                    <video width="320" height="260" autoplay controls>
                        <source src="USBMissileLauncher.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </play>
            </div>


                        <div class="grid-item"><a href="producten.php?id=<?php echo $reproduct1 ?>" ><?php echo $reNaam1?></a>

                                <?php
                                print("€ ".$rePrijs1. " euro" . "<br>");
                                ?>

                                <?php
                                print("<img src='plaatjeswwi/id$reproduct1.jpg' style='width:100px' style='width:150px' class='productenpaginaplaatje' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                                ?>
                                <div class="cartbtn">
                                    <form method="post" action="" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($reproduct1);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="cart" class="button">In winkelmandje</button>
                                    </form>
                                    <form method="post" action="verlanglijstje/toevoegenAanVerlanglijst.php" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($productID);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="verlanglijst" class="verlanglijst_button"><i class="fa fa-gift"></i> In verlanglijstje</button>
                                    </form>
                                </div></div>
            <div class="grid-item"><a href="producten.php?id=<?php echo $reproduct2 ?>" ><?php echo $reNaam2?></a>

                                <?php
                                print("€ ".$rePrijs2. " euro" . "<br>");
                                ?>

                                <?php
                                print("<img src='plaatjeswwi/id$reproduct2.jpg' style='width:100px' style='width:150px' class='productenpaginaplaatje' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                                ?>
                                <div class="cartbtn">
                                    <form method="post" action="" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($reproduct2);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="cart" class="button">In winkelmandje</button>
                                    </form>
                                    <form method="post" action="verlanglijstje/toevoegenAanVerlanglijst.php" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($productID);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="verlanglijst" class="verlanglijst_button"><i class="fa fa-gift"></i> In verlanglijstje</button>
                                    </form>
                                </div></div>
            <div class="grid-item"> <a href="producten.php?id=<?php echo $reproduct3 ?>" ><?php echo $reNaam3?></a>

                                <?php
                                print("€ ".$rePrijs3. " euro" . "<br>");
                                ?>

                                <?php
                                print("<img src='plaatjeswwi/id$reproduct3.jpg' style='width:100px' style='width:150px' class='productenpaginaplaatje' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                                ?>
                                <div class="cartbtn">
                                    <form method="post" action="" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($reproduct3);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="cart" class="button">In winkelmandje</button>

                                    </form>
                                    <form method="post" action="verlanglijstje/toevoegenAanVerlanglijst.php" class="productenpagina">
                                        <input type="hidden" name="productID" value='<?php print($productID);?>'>
                                        <input type="hidden" name="productAantal" value='1'>
                                        <button type="submit" name="verlanglijst" class="verlanglijst_button"><i class="fa fa-gift"></i> In verlanglijstje</button>
                                    </form>
                                </div></div>
                        </ul>
                    </div>

                </div>





            </div>
            <div id="myModal" class="modal">
                <span class="close cursor" onclick="closeModal()">&times;</span>
                <div class="modal-content">

                    <div class="mySlides">
                        <div class="numbertext">1 / 3</div>
                        <?php
                        print("<img src='plaatjeswwi/id$productid.jpg' style='width:800px; height:800px;' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");
                        ?>
                    </div>

                    <div class="mySlides">
                        <div class="numbertext">2 / 3</div>
                        <play>
                            <video width="100%" height="720" autoplay controls>
                                <source src="USBMissileLauncher.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </play>
                    </div>

                    <div class="mySlides">
                        <div class="numbertext">3 / 3</div>
                        <img src="../wwi/af4.png" style="width:800px">




                    </div>


                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="caption-container">
                    <p id="caption"></p>
                </div>


                <div class="column">
                    <?php
                    print("<img class='demo cursor' src='plaatjeswwi/id$productid.jpg' style='width:100%' onclick='currentSlide(1)' alt='product' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                    ?>
                </div>
                <div class="column">
                    <img class="demo cursor" src="../wwi/af3.png" style="width:100%" onclick="currentSlide(2)" alt="Werking">
                </div>
                <div class="column">

                    <img  class="demo cursor" src="../wwi/af4.png" style="width:100%" onclick="currentSlide(3)" alt="Effect">
                </div>

            </div>
        </div></div>

    <script>

        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            captionText.innerHTML = dots[slideIndex-1].alt;
        }

    </script>
</body>
</html>
