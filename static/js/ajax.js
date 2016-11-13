/**
 * Ensemble de fonctions utiliser pour l'interaction AJAX de l'application
 */

function processError(ajaxObj, status, errorThrown) {
	console.log("processError");
	alert(status + ". Erreur : " + errorThrown + ". " + ajaxObj);
}

function sendRequest(action, onSuccessCallback = function(){}, arrData = []) {
	console.log("sendRequest");
	
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
	console.log("logout");
	
	sendRequest("ajaxLogout", function(reponse, status, ajaxObj) {
		console.log("successLogout");
		console.log(ajaxObj);
		
		$("#bandeau-msg #msg-erreur").html(reponse.extra);
		$("#bandeau-msg #msg-info").html(reponse.data.msgInfo);
		
		// http://stackoverflow.com/a/14461824
		$('#contenu').fadeTo('slow',.6);
		$('#contenu').append('<div style="position: absolute;top:0;left:0;width: 100%;height:100%;z-index:2;opacity:0.4;"></div>');
		
		$("#contenu").after("<button onclick='document.location.href=\"\"'>Aller au login</buton>");
	})
}