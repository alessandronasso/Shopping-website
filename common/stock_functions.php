<?php
/**
 * In questo file ho i metodi che mi servono per gestire le query relative 
 * alle pagine dei prodotti.
 * @author Alessandro Nasso
 */

 /**
   * Metodo per stabilire la connessione al database.
   * @return una sessione di connessione al database o stampa un 
   * messaggio di errore.
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
   * Metodo per estrarre una serie di prodotti di una determinata categoria.
   * @param String $categoria Categoria selezionata dall'utente
   * @return un array associativo corrispondente ai prodotti della categoria
   * scelta.
   */

function getProdotti($categoria){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM Prodotto";
  if($categoria != "all"){
    $categoria = $db -> quote($categoria);
    $query_x = "SELECT ID FROM Categoria WHERE Nome = $categoria";
    $query = "$query WHERE Categoria=($query_x)";
  }
  $rows = $db -> query($query);
  return $rows -> fetchAll(PDO::FETCH_ASSOC);
}

/**
   * Metodo per estrarre una serie di prodotti di una determinata categoria.
   * @param int $id Identificativo univoco del prodotto
   * @return un array associativo corrispondente al prodotto con quell'ID.
   */

function getProdotto($id){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = "SELECT * FROM Prodotto WHERE ID=$id;";
  $rows = $db -> query($query);
  return $rows -> fetchAll(PDO::FETCH_ASSOC);
}

/**
   * Metodo per estrarre tutti i prodotti nel carrello associati all'utente
   * @param String $email Email dell'utente
   * @return un array associativo corrispondente a tutti i prodotti
   * nel carrello corrispondendti a quell'utente.
   */

function getCart($email){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $query = "SELECT *, Carrello.QTA as QTA FROM Carrello, Prodotto WHERE Carrello.id_prodotto=Prodotto.ID AND email=$email GROUP BY Prodotto.ID;";
  $rows = $db -> query($query);
  return $rows -> fetchAll(PDO::FETCH_ASSOC);
}

/**
   * Metodo per aggiungere un determinato prodotto nel carrello. Verra' prima 
   * effettuato un controllo sulla quantita' scelta per vedere se l'operazione
   * puo' andare a buon fine.
   * @param String $email Email dell'utente
   * @param int $id Identificativo univoco del prodotto
   * @return 0 se l'operazione e' andata a buon fine.
   */

function addToCart($email, $id){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $id = $db -> quote($id);
  $query = "SELECT QTA FROM Carrello WHERE email=$email AND id_prodotto=$id;";
  $rows = $db -> query($query);
  $qta = $rows -> fetchColumn();
  if($qta == 0)
    $query = "INSERT INTO Carrello (email, id_prodotto, QTA) VALUES ($email, $id, 1);";
  else
    $query = "UPDATE Carrello SET QTA=".($qta+1)." WHERE email=$email AND id_prodotto=$id;";
  $db -> query($query);
  return 0;
}

/**
   * Metodo per rimuovere un determinato prodotto dal carrello. 
   * @param String $email Email dell'utente
   * @param int $id Identificativo univoco del prodotto
   * @return 0 se l'operazione e' andata a buon fine.
   */

function removeFromCart($email, $id){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $query = "DELETE FROM Carrello WHERE email=$email AND id_prodotto=$id;";
  $rows = $db -> query($query);
  return 0;
}

/**
   * Metodo per comprare tutti gli oggetti nel carrello. Verra' eseguito un 
   * controllo sulla disponibilita' di essi e solo successivamente verra' 
   * aggiornata la quantita' rimasta nelle varia tabelle associate. 
   * @param String $email Email dell'utente
   * @return 0 se l'operazione e' andata a buon fine
   */

function buyCart($email){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $query = "SELECT id_prodotto, QTA FROM Carrello WHERE email=$email;";
  $Carrello = $db -> query($query);
  $Carrello = $Carrello -> fetchAll(PDO::FETCH_ASSOC);
  $query = "SELECT ID, Nome, QTA FROM Prodotto WHERE ID IN (SELECT id_prodotto FROM Carrello WHERE email=$email);";
  $prod = $db -> query($query);
  $prod = $prod -> fetchAll(PDO::FETCH_ASSOC);
  if(max(count($Carrello), count($prod))==0)
    return "Non ci sono oggetti da comprare";
  for($i=0; $i < max(count($Carrello), count($prod)); $i++){
    if($prod[$i]["ID"]==$Carrello[$i]["id_prodotto"]){
      if($prod[$i]["QTA"] < $Carrello[$i]["QTA"])
        return "Prodotti ".$prod[$i]["Nome"]." non disponibili a sufficienza";
    }else
    return "Anomalia nel carrello sul prodotto ".$prod[$i]["Nome"];
  }
  $query = "";
  foreach ($Carrello as $p) {
    for ($i=0; $i < $p["QTA"]; $i++){
      $query = $query." INSERT INTO Transazione (email, id_prodotto) VALUES 
      ($email, ".$p["id_prodotto"].");";
    }
    $query = $query." UPDATE Prodotto SET QTA=QTA-".$p["QTA"]." WHERE ID=".$p["id_prodotto"].";";
  }
  $query = $query." DELETE FROM Carrello WHERE email = $email";
  $db -> query($query);
  return 0;
}

/**
   * Metodo per estrarre una serie di prodotti dalla tabella relativa agli
   * ordini passati.
   * @param String $email Email dell'utente
   * @return un array associativo corrispondente ai prodotti acquistati
   * dall'utente.
   */

function getHistory($email){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email = $db -> quote($email);
  $query = "SELECT *, COUNT(*) as quant FROM Transazione, Prodotto WHERE Transazione.id_prodotto=Prodotto.ID AND email=$email GROUP BY email, Prodotto.ID;";
  $rows = $db -> query($query);
  return $rows -> fetchAll(PDO::FETCH_ASSOC);
}

/**
   * Metodo per estrarre una serie di prodotti con il nome corrispondente
   * a quello inserito dall'utente.
   * @param String $nome Nome del prodotto
   * @return un array associativo corrispondente ai prodotti con
   * quell'esatto nome.
   */

function searchProdotti($nome){
  $db = databaseConnection();
  $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $nome = $db -> quote($nome);
  $query = "SELECT * FROM Prodotto WHERE nome=$nome";
  $rows = $db -> query($query);
  return $rows -> fetchAll(PDO::FETCH_ASSOC);
}
?>