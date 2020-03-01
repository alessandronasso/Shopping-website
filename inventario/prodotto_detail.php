<?php
/**
 * In questo file ottengo le informazioni sul prodotto.
 * @author Alessandro Nasso
 */
session_start();
include("../common/stock_functions.php");
$id = $_POST['id'];
$_SESSION["id_prodotto"] = $id;
$rows = getProdotto($id);
?>
<?= json_encode($rows); ?>
