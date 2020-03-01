<?php
/**
 * In questo file procedo con l'acquisto dei prodotti.
 * @author Alessandro Nasso
 */
session_start();
header('Content-Type: application/json');
include("../common/stock_functions.php");
$user = $_SESSION['user'];
$res = buyCart($user);
?>
<?= json_encode($res); ?>
