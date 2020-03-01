<?php
/**
 * In questo file ho i metodi che mi servono per registrare un nuovo utente e per
 * verificarne l'esistenza dello stesso in fase di login
 * @author Alessandro Nasso
 */

 /**
   * Metodo per stabilire la connessione al database.
   * @return una sessione di connessione al database o stampa un 
   * messaggio di errore
   */ 

 function databaseConnection () {
  try {
    $db = new PDO('mysql:host=localhost;dbname=progetto', "root", "root");
  } catch (PDOException $e) {
    print_r ("Error!: " . $e->getMessage() . "<br/>");
    die();
  }
  return $db;
}

 /**
   * Registra l'utente all'interno del database.
   * @param String $nome Nome dell'utente
   * @param String $cognome Cognome dell'utente
   * @param String $telefono Telefono dell'utente
   * @param String $citta Citta' dell'utente
   * @param String $email Email dell'utente
   * @param String $password Password dell'utente
   */


 function registerUser($nome, $cognome, $citta, $tel, $email, $password){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $nome = $db -> quote($nome);
  $password = md5($password);
  $cognome = $db -> quote($cognome);
  $citta = $db -> quote($citta);
  $tel = $db -> quote($tel);
  $query = "INSERT INTO Utente 
  VALUES(NULL, $email, '$password', $nome, $cognome, $tel, $citta);";
  $db -> query($query);
}

 /**
   * Metodo per controllare l'esistenza in fase di login di un determinato utente.
   * @param String $email Email dell'utente
   * @param String $password Password dell'utente
   * @return un array associativo contenente i risultati della query
   */ 

 function verifyUser($email, $password){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $password = md5($password);
  $query = "SELECT * FROM Utente WHERE email=$email AND password='$password';";
  $rows = $db -> query($query);
  return $rows -> fetch(PDO::FETCH_ASSOC)["nome"];
}

/**
   * Metodo per controllare l'esistenza di un utente associato
   * ad una determinata email.
   * @param String $email Email dell'utente
   * @return true se sono stati trovati utenti associati a quella email,
   * false se il risultato della query e' zero.
   */

function userExists($email){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $query = "SELECT * FROM Utente WHERE email=$email;";
  $rows = $db -> query($query);
  return $rows -> rowCount() != 0;
}
?>