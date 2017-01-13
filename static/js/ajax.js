/**
 * Ensemble de fonctions utiliser pour l'interaction AJAX de l'application
 */

function processError(ajaxObj, status, errorThrown) {
	console.log(status + ". Erreur : " + errorThrown + ". " + ajaxObj);
}

function sendRequest(action, onSuccessCallback = function(){}, arrData = []) {
	//alert("debut sendRequest");
	$options = {
			url			: "labeerbook_ajax.php?action=" + action,
			async		: true,
			data		: arrData,
			method		: "POST",

			error		: processError,
			success		: onSuccessCallback
	}

	$.ajax($options);
}

function logout() {
    sendRequest("ajaxLogout", function(reponse, status, ajaxObj) {
        document.location.href = "?action=login";
	})
}

/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On récupère les infos à éditer
/*//*//*/
function editProfile() {
	alert("debut tests");
	var arrayEdit = [$('#NameEdit').val(),$('#FirstnameEdit').val(),$('#StatusEdit').val(),$('#PasswordEdit').val()];

	sendRequest("ajaxEditProfile", function(response, status, ajaxObj) {
		$('#profil').html(response);
	}, arrayEdit);
}

/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On récupère le message à publier
/*//*//*/
function addMessage(){
	alert("debut test")
	var message = $('#formProfile textarea').val();
	
	sendRequest("ajaxAddMessage", function(response, status, ajaxObj) {
		// On nettoye le formulaire
                    $("#formProfile textarea").val("");
                    getMessage();
	}, message);
	
}


/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On affiche les messages
/*//*//*/
function getMessage(){
	
	sendRequest("ajaxGetMessages", function(response, status, ajaxObj) {
		$('#message').html(reponse);	
	});
	
}

/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On ajoute un like
/*//*//*/
function addLike(){
	sendRequest("ajaxAddLike", function(response,status,ajaxObj){
		
	})
}