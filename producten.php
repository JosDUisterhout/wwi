<?php
include('include.php');



global $producten;

$producten = productenItem($_GET['id']);
$productID = $producten[0]['StockItemID'];
$productNaam = $producten[0]['StockItemName'];
$productPrijs = $producten[0]['RecommendedRetailPrice'];
$productdails = $producten[0] ["SearchDetails"];
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
<div class="cartbtn">
    <form method="post" action="cart.php">
        <input type="hidden" name="productID" value='<?php print($productID);?>'>
        <button type="submit" name="cart" class="button">In winkelmandje</button>
    </form>
</div>

<h2>
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
            <?php
            print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:100px' onclick='openModal();currentSlide(1)' class='hover-shadow cursor' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
            ?>
            <!---->
            <!---->
            <!--PRODUCT INFORMATIE------PRODUCT INFORMATIE------PRODUCT INFORMATIE------PRODUCT INFORMATIE-->
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
    <div class="container">
        <ul>
            <li> <a href="producten.php?id=<?php echo rand(1, count(productenLijst()))?>" ><?php echo 'product'?></a> </li>
            <li> <a href="producten.php?id=<?php echo rand(1, count(productenLijst()))?>" ><?php echo 'product'?></a> </li>
            <li> <a href="producten.php?id=<?php echo rand(1, count(productenLijst()))?>" ><?php echo 'product'?></a> </li>
        </ul>
    </div>
</relatedproduct>
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">
                <div class="mySlides">
                    <div class="numbertext">1 / 3</div>
                    <?php
                    print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:800px; max-height:800px;' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");
                    ?>
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
                <?php
                print("<img class='demo cursor' src='plaatjeswwi/id$productID.jpg' style='width:100%' onclick='currentSlide(1)' alt='product' onerror='this.src=\"plaatjeswwi/default.jpg\"'>")
                ?>
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


