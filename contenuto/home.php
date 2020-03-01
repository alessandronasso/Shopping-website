<?php
/**
 * In questo file ho lo scheletro della homepage che viene visualizzata a 
 * login/registrazione effettuata.
 * @author Alessandro Nasso
 */
session_start();
if(!isset($_SESSION["nome"]))
	header("location: ../");
?>
<?php include("homeheader.html"); ?>

<?php include("menu.php"); ?>

<?php include("prodotti.php"); ?>

<?php include("../common/footer.html"); ?>
