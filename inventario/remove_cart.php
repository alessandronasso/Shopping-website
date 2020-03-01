<?php
/**
 * In questo file procedo con la rimozione del prodotto dal carrello.
 * @author Alessandro Nasso
 */
session_start();
header('Content-Type: application/json');
include("../common/stock_functions.php");
$user = $_SESSION['user'];
$id = $_POST['id'];
$rows = removeFromCart($user, $id);
?>
<?= json_encode($rows); ?>
