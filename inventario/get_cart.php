<?php
/**
 * In questo file ottengo l'elenco dei prodotti aggiunti al carrello dall'utente.
 * @author Alessandro Nasso
 */
session_start();
header('Content-Type: application/json');
include("../common/stock_functions.php");
$user = $_SESSION['user'];
$rows = getCart($user);
?>
<?= json_encode($rows); ?>
