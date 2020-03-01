<?php
/**
 * In questo file ottengo lo storico delle transazioni dell'utente.
 * @author Alessandro Nasso
 */
session_start();
header('Content-Type: application/json');
include("../common/stock_functions.php");
$user = $_SESSION['user'];
$rows = getHistory($user);
?>
<?= json_encode($rows); ?>
