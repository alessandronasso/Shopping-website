/**
 * In questo file ho i metodi che gestiscono l'animazione del Minion
 * @author Alessandro Nasso
 */

  /** 
 * Al caricamento della pagina verra' eseguito
 * il metodo init().
 * @event
 */

 window.onload =init;

/** 
 * Mi permette di gestire l'oggetto desiderato in ogni
 * metodo inizializzandolo solo una volta.
 * @global
 */

 var imgObj = null;

 /** 
 * Mi permette di gestire nel dettaglio l'immagine 
 * presente nel div
 * @global
 */

 var immagine = null;

/** 
 * Mi permette di gestire l'animazione in ogni metodo.
 * @global
 */


 var animate;

 /**
 * Questa funzione inizializza l'oggetto e setta la posizione
 * di partenza che e' "fuori schermo", per poi 
 * richiamare il metodo che lo fa apparire.
 * @function
 */


 function init(){
   imgObj = document.getElementById('minion');
   immagine = document.getElementById('immagine_minion');
   imgObj.style.position= 'absolute'; 
   imgObj.style.top = '240px';
   imgObj.style.left = '-300px';
   imgObj.style.visibility='hidden';
   appaer();
 } 

 /**
 * Sposta l'oggetto verso destra fino a che non raggiunge  
 * la posizione desiderata. Imposto inoltre un timer per 
 * fare cio'.
 * @function
 */

 function appaer(){
  immagine.src="../img/minion_dx.png";
  if (parseInt(imgObj.style.left)<200) {
   imgObj.style.left = parseInt(imgObj.style.left) + 5 + 'px';
   imgObj.style.visibility='visible';
   animate = setTimeout(appaer,20);
 } else 
 stop();
}

/**
 * Interrompe l'animazione dello spostamento.
 * @function
 */

 function stop(){
  immagine.src="../img/minion.png";
  clearTimeout(animate);
}

/**
 * Decide i movimenti che puo' eseguire il minion in base alla sua
 * posizione corrente. Ha sempre due possibili strade. Gli if gestiscono 
 * i casi in quest'ordine: 1)alto-sx, 2)basso-sx, 3)alto-dx, 4)basso-dx
 * @function
 */

 function move () {
  if (imgObj.style.top == (240+"px") && imgObj.style.left == (200+"px"))
    pick(1, 4);
  else if (imgObj.style.top == (630+"px") && imgObj.style.left == (200+"px"))
    pick(2, 4);
  else if (imgObj.style.top == (240+"px") && imgObj.style.left == (800+"px"))
    pick(1, 3);
  else 
    pick(2, 3);
}

/**
 * Questa funzione sposta il Minion verso il basso.
 * @function
 */

 function moveDown () { 
  immagine.src="../img/minion_dx.png";
  if (parseInt(imgObj.style.top)<630) {
   imgObj.style.top = parseInt(imgObj.style.top) + 5 + 'px';
   imgObj.style.visibility='visible';
   animate = setTimeout(moveDown,20);
 } else 
 stop();
}

/**
 * Questa funzione sposta il Minion verso l'alto.
 * @function
 */

 function moveUp () { 
  immagine.src="../img/minion_up.png";
  if (parseInt(imgObj.style.top)>240) {
   imgObj.style.top = parseInt(imgObj.style.top) - 5 + 'px';
   imgObj.style.visibility='visible';
   animate = setTimeout(moveUp,20);
 } else 
 stop();
}

/**
 * Questa funzione sposta il Minion verso sinistra.
 * @function
 */

 function moveLeft () { 
  immagine.src="../img/minion_sx.png";
  if (parseInt(imgObj.style.left)>200) {
   imgObj.style.left = parseInt(imgObj.style.left) - 5 + 'px';
   imgObj.style.visibility='visible';
   animate = setTimeout(moveLeft,20);
 } else 
 stop();
}

/**
 * Questa funzione sposta il Minion verso destra.
 * @function
 */

 function moveRight () { 
  immagine.src="../img/minion_dx.png";
  if (parseInt(imgObj.style.left)<800) {
   imgObj.style.left = parseInt(imgObj.style.left) + 5 + 'px';
   imgObj.style.visibility='visible';
   animate = setTimeout(moveRight,20);
 } else 
 stop();
}

/**
 * Questa funzione sceglie casualmente una delle due
 * strade che il minion puo' percorrere.
 * @function
 */

 function pick (min, max) {
  var ran = Math.round((Math.random()*1));
  if (ran == 0) ran=min;
  else ran=max;
  if (ran == 1) moveDown();
  else if (ran == 2) moveUp();
  else if (ran == 3) moveLeft();
  else moveRight();
}
