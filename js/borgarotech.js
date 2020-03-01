/**
 * In questo file ho i metodi che mi servono per gestire l'aggiunta, la rimozione e 
 * l'acquisto dei prodotti disponibili sul sito.
 * @author Alessandro Nasso
 */

 /** 
 * Al caricamento della pagina verra' eseguito
 * il metodo pageLoad().
 * @event
 */

 window.onload = pageLoad;

/** 
 * Categoria selezionata dall'utente.
 * @global
 */

 var type = "";

/**
 * Questa funzione abilita il richiamo delle funzioni cart() e cerca()
 * al momento del click sui div corrispondenti. Carica inoltre tutti i
 * prodotti disponibili sul sito, ignorando per il momento la 
 * suddivisione in categorie.
 * @function
 */

 function pageLoad(){
    $("carrello").onclick = cart;
    $("searchbutton").onclick = cerca
    request("all");
}

/**
 * Questa funzione elabora una richiesta Ajax al file "get_cart.php"
 * che restituira' una stringa contenente la rappresentazione JSON
 * dei dati estratti. Il suo formato sara' il seguente:
 * [{obj1}, {obj2}, {obj3}...] 
 * Gli oggetti a loro volta conterranno una serie di parametri.
 * @function
 */

 function cart(){
    new Ajax.Request("../inventario/get_cart.php", {
        dataType: "json",
        onSuccess: printCart
    });
}

/**
 * Questa funzione elabora innanzitutto una richiesta per identificare
 * l'oggetto che si vuole inserire nel carrello e successivamente si fa
 * un'altra richiesta per effettuare l'inserimento vero e proprio.
 * @function
 * @param {int} id_1 - L'identificativo del prodotto.
 */

 function addToCart(id_1){
    new Ajax.Request("../inventario/prodotto_detail.php",
    {
        parameters: {
            id:id_1
        },
        dataType: "json",
    });
    new Ajax.Request("../inventario/add_cart.php", {
        dataType: "json",
        onSuccess: function(data){
            var response = JSON.parse(data.responseText);
            if(response == 0){
                alertify.success('Articolo aggiunto al carrello!');
                request("all");
            }else{
                alertify.error("Impossibile aggiungere il prodotto nel carrello");
            }
        }});
}

/**
 * Questa funzione elabora innanzitutto una richiesta per rimuovere
 * l'oggetto desiderato dal carrello (a livello back-end) e successivamente
 * stampa il carrello aggiornato. 
 * @function
 * @param {int} id - L'identificativo del prodotto.
 */

 function removeFromCart(id){
    new Ajax.Request("../inventario/remove_cart.php", {
        parameters:{
            id: id
        },
        dataType: "json",
        onSuccess: function(data){
            var response = JSON.parse(data.responseText);
            if(response == 0){
                alertify.success("Articolo rimosso dal carrello");
                cart();
            }else{
                alertify.error(response);
            }
        }
    });
}

/**
 * Questa funzione elabora l'oggetto JSON trasferitogli dalla funzione
 * che estrapola i dati dalla tabella relativa e stampa, creando il codice 
 * HTML vero e proprio, ogni prodotto nel carrello in una sorta di lista.
 * @function
 * @param {JSON Object} data - Elenco dei prodotti nel carrello.
 */

 function printCart(data){
    $("prodotti").innerHTML="<label class=carrellotext>Il tuo carrello</label>";
    JSON.parse(data.responseText).forEach(
        function(element) {
            $("prodotti").innerHTML += "<div class=prodotto id=prodotto"+element["ID"]+">"+
            "<img src='../img/remove.jpg' class = remove onclick=removeFromCart("+element["ID"]+")>" +
            "<img src=../prodotti/"+element["Immagine"]+">" +
            "<div class=nomeprod>"+element["Nome"]+"</div>" +
            "<div class=quanprod>oggetti nel carrello: "+element["QTA"]+"</div></div>";
        }
        );
    $("prodotti").innerHTML +=  "<div id=checkout>" +
    "<input class='conferma' type='button' value='Compra tutto' id=compra onclick='compraCart()'>";
}

/**
 * Questa funzione rimuove gli elementi dal carrello dell'utente e 
 * sottrae le quantita' appena acquistate da quelle presenti nel magazzino
 * (il tutto attraverso una richiesta Ajax) e stampa nuovamente il
 * contenuto del carrello. 
 * @function
 */

 function compraCart(){
    new Ajax.Request("../inventario/buy_cart.php",
    {
        dataType: "json",
        onSuccess: refreshCart
    });
}

/**
 * Questa funzione controlla se l'acquisto e' andato a buon fine oppure
 * no e notifica l'utente in base al dato JSON passatogli dalla funzione
 * che l'ha richiamata. 
 * @function
 */

 function refreshCart(data){
    var response = JSON.parse(data.responseText);
    if(response == 0){
        alertify.success("Articoli comprati con successo");
        cart();
    }else{
        alertify.error(response);
    }
}

/**
 * Questa funzione preleva il valore che l'utente ha inserito nel
 * campo research e lo passa come parametro alla funzione che andra'
 * poi a controllare se nel database esiste un prodotto con quel nome.
 * In caso di successo avvera' la stampa dei risultati.
 * @function
 */

 function cerca(){
    new Ajax.Request("../inventario/search_prodotti.php",
    {
        parameters: {
            nome: $("research").getValue()
        },
        dataType: "json",
        onSuccess: printData
    });
}

/**
 * Questa funzione controlla la categoria selezionata dall'utente e 
 * stampa solo i prodotti appartenenti ad essa.
 * @function
 * @param {String} t - Categoria scelta dall'utente
 */

 function request(t){
    type = t;
    new Ajax.Request("../inventario/get_prodotti.php",
    {
        parameters: {
            type: t
        },
        dataType: "json",
        onSuccess: printData
    });
}

/**
 * Questa funzione elabora l'oggetto JSON trasferitogli dalla funzione
 * che estrapola i dati dalla tabella relativa e stampa, creando il codice 
 * HTML vero e proprio, ogni prodotto in una sorta di lista.
 * @function
 * @param {JSON Object} data - Elenco dei prodotti di una categoria.
 */

 function printData(data){
    $("prodotti").innerHTML="<div class=container><div id=alert_placeholder></div>";
    JSON.parse(data.responseText).forEach(
        function(element){
            $("prodotti").innerHTML += "<div class=col-xs-12 col-md-6>"+
            "<div class=prod-info-main prod-wrap clearfix><div class=row>"+
            "<div class=col-md-5 col-sm-12 col-xs-12><div class=product-image>"+
            "<img src=../prodotti/"+element["Immagine"]+" class=img-responsive rotprod>"+ 
            "</div></div><div class=col-md-7 col-sm-12 col-xs-12>"+
            "<div class=product-deatil><h5 class=name>"+element["Nome"]+
            "</h5><p class=price-container>"+
            "<span>&euro; "+element["Prezzo"]+"</span></p><span class=tag1></span></div>"+
            "<div class=description><p>"+((element["Descrizione"].length > 100)? element["Descrizione"].substring(0, 100)+"...":element["Descrizione"])+
            "</p></div><div class=product-info smart-form><div class=row><div class=col-md-12>"+
            "<div id=checkout><input class='conferma' type='submit' value='Aggiungi al carrello' id='incart' onclick='addToCart("+element["ID"]+")'>"+
            "</div></div></div></div></div></div></div>";
        }
        );
    $("prodotti").innerHTML+="</div>";
}

/**
 * Questa funzione recupera un oggetto JSON contenente tutti i prodotti
 * acquistati in passato dall'utente e successivamente li stampa.
 * @function
 */

 function cronologia(){
    new Ajax.Request("../inventario/get_history.php",{
        dataType: "json",
        onSuccess: printHistory
    });
}

/**
 * Questa funzione elabora l'oggetto JSON trasferitogli dalla funzione
 * che estrapola i dati dalla tabella relativa e stampa, creando il codice 
 * HTML vero e proprio, ogni prodotto in una sorta di lista.
 * @function
 * @param {JSON Object} data - Elenco dello storico dei prodotti.
 */

 function printHistory(data) {
    $("prodotti").innerHTML="<label class=carrellotext>I tuoi acquisti</label>";
    $("prodotti").innerHTML+="<div class=container>";
    JSON.parse(data.responseText).forEach(
        function(element) {
            $("prodotti").innerHTML += "<div class=col-xs-12 col-md-6>"+
            "<div class=prod-info-main2 prod-wrap clearfix><div class=row>"+
            "<div class=col-md-5 col-sm-12 col-xs-12><div class=product-image>"+
            "<img src=../prodotti/"+element["Immagine"]+" class=img-responsive rotprod>"+ 
            "</div></div><div class=col-md-7 col-sm-12 col-xs-12>"+
            "<div class=product-deatil><h5 class=name>"+element["Nome"]+
            "</h5><p class=price-container>"+
            "<span>&euro; "+element["Prezzo"]+"</span></p><span class=tag1></span></div>"+
            "<div class=description><p>"+((element["Descrizione"].length > 100)? element["Descrizione"].substring(0, 100)+"...":element["Descrizione"])+
            "</p></div><div class=product-info smart-form><div class=row><div class=col-md-12>"+
            "</div></div></div></div></div></div>";
        }
        );
    $("prodotti").innerHTML+="</div>";
}