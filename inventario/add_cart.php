<?php
/**
 * In questo file procedo con l'aggiunta del prodotto nel carrello.
 * @author Alessandro Nasso
 */
session_start();
header('Content-Type: application/json');
include("../common/stock_functions.php");
$user = $_SESSION['user'];
$id = $_SESSION['id_prodotto'];
$rows = addToCart($user, $id);
?>
<?= json_encode($rows); ?>
