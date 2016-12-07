<?php
    /*//*//*/
        Auteur : R.RODRIGUEZ
        Description :
	    	Profil qui s'affichera si l'utilisateur est connecte.
            Si on est dans la page d'un autre utilisateur, on affichera son profil.
    /*//*//*/
    $userProfil = $context->getSessionAttribute("user");
?>

<div id="profil" class="row">
  <div class="col-xs-4 col-md-3">
    <img id="img-profil" class="img img-responsive full-width" src="static/img/profil.png">
    <!--
    <img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" style="width: 200px; height: 200px;"
      src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzIwMHgyMDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNThhYWU0NTdjZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OGFhZTQ1N2NkIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjczLjUiIHk9IjEwNC44Ij4yMDB4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+"
      data-holder-rendered="true">
    -->
  </div>
  <div class="col-xs-8 col-md-6">
    <h2><?php echo $userProfil->identifiant; ?></h2>
    <h3><?php echo $userProfil->prenom . " " . $userProfil->nom; ?></h3>
    <h3>
      Statut : <?php echo $userProfil->statut; ?>
    </h3>
  </div>
  <div class="hidden-xs col-sm-3" style=""></div>
</div>
