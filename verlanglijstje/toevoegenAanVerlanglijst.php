<?php
include "../functies.php";
session_start();

toevoegenProductVerlanglijst($_POST["productID"] ,TRUE);

redirect('/wwi/verlanglijst.php');