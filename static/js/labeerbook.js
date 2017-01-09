/* **********************  DOCUMENT ONLOAD  **************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions qui seront executees apres le chargement du body        */
/* ********************************************************************* */
$(function() {

    /* *** Biere img profil draggable *** */
    $( "#img-profil-biere" ).draggable({
        containment: "#img-profil-container"
    });


    $( "#formProfile button" ).click(addMessage);
});
