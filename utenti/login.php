<?php
/**
 * In questo file ho il form di login.
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
    <legend>Accedi</legend>
    <form action = "access_user.php" onsubmit=" return controlloLogin();" method = "POST">
      <label>Indirizzo e-mail</label> <br >
      <input id="email" name="email" type="email">
      <label>Password</label> <br >
      <input id="password" name="password" type="password">
      <label id="error" class="error"></label>
      <input class="conferma" type="submit" value="Accedi" >
    </form>
    <form action = "signup.php" method = "POST">
      <div id="nuovo"><hr id="lhr" /> Non hai un account? <hr id="rhr" /></div> <br>
      <input id="registrazione" type="submit" value="Crea un nuovo account" >
    </form>
  </fieldset>
</div>
<script src="../js/controlloUtente.js"></script>
<?php include("../common/footer.html"); ?>
