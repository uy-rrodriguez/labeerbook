/* **********************  DOCUMENT ONLOAD  **************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions qui seront executees apres le chargement du body        */
/* ********************************************************************* */
$(function() {

    $( "#chat" ).draggable({
        containment: "body",
        handle: "#bulle",
        start: function(evt, ui) {
            $(this).addClass("dragged");
        }
    });

    $( "#chat" ).resizable({
        handles: "nw, se",
        cancel: ".minimise"
    });

    $( "#bulle" ).click(function () {
        var chat = $("#chat");

        // Il faut vérifier que le bouton n'a pas été déplacé
        // https://blog.lysender.com/2010/04/jquery-draggable-prevent-click-event/
        //
        if (chat.hasClass("dragged")) {
            chat.removeClass("dragged");
        }

        else {
            // Cas chat minimise
            if (chat.hasClass("minimise"))
                afficher_chat(chat);

            // Cas chat maximise
            else
                fermer_chat(chat);
        }
    });
});


/* **********************  DOCUMENT ONLOAD  **************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions pour controller le fonctionnement du chat.              */
/* ********************************************************************* */

function afficher_chat(chat) {
    chat.animate( { width: "315px", height: "465px" }, "fast", "linear" );
    chat.animate( { width: "-=22px", height: "-=22px" }, 100, "linear" );
    chat.animate( { width: "+=9px", height: "+=9px" }, 80, "linear" );

    chat.animate( { width: "-=2px", height: "-=2px" }, 50, "linear",
        function () {
            chat.removeClass("minimise");
            chat.addClass("maximise");
        }
    );
}

function fermer_chat(chat) {
    chat.animate( { width: "100px", height: "40px" }, 200, "linear",
        function () {
            chat.addClass("minimise");
            chat.removeClass("maximise");
        }
    );
}

/*
 * Implemente le comportement de la fenetre de chat quand on recoit un message.
 * On fait un effet de vibration et on ajoute une classe au chat pendant l'animation,
 * ce qui nous permet de modifier son style.
 */
function notification_chat(chat) { // Ce que l'on appele le "bzzz"
    chat.addClass("chat-bzzz");

    chat.animate( { left: "-=5px" }, 100, "linear" );

    for (var i = 0; i < 5; i++) {
        chat.animate( { left: "+=10px" }, 100, "linear" );
        chat.animate( { left: "-=10px" }, 100, "linear" );
    }

    chat.animate( { left: "+=5px" }, 100, "linear",
        function () {
            chat.removeClass("chat-bzzz");
        }
    );
}
