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
	var arrayEdit = {"statut" : $('#StatusEdit').val()};

	sendRequest("ajaxEditProfile", function(response, status, ajaxObj) {
		alert(response);
	}, arrayEdit);
}

/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On récupère le message à publier
/*//*//*/
function addMessage(){
	var message = $('#formProfile textarea').val();
	var arrData = {"message" : message};
		sendRequest("ajaxAddMessage", function(response, status, ajaxObj) {
		// On nettoye le formulaire
			document.location.reload();
					
	}, arrData);
	
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
function addLike($id){
	var arrData = {"message" : $id};
	sendRequest("ajaxAddLike", function(response,status,ajaxObj){
			document.location.reload();
	},arrData)
}

/*//*//*/
    Auteur : Q.CASTILLO
    Description:
    On partage le message
/*//*//*/
function share($id){
	var arrData = {"messageID" : $id};
	sendRequest("ajaxShareMessage", function(response,status,ajaxObj){
			alert(response);
			document.location.reload();
	},arrData)
}