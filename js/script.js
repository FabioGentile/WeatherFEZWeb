/*
Gentile Fabio
*/


/* e necessario controllare i cookie anche da javascript? se si basta decommentare questa parte
function areCookiesEnabledJs() {
   if (navigator.cookieEnabled) 
      return true;
   document.cookie = "ctest=1";
   var ret = document.cookie.indexOf("ctest=") != -1;
   document.cookie = "ctest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
   return ret;
}

if (!areCookiesEnabledJs()){
		window.alert("Cookies Are Not Enabled! Use of this site is DENIED until you re-activate COOKIES on your browser!");
		document.write('<style type="text/undefined">');//STOP VISUALIZATION OF SITE IF COOKIES are DISABLED
}*/


function validateLRForm() {   //i form di login e registrazione sono gli stessi, posso usare la stessa funzione di controllo
   var usr = document.forms["regForm"]["username_p"].value;
   var pwd = document.forms["regForm"]["password_p"].value;
   var passed = true;
   
   var lbl_usn = document.getElementById('lbl_err_usr');
   var lbl_pwd = document.getElementById('lbl_err_pwd');
   var patt = /\W+/;
   
   lbl_usn.style.display = 'none';
   lbl_pwd.style.display = 'none';

   if(usr.length == 0){
      passed=false;
      lbl_usn.style.display = 'block';
      lbl_usn.innerHTML = 'Attenzione, username non presente';
   }
   
   if(usr.length > 20){
      passed=false;
      lbl_usn.style.display = 'block';
      lbl_usn.innerHTML = 'Attenzione, username troppo lungo (max 20 caratteri)';
   }
   
   if(patt.test(usr)){
      passed=false;
      lbl_usn.style.display = 'block';
      lbl_usn.innerHTML = 'Attenzione, l\'username contiene caratteri non validi';
   }
   
   if(pwd.length == 0){
      passed=false;
      lbl_pwd.style.display = 'block';
      lbl_pwd.innerHTML = 'Attenzione, password non presente';
   }
   
   if(pwd.length > 32){
      passed=false;
      lbl_pwd.style.display = 'block';
      lbl_pwd.innerHTML = 'Attenzione, password troppo lungo (max 32 caratteri)';
   }   

   //per la password non controllo la regexp -> md5

   return passed;
}

function validatePersForm() {   
   var att = document.forms["attForm"]["attivita_p"].value;
   var figli = document.forms["attForm"]["figli_p"].value;
   var passed = true;
   
   var lbl_att = document.getElementById('lbl_err_att');
   var lbl_figli = document.getElementById('lbl_err_figli');
   var patt_att = /[^a-zA-Z0-9_ ]+/;   //match se non alfanum OR _ OR space
   var patt_figli = /\D+/; //match se non numeric
   
   if(att.length == 0 || att.length > 20 || patt_att.test(att)){
      passed=false;
      lbl_att.style.display = 'block';
      lbl_att.innerHTML = 'Attenzione, nome attivit&agrave; non valido';
   }

   if(patt_figli.test(figli) || figli > 3){
      passed=false;
      lbl_figli.style.display = 'block';
      lbl_figli.innerHTML = 'Attenzione, numero di figli non valido';
   }

   return passed;
}
