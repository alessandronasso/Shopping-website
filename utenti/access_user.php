<?php
/**
 * In questo file verifico i dati passati attraverso il form di login.
 * @author Alessandro Nasso
 */

session_start();
include("../common/functions.php");
$nome = verifyUser($_POST["email"], $_POST["password"]);
if (isset($_SESSION)) {
	session_regenerate_id(TRUE);
}
$_SESSION["user"] = $_POST["email"];
$_SESSION["nome"] = $nome;
header("location: ../contenuto/home.php");
?>
