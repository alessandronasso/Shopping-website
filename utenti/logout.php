<?php
/**
 * In questo file effettuo il logut dell'utente.
 * @author Alessandro Nasso
 */
session_start();
session_destroy();
header("location: ../");
?>