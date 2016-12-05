<?php
  /*//*//*/
	  Auteur : R.RODRIGUEZ
	  Description :
	    	Menu d'options qui s'affichera si l'utilisateur est connecte.
  /*//*//*/
?>

<div class="col-xs-12 col-sm-4 col-md-3">
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
