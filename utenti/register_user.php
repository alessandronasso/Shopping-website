<?php
/**
 * In questo file controllo e procedo alla registrazione dell'utente.
 * @author Alessandro Nasso
 */
session_start();
include("../common/functions.php");
if(!userExists($_POST["email"])){
	registerUser($_POST["nome"], $_POST["cognome"], $_POST["citta"], $_POST["tel"], $_POST["email"], $_POST["password"]);
	$_SESSION["user"] = $_POST["email"];
	$_SESSION["nome"] = $_POST["nome"];
	header("location: ../contenuto/home.php");
} else
header("location: ./signup.php?yet=true");
?>
