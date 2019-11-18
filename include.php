<?php

include('config.php');
include('functies.php');



?>

<!--TODO: onderstaande in layout.php-->

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

    <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#login" class="topnavright">Login</a>
        <form method="get" class="zoek">
            <div class="">
                <input type="text" class="zoeken" name="zoek" placeholder="Zoeken" />
                <button type="submit" name="submit" class="zoekbtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="mobielzoek">
    <form method="get" >
        <input type="text" class="zoeken" name="zoek" placeholder="Zoeken" />
        <button type="submit" name="submit" class="zoekbtn">
            <i class="fa fa-search"></i>
        </button>
    </form>
    </div>

    <?php
    if(isset($_GET['submit'])) {
        $zoek = $_GET["zoek"];
        $producten = zoekProduct($zoek);
    }
    else{
        $producten = productenLijst();
    }
    ?>


    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>
</html>

