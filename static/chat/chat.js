/* ***************************  CHAT  ********************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions pour controller le fonctionnement du chat.              */
/*     On definit une classe JavaScript "Chat".                          */
/* ********************************************************************* */

// Initialisation du chat après le chargement de la page
$(function() {
    leChat = Chat();
    leChat.maximize();
});


// Initialisation. On crée un objet global qui stocke le chat
var Chat = function () {

    // Pointeur vers la classe. Comme on fait appel a des fonctions dans
    // d'autres fonctions, il faut avoir une reference pour acceder aux
    // attributs de l'unique instance du chat.
    var $this = this;

    // Div contenant le chat
    var $chat = $("#chat");

    // Donnees pour les fonctions de resize
    var resizeData = {
        maximized: {
            width: 300,
            height: 450
        },

        minimized: {
            width: 100,
            height: 40
        },

        beforeState: {}
    };



    /* ********************  CHARGER / ACTUALISER CHAT  ******************** */
    /* Description :                                                         */
    /*     On définit un attribut qui va indiquer si les messages du chat    */
    /*     ont été chargés. Lorsque l'on maximise le chat pour la première   */
    /*     fois, on va aller chercher dans la BDD tous les messages.         */
    /*                                                                       */
    /*     On active aussi un intervalle qui va récupérer les derniers msgs  */
    /*     toutes les X secondes. Pendant la charge initiale du chat, c'est- */
    /*     à-dire lors de la première maximisation, on va bloquer ce         */
    /*     comportement pour éviter de faire des requêtes inutiles.          */
    /*                                                                       */
    /*     En plus, si la fenêtre de chat est minimisée et les msgs n'ont    */
    /*     jamais été chargés (si le chat n'a jamais été maximisé) on        */
    /*     déclenche l'animation d'arrivée de nouveaux messages (le bzzz),   */
    /*     mais on n'ajoute pas ces messages dans le corps du chat. La       */
    /*     logique derriere ca c'est que si la liste de chat n'a jamais été  */
    /*     récupérée, lors de la première maximisation on va automatiquement */
    /*     récupérér ces messages-là.                                        */
    /* ********************************************************************* */

    // Cet attribut va nous indiquer si les messages on été récupérés de la
    // BDD une première fois
    this.chatsLoaded = false;

    // Finction qui scrolle à la fin de la liste de messages
    this.scroll_end = function () {
        $('#chat-contenu').animate({ scrollTop: $('#chat-contenu').prop("scrollHeight")}, 500);
    }

    // Fonction qui ajoute des nouveaux messages au chat
    this.add_new_messages = function (messages) {
        if ($this.chatsLoaded) {
            $('#chat-contenu').append(messages);
            $this.scroll_end();
        }
    }

    // On va activer le timer (interval) qui va chercher les derniers chats toutes les 15 secondes.
    // (sendRequest est defini dans ajax.js)
    this.intervalID = 0;

    this.activate_update = function() {
        $this.intervalID = setInterval(
            function() {
                sendRequest("ajaxGetLastChats", function(response, status, ajaxObj) {
                    //console.log(response);

                    if (response) {
                        $this.notification();
                        $this.add_new_messages(response);
                    }
                });
            }
            , 5000);
    }

    this.deactivate_update = function() {
        clearInterval($this.intervalID);
    }


    // On active l'intervalle d'actualisation du chat
    this.activate_update();


    /* ***********************  REDIMENSIONER CHAT  ************************ */
    /* Description :                                                         */
    /*     Les attributs de position du chat (top, left, etc.) sont toujours */
    /*     fixes afin d'ameliorer l'animation de maximisation.               */
    /*     La fonction jQuery resize utilise ces attributs pour determiner   */
    /*     la direction de la redimension.                                   */
    /*                                                                       */
    /*     On veut toujours changer la taille vers le bas-droite. Du coup,   */
    /*     il faut modifier les attributs de position pendant la redimension */
    /*     et les restorer apres.                                            */
    /* ********************************************************************* */

    this.resize_start = function (event, ui) {
        resizeData.beforeState = {
            top:        this.style.top ? this.style.top : "auto",
            left:       this.style.left ? this.style.left : "auto",
            bottom:     this.style.bottom ? this.style.bottom : "auto",
            right:      this.style.right ? this.style.right : "auto"
        };

        /*
        $chat.css("top", $chat.position().top);
        $chat.css("left", $chat.position().left);
        $chat.css("bottom", "auto");
        $chat.css("right", "auto");
        */
    }

    this.resize_stop = function (event, ui) {
        var state = resizeData.beforeState;

        /*
        $chat.css("top", state.top);
        $chat.css("left", state.left);
        $chat.css("bottom", state.bottom);
        $chat.css("right", state.right);
        */

        // On stocke dans l'objet chat l'info. de la dernière taille
        resizeData.maximized = {
            width:     $chat.width(),
            height:    $chat.height()
        };
    }

    // Initialisation de resizable
    $chat.resizable({
        handles: "se, nw",
        cancel: ".minimise",
        start: this.resize_start,
        stop: this.resize_stop
    });



    /* ***************************  DEPLACER CHAT  ************************* */
    /* Description :                                                         */
    /*     Deplacement du chat dans le body.                                 */
    /*                                                                       */
    /*     A la fin du drag, on change les valeurs de position (top, left,   */
    /*     etc.) par rapport a la position sur la partie visible de la       */
    /*     fenêtre. Par exemple, si après un drag le chat est plutôt en haut */
    /*     a droite, on va mettre des valeurs fixées pour top et right. Ceci */
    /*     permettra au "maximize" d'agrandir le div dans la direction       */
    /*     bas-gauche.                                                       */
    /* ********************************************************************* */

    this.drag_start = function() {
        $chat.addClass("chat-dragged");
    };

    // Fonction pour mettre a jour la position du chat a la fin d'un drag.
    this.drag_stop = function (event, ui) {
        var $window = $(window);

        // On obtient la position par rapport a la partie visible de la fenetre
        var left = ui.position.left - $window.scrollLeft();
        var top = ui.position.top - $window.scrollTop();
        var right = $window.width() - (left + $chat.width());
        var bottom = $window.height() - (top + $chat.height());

        var realRight = right - $window.scrollLeft();
        var realBottom = bottom - $window.scrollTop();

        // Fixed left / right
        if (left < right) {
            $chat.css("right", "auto");
        }
        else {
            $chat.css("left", "auto");
            $chat.css("right", right);
        }

        // Fixed top / bottom
        if (top < bottom) {
            $chat.css("bottom", "auto");
        }
        else {
            $chat.css("bottom", realBottom);
            $chat.css("top", "auto");
        }
    }

    // Initialisation de draggable
    $chat.draggable({
        containment: "body",
        handle: "#chat-bulle",
        start: this.drag_start,
        stop: this.drag_stop
    });



    /* *******************  CE QUE L'ON APPELE "LE BZZZ"  ****************** */
    /* Description :                                                         */
    /*     Implemente le comportement de la fenetre de chat quand on recoit  */
    /*     un message.                                                       */
    /*     On fait un effet de vibration et on ajoute une classe au chat     */
    /*     pendant l'animation, ce qui nous permet de modifier son style.    */
    /* ********************************************************************* */

    this.notification = function () {
        $chat.addClass("on-animation");

        // Animation du bzzz avec CSS3 @keyframes
        // Ajout de la classe qui va déclencher l'animation CSS3
        //console.log(document.body.style.animationName /*if( style.animationName !== undefined ) { animationSupport = true; }*/);
        $chat.addClass("chat-bzzz-anim");

        // À la fin de l'animation, on supprime la classe
        // .one va déclencher une seule fois la fonction que l'on définie
        //
        // http://blog.teamtreehouse.com/using-jquery-to-detect-when-css3-animations-and-transitions-end
        //
        $chat.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            $chat.removeClass("on-animation");
            $chat.removeClass('chat-bzzz-anim');
        });
    }

    //$( "#chat-bzzz-test" ).click(this.notification);



    /* ********************  MAXIMISER / MINIMISER CHAT  ******************* */
    /* Description :                                                         */
    /*     Fonction pour animer la maximisation du chat                      */
    /*     - Start :                                                         */
    /*         On stocke la position actuelle du chat et on fait un premier  */
    /*         changement de taille.                                         */
    /*                                                                       */
    /*     - Animate :                                                       */
    /*         On execute l'animation jusqu'a ce que la difference entre la  */
    /*         taille souhaite et la taille actuelle est infime.             */
    /*                                                                       */
    /*     - End :                                                           */
    /*         On restore le positionnement du chat (top/bottom, left/right) */
    /*         On fait aussi appel au callback recu en parametre.            */
    /* ********************************************************************* */

    this.minimize = function () {
        $chat.addClass("on-animation");
        $chat.addClass("chat-minimize-anim");

        $chat.removeClass("maximized");
        $chat.addClass("minimized");

        $chat.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            $chat.removeClass("on-animation");
            $chat.removeClass('chat-minimize-anim');

            $chat.removeClass("maximized");
            $chat.addClass("minimized");
        });
    }

    this.maximize = function () {
        $chat.addClass("on-animation");
        $chat.removeClass("minimized");
        $chat.addClass("maximized");
        $chat.addClass("chat-maximize-anim");

        // On désactive l'intervale d'actualisation pendant l'animation
        $this.deactivate_update();

        $chat.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            $chat.removeClass("on-animation");
            $chat.removeClass('chat-maximize-anim');

            // On va charger par AJAX les chats existants
            // (sendRequest se trouve dans le fichier ajax.js)
            if (! $this.chatsLoaded) {
                sendRequest("ajaxShowChats", function(response, status, ajaxObj) {
                    $('#chat-contenu').html(response);
                    $this.chatsLoaded = true;

                    // On scrolle au dernier message
                    $this.scroll_end();

                    // On active l'intervale d'actualisation
                    $this.activate_update();
                });
            }
        });
    }

    // Initialisation maximiser / minimiser
    $( "#chat-bulle" ).click(function () {
        // Il faut vérifier que le bouton n'a pas été déplacé
        // https://blog.lysender.com/2010/04/jquery-draggable-prevent-click-event/
        //
        if ($chat.hasClass("chat-dragged")) {
            $chat.removeClass("chat-dragged");
        }

        else {
            // Pendant les animations on ne peut rien faire
            if (! $chat.hasClass("on-animation")) {
                // Cas chat minimise
                if ($chat.hasClass("minimized"))
                    $this.maximize();

                // Cas chat maximise
                else if ($chat.hasClass("maximized"))
                    $this.minimize();
            }
        }
    });


    /* *************************  ENVOI DE MESSAGES  *********************** */
    /* Description :                                                         */
    /*     Fonction pour envoyer un message au chat à travers AJAX.          */
    /*     On envoi le message et on met à jour la liste de chats.           */
    /* ********************************************************************* */

    // Fonction qui envoie un nouveau message au chat
    this.send_new_message = function () {
        // On envoi le message, s'il n'est pas vide
        var texte = $('#chat-form textarea').val();

        if (texte.trim() != "") {
            sendRequest(
                "ajaxSendChatMessage",
                function(response, status, ajaxObj) {

                    // On nettoye le formulaire
                    $("#chat-form textarea").val("");

                    // Puis, on recupere les derniers chats
                    sendRequest("ajaxGetLastChats", function(response, status, ajaxObj) {
                        // La réponse doit contenir les derniers messages publiés. Celui
                        // qui vient d'être envoyé inclus.
                        if (response) {
                            $this.add_new_messages(response);
                        }
                    });
                },
                {"texte" : texte}
            );
        }
    }

    // Envoi de messages avec le bouton "Send"
    $("#chat-form button").click(this.send_new_message);

    // Envoi de messages avec la touche "Entrer"
    $("#chat-form textarea").keypress(function (evt) {
        if (evt.which == 13) {
            if (evt.ctrlKey) {
                // On va écrire un Entrer
                $("#chat-form textarea").val($("#chat-form textarea").val() + "\n");
            }
            else {
                // On évite l'écriture du dernier Entrer et on envoit le message
                evt.preventDefault();
                $this.send_new_message();
            }
        }
    });

    return this;

}
