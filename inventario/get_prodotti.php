<?php
/**
 * In questo file ottengo l'elenco dei prodotti di una determinata categoria.
 * @author Alessandro Nasso
 */
header('Content-Type: application/json');
include("../common/stock_functions.php");
$type = $_POST['type'];
$rows = getProdotti($type);
?>
<?= json_encode($rows); ?>