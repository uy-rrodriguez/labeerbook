/**
 * Ensemble de fonctions utiliser pour l'interaction AJAX de l'application
 */

function processError(ajaxObj, status, errorThrown) {
	alert(status + ". Erreur : " + errorThrown + ". " + ajaxObj);
}

function sendRequest(action, onSuccessCallback = function(){}, arrData = []) {
	$options = {
			url			: "labeerbook_ajax.php?action=" + action,
			async		: true,
			data		: arrData,
			dataType	: "json",
			method		: "POST",

			error		: processError,
			success		: onSuccessCallback
	}

	$.ajax($options);
}

function logout() {
    sendRequest("ajaxLogout", function(reponse, status, ajaxObj) {
        document.location.href = "?action=login";

		//$("#bandeau-msg #msg-erreur").html(reponse.extra);
		//$("#bandeau-msg #msg-info").html(reponse.data.msgInfo);

		// http://stackoverflow.com/a/14461824
		//$('#contenu').fadeTo('slow',.6);
		//$('#contenu').prepend('<div style="position: absolute;top:0;left:0;width: 100%;height:100%;z-index:2;opacity:0.4;"></div>');

		//$(document.body).append("<button onclick='document.location.href=\"\"'>Aller au login</buton>");
	})
}


function showProfile() {
    sendRequest("showProfile", function(reponse, status, ajaxObj) {
        alert(reponse.data);
        $("#profil").html(reponse.extra);
	})
}
