<?php
  /*//*//*/
	  Auteur : R.RODRIGUEZ
	  Description :
	    	Menu d'options qui s'affichera si l'utilisateur est connecte.
  /*//*//*/
?>


    <nav id="nav-menu" class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="navbar-brand">Menu</span>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li><a href="?action=showProfile">Accueil</a></li>
          <li class="visible-xs visible-sm"><a href="?action=showFriends">Les amis</a></li>
          <li><a href="?action=editProfile">Éditer profil</a></li>
          <li><a href="#" onclick="logout()">Se déconnecter</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>

