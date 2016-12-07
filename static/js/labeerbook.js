/* **********************  DOCUMENT ONLOAD  **************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions qui seront executees apres le chargement du body        */
/* ********************************************************************* */
$(function() {

    $( "#chat" ).draggable({
        containment: "body",
        start: function(evt, ui) {
            $(this).addClass("btn-dragged");
        },
        stop: function(evt, ui) {
            $(this).removeClass("btn-dragged");
        }
    });

    $( "#chat" ).click(function () {
        // Cas chat minimise
        if ($(this).hasClass("minimise")) {
            // Il faut vérifier que le bouton n'a pas été déplacé
            // https://blog.lysender.com/2010/04/jquery-draggable-prevent-click-event/
            //
            if ($(this).hasClass("btn-dragged"))
                $(this).removeClass("btn-dragged");
            else
                afficher_chat($(this));
        }

        else {
            fermer_chat($(this));
        }
    });
});

function afficher_chat(chat) {
    chat.animate( { width: "315px", height: "465px" }, "fast", "linear" );
    chat.animate( { width: "-=22px", height: "-=22px" }, 100, "linear" );
    chat.animate( { width: "+=9px", height: "+=9px" }, 80, "linear" );
    chat.animate( { width: "-=2px", height: "-=2px" }, 50, "linear" );
    //chat.animate( { width: "+=2px", height: "+=2px" }, "fast", "linear" );
    //chat.draggable("disable");
    chat.removeClass("minimise");
    //chat.addClass("maximise");
}

function fermer_chat(chat) {
    chat.animate( { width: "100px", height: "40px" }, 200, "linear" );

    //chat.draggable("enable");
    chat.addClass("minimise");
    chat.removeClass("maximise");
}
