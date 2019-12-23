<?php
include('include.php');


?>

<?php
if(isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $product) {
        $product = productenItem($product);
        $productID = $product[0]['StockItemID'];
        $productNaam = $product[0]['StockItemName'];
        $productPrijs = $product[0]['RecommendedRetailPrice'];
        $productdails = $product[0] ["SearchDetails"];

//        echo '<br>';
        //print($productNaam.' '.  $productPrijs);

        //print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:100px; max-height:100px; min-width: 50px; min-height: 50px' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");

    }
}
?>
<!--<br><br><br>-->
<!--<form action="/betaald.php">-->
<!---->
<!--    <fieldset style = "width: 500px; margin:  0px auto;">-->
<!--        <legend >Paypal advanced terminal</legend>-->
<!--        <legend>Personal information:</legend>-->
<!--        Name:<br>-->
<!--        <input type="text" name="firstname" value="name">-->
<!--        <br>-->
<!--        Email:<br>-->
<!--        <input type="text" name="lastname" value="...@example.com">-->
<!--        <br><br>-->
<!--        <input type="submit" value="Submit">-->
<!--    </fieldset>-->
<!--</form>-->
<!--<br><br><br><a href="index.php" class="topnavright"><i class="button">Betalen</i></a>-->
<!DOCTYPE html>
<html>
<head>
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
        }

        .col-50 {
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%; /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {

            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }
            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>


<div class="row">
    <div class="col-75">
        <div class="container">
            <form action="index.php" method="post">
                <div class="col-25">
                    <div class="container">
                        <h4>Cart <span class="price" style="color:black">
                    <i class="fa fa-shopping-cart"></i>
                    <b></b></span></h4><?php
                        $totaalprijs = 0;
                        //    var_dump($_SESSION["cart"]);
                        //    die;
                        if(isset($_SESSION["cart"])) {
                            foreach ($_SESSION["cart"] as $key => $aantal){
                                $product = productenItem($key);
                                $productID = $product[0]['StockItemID'];
                                $productNaam = $product[0]['StockItemName'];
                                $productPrijs = $aantal * ceil($product[0]['RecommendedRetailPrice']);
                                $productdails = $product[0]["SearchDetails"];
                                $voorraad = $product[0]["QuantityOnHand"];
                                $totaalprijs = $totaalprijs + $productPrijs;
                                //print("<img src='plaatjeswwi/id$productID.jpg' style='max-width:100px; max-height:100px; min-width: 50px; min-height: 50px' onerror='this.src=\"plaatjeswwi/default.jpg\"'>");

                                print($productNaam . ' ' . $productPrijs .'<br>');

                            }

                        }print("<br> <br> <br>  " .kortingGenerator($totaalprijs));

                        ?>
                    </div>
                </div>


                    <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <label for="expmonth">Exp Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="September">
                        <label for="expyear">Exp Year</label>
                        <input type="text" id="expyear" name="expyear" placeholder="2018">

                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="352">


                        <input type="submit" name="Pay" class="btn" onclick="alert('U heeft betaald')">

            </form>
                            </div>
                        </div>
                    </div>

                </div>




</body>
</html>
