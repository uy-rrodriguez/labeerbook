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

function editProfile() {
	alert("debut tests");
	var arrayEdit = [$('#NameEdit').val(),$('#FirstnameEdit').val(),$('#StatusEdit').val(),$('#PasswordEdit').val()];

	sendRequest("ajaxEditProfile", function(response, status, ajaxObj) {
		$('#profil').html(response);
	}, arrayEdit);
}
