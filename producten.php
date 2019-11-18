<?php
include('include.php');

global $producten;

$producten = productenItem($_GET['id']);
$productNaam = $producten[0]['StockItemName'];
$productPrijs = $producten[0]['RecommendedRetailPrice'];
$productdails = $producten[0] ["SearchDetails"];


?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">







<!---->
<!---->
<!--HIER BEGINT DE STYLE------HIER BEGINT DE STYLE------HIER BEGINT DE STYLE------HIER BEGINT DE STYLE-------->
<!---->
<!---->
<style>


    /*    */
    /*    */
    /*STYLE VOOR AFBEELDING EN VERGROOTING------STYLE VOOR AFBEELDING EN VERGROOTING------STYLE VOOR AFBEELDING EN VERGROOTING     */
    /*    */
    /*    */
    body {
        font-family: Verdana, sans-serif;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    .row > .column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;

        margin: auto;
        padding: 0;
        width: 90%;

    }
    .modal-content, img{
        max-width: 1200px;
        max-height:800px;
        min-height: 170px;
        min-width: 450px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
        background-color: black;

    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto

    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    /*    */
    /*    */
    /*HIER BEGINT DE STYLE VOOR DE PAGINA------HIER BEGINT DE STYLE VOOR DE PAGINA------HIER BEGINT DE STYLE VOOR DE PAGINA */
    /*    */
    /*    */


    div.relative {
        position: absolute;
        top: 60px;
        right: 80px;
        width: 200px;
        height: 200px;
        border: 3px solid black;
    }

    div.absolute {
        position: absolute;
        top: 80px;
        right: 330px;
        width: 900px;
        height: 700px;
        border: 48px solid #fff7f7;
        padding: 3px;
    }

    prijs {
        position: absolute;
        top: 15px;
        right: 80px;
        width: 200px;
        height: 200px;
        font-size: 30px;
        color: lawngreen;
        text-shadow: 3px 2px black;
    }

   productnaam  {
        position: absolute;
        top: 15px;
        right: 345px;
        width: 450px;
        height: 50px;
        border: 0px solid black;
       font-size: 20px;
    }

    relatedproduct  {
        position: absolute;
        top: 460px;
        right: 40px;
        width: 800px;
        height: 160px;
        border: 3px solid black;
        font-size: 20px;
    }




    /*    */
    /*    */
    /*    */
    /*    */
    /*    */
</style>



<body>

<h2
<div class="relative">
    <div class="absolute">



    </div>

</div>





</h2>
<!---->
<!---->
<!--PAGINA INDELING------PAGINA INDELING------PAGINA INDELING------PAGINA INDELING------PAGINA INDELING-->
<!---->
<!---->

<div class="absolute">
    <productnaam>
        <?php
        print("$productNaam<br>");
        ?>
    </productnaam>
    <div class="row">
        <div class="column">
            <br><br><br>
            <img src="../wwi/af1.png" style="max-width:100px" onclick="openModal();currentSlide(1)" class="hover-shadow cursor" >

            <!---->
            <!---->
            <!--PRODUCT INVORMATIE------PRODUCT INVORMATIE------PRODUCT INVORMATIE------PRODUCT INVORMATIE-->
            <!---->
            <!---->
            <prijs>

                <?php


                print("€ ".ceil($productPrijs). " euro" . "<br>");
                ?>
            </prijs>
            <div class="relative">
                <?php
                print $productdails.'<br>'.'<br>';
                ?>
                <a href="https://www.youtube.com/results?search_query=<?php echo$productNaam?>" target="_blank">YouTube</a>
            </div>
<relatedproduct>
    Gerelateerde producten
</relatedproduct>




        </div>
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">

                <div class="mySlides">
                    <div class="numbertext">1 / 3</div>
                    <img src="../wwi/af1.png" style="max-width:800px; max-height:800px;">
                </div>

                <div class="mySlides">
                    <div class="numbertext">2 / 3</div>
                    <img src="../wwi/af3.png" style="width:800px">
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
                <img class="demo cursor" src="../wwi/af1.png" style="width:100%" onclick="currentSlide(1)" alt="product">
            </div>
            <div class="column">
                <img class="demo cursor" src="../wwi/af3.png" style="width:100%" onclick="currentSlide(2)" alt="Werking">
            </div>
            <div class="column">
                <img class="demo cursor" src="../wwi/af4.png" style="width:100%" onclick="currentSlide(3)" alt="Effect">
            </div>

        </div>
    </div>

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

