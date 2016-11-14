<?php
?>
<div id="profil" class="row">
	<div class="col-xs-12 col-sm-4">
		<img id="img-profil" src="static/img/profil.png">
	</div>

	<div class="col-xs-12 col-sm-4">
		<p><?php echo $userProfil->identifiant; ?></p>
		<p><?php echo $userProfil->prenom . " " . $userProfil->nom; ?></p>
		<p>
			Statut
			<svg xmlns="http://www.w3.org/2000/svg" style="height: 40px; width: 40px;">
				<circle cx="20" cy="20" r="20" fill="green" />
			</svg>
		</p>
	</div>

	<div class="col-xs-12 col-sm-4">
		<div class="list-group">
			<a class="list-group-item" href="?action=showMessage&idUtilisateur=1">Show messages</a>
			<a class="list-group-item" href="?action=showChats">Show chats</a>
			<a class="list-group-item" href="?action=showUsers">Show all users</a>
			<a class="list-group-item disabled" href="#">Amis</a>
			<a class="list-group-item disabled" href="#">Chat</a>
			<a class="list-group-item disabled" href="#">Accueil</a>
			<a class="list-group-item" href="#" onclick="logout()">Deconnexion</a>
		</div>
	</div>
</div>