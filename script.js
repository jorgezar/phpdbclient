function showEmailForm(){
	//
	var form = "<form action = '' method = 'post'>Dotychczasowy email:<br>\
	<input type = 'text'  name = 'oldmail' required><br>Nowy adres:<br>\
	<input type = 'text' name = 'newmail1' required><br>Powtórz adres:<br>\
	<input type = 'text' name = 'newmail2' required><br>\
	<input type ='submit' name = 'EmailSubmit' value='Prześlij'></form>";
	return form;
}
function showPasswordForm(){
	var form = "<form action = '' method = 'post'>Stare hasło: <br><input type = 'text'  name = 'oldpass' required><br>Nowe hasło:<br><input type = 'text' name = 'newpass1' required><br>Powtórz hasło:<br><input type = 'text' name = 'newpass2' required><br><input type ='submit' name = 'PassSubmit' value='Prześlij'></form>";
	return form;
}
function showContacts(phpval) {
	document.getElementById("showContacts").innerHTML = phpval;
}
function showAddContactForm() {
	var form = "<form id = 'addContactForm' action = '' method = 'post'>\
	Osoba:<br><input type = 'text' name='contactName' required><br>\
	Stanowisko:<br><input type = 'text' name='contactJob'><br>\
	Telefon:<br><input type = 'text' name='contactTelephone'><br>\
	Email:<br><input type = 'email' name='contactEmail'><br>\
	<input type ='submit' name = 'addContact' value='Dodaj'></form>";
	return form;
}
sfHover = function() {
	var sfEls = document.body.getElementsById("show_contacts");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
/*
	var e = document.getElementById('show');
e.onmouseover = function() {
  document.getElementById('popup').style.display = 'block';
}
e.onmouseout = function() {
  document.getElementById('popup').style.display = 'none';
}
*/
function openPopup(elem) {
   $(elem).next().fadeIn(200);
   $(elem).next().siblings(".popup").hide();
}


function closePopup() {
    $('.popup').fadeOut(300);
}

