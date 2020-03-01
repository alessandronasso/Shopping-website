<?php
/**
 * In questo file ho il form di registrazione.
 * @author Alessandro Nasso
 */
session_start();
?>
<?php include("../common/header.html"); ?>
<?php
if(isset($_SESSION["nome"]))
    header("location: ../contenuto/home.php");
?>
<div id="form">
    <fieldset>
      <legend>Registrazione</legend>
      <form action = "register_user.php" onsubmit="return controlloRegistrazione();" method = "POST">
        <label>Nome</label> <br>
        <input id="nome" name="nome" type="text">
        <label>Cognome</label> <br >
        <input id="cognome" name="cognome" type="text"> <br>
        <label>E-mail</label> <br >
        <input id="email" name="email" type="email">
        <label>Password</label> <br >
        <input id="password" name="password" type="password" placeholder="Almeno di 8 caratteri">
        <label>Ripeti la password</label> <br >
        <input id="repassword" name="repassword" type="password">
        <label>Telefono</label> <br >
        <input id="tel" name="tel" type="text">
        <label>Citta'</label> <br >
        <input id="citta" name="citta" type="text">
        <label id=error class="error"><?= (isset($_GET["yet"]) && $_GET["yet"])? "Utente già registrato" : "" ?></label>
        <input class="conferma" type="submit" value="Crea il tuo account!" >
    </form>
</fieldset>
</div>
<script src="../js/controlloUtente.js"></script>
<?php include("../common/footer.html"); ?>
