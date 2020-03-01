/**
 * In questo file ho i metodi che mi controllano i campi inseriti nei form 
 * di login e di registrazione
 * @author Alessandro Nasso
 */

 /** Funzione di controllo del form di login */

 function controlloLogin() {
  if ($("email").value.trim() == "") {
    $("error").innerHTML = "Campo email vuoto";
    return false;
  }else if ($("password").value == ""){
    $("error").innerHTML = "Campo password vuoto";
    return false;
  }
  return true;
}

/** Funzione di controllo del form di registrazione */

function controlloRegistrazione() {
  if ($("nome").value.trim() == "") {
    $("error").innerHTML = "Campo nome vuoto";
    return false;
  }else if ($("email").value.trim() == "") {
    $("error").innerHTML = "Campo email vuoto";
    return false;
  }else if ($("citta").value.trim() == "") {
    $("error").innerHTML = "Campo citta' vuoto";
    return false;
  }else if ($("password").value == ""){
    $("error").innerHTML = "Campo password vuoto";
    return false;
  }else if($("password").value.length < 8){
    $("error").innerHTML = "Password troppo corta";
    return false;
  }else if ($("password").value != $("repassword").value) {
    $("error").innerHTML = "Campi password diversi";
    return false;
  }
  return true;
}
