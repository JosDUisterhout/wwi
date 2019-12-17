<?php
include('include.php');
print('<br><br><br>');
if ( ! isset($_SESSION['gebruikersnaam']))
{
    header('Location: inlog.php');
} elseif (isset($_GET['id']))
{
    $items = factuurItems($_GET['id']);
    $bestelling = getBestelling($_SESSION['gebruikersID']);
    $bestellingID = $bestelling[0]['bestellingID'];
    $datum = $bestelling[0]['datum'];

    ?>

    <h2 class="factuur">Hieronder ziet u uw factuur:</h2>

    <table id="orders">
        <tr>
            <th>Ordernummer:</th>
            <th>Datum:</th>
        </tr>
        <tr>
            <td>#<?php print($_GET['id']); ?></td>
            <td><?php print($datum); ?></td>
        </tr>
    </table>


    <table id="orderProduct">
        <tr>
            <th>Productnummer:</th>
            <th>Productnaam:</th>
            <th>Aantal:</th>
            <th>Prijs per product:</th>
            <th>Totaalprijs:</th>
        </tr>
        <br><br>


        <?php
        $totaalprijs = 0;
        foreach ($items as $item)
        {
            $stockItemID = $item['stockItemID'];
            $naam = $item['StockItemName'];
            $aantal = $item['aantal'];
            $productPrijs = $item['RecommendedRetailPrice'];
            $totaalprijs = $totaalprijs + ($productPrijs * $aantal);
            ?>
            <tr onclick="location.href='producten.php?id=<?php print($stockItemID); ?>'">
                <td>#<?php print($stockItemID); ?></td>
                <td><?php print($naam); ?></td>
                <td><?php print($aantal); ?></td>
                <td>€<?php print($productPrijs); ?></td>
                <td>€<?php print($productPrijs * $aantal); ?></td>
            </tr>


            <?php
        }
        ?>
        <br>
        <tr>
            <th colspan="4">Totaalprijs</th>
            <th>€<?php print($totaalprijs); ?></th>
        </tr>
    </table>


    <?php
} else
{
    header('Location: secure.php');
}