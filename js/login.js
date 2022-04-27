function login() {
    document.getElementById("login").click();  
}

var c=document.getElementById("error").innerHTML;
 
if(c.search("Username") > 1){
    document.getElementById("loginUsername").classList.add('error');
}

if(c.search("Password") > 1){ 
    document.getElementById("loginPassword").classList.add('error');
}
  