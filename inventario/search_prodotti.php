<?php
/**
 * In questo file ottengo l'elenco dei prodotti con il nome uguale a quello 
 * cercato dall'utente.
 * @author Alessandro Nasso
 */
header('Content-Type: application/json');
include("../common/stock_functions.php");
$nome = $_POST['nome'];
$rows = searchProdotti($nome);
?>
<?= json_encode($rows); ?>
