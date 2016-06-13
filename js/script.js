/*
Gentile Fabio
*/

/*
 * Funzione per controllare la validità di un form
 */
function validateLRForm() {   //i form di login e registrazione sono gli stessi, posso usare la stessa funzione di controllo
   var usr = document.forms["regForm"]["username_p"].value;
   var pwd = document.forms["regForm"]["password_p"].value;
   var passed = true;
   
   var lbl_usn = document.getElementById('lbl_err_usr');
   var lbl_pwd = document.getElementById('lbl_err_pwd');
   var patt = /\W+/;
   
   lbl_usn.style.display = 'none';
   lbl_pwd.style.display = 'none';

   if(usr.length === 0){
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
   
   if(pwd.length === 0){
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
