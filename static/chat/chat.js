/* ***************************  CHAT  ********************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions pour controller le fonctionnement du chat.              */
/*     On definit une classe JavaScript "Chat".                          */
/* ********************************************************************* */

// Initialisation du chat après le chargement de la page
$(function() {
    leChat = Chat();
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

    // Fonction qui ajoute des nouveaux messages au chat
    this.add_new_messages = function (messages) {
        if ($this.chatsLoaded) {
            console.log("Scroll height avant : " + $('#chat-contenu').prop("scrollHeight"));
            $('#chat-contenu').append(messages);
            console.log("Scroll height apres : " + $('#chat-contenu').prop("scrollHeight"));
            $('#chat-contenu').animate({ scrollTop: $('#chat-contenu').prop("scrollHeight")}, 500);
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
        $chat.addClass("chat-bzzz");

        $chat.animate( { left: "-=5px" }, 100, "linear" );

        for (var i = 0; i < 5; i++) {
            $chat.animate( { left: "+=10px" }, 100, "linear" );
            $chat.animate( { left: "-=10px" }, 100, "linear" );
        }

        $chat.animate( { left: "+=5px" }, 100, "linear",
            function () {
                $chat.removeClass("chat-bzzz");
                $chat.removeClass("on-animation");
            }
        );
    }

    //$( "#chat-btn-test" ).click(this.notification);



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
        $chat.removeClass("maximized");
        $chat.addClass("minimized");

        $chat.animate(
            {
                width: resizeData.minimized.width + "px",
                height: resizeData.minimized.height + "px"
            },
            200,
            "linear",
            function () {
                $chat.removeClass("on-animation");

                // Peut-être l'actualisation avait été désactivée par le
                // maximize, du coup on l'active
                $this.deactivate_update();
                $this.activate_update();
            }
        );
    }

    this.maximize = function () {
        var data = {
            width:        resizeData.maximized.width,
            height:       resizeData.maximized.height,

            end_callback: function () {
                $chat.removeClass("on-animation");
                $chat.removeClass("minimized");
                $chat.addClass("maximized");

                // On va charger par AJAX les chats existants
                // (sendRequest se trouve dans le fichier ajax.js)
                if (! $this.chatsLoaded) {
                    sendRequest("ajaxShowChats", function(response, status, ajaxObj) {
                        $('#chat-contenu').html(response);
                        $this.chatsLoaded = true;

                        // On active l'intervale d'actualisation
                        $this.activate_update();
                    });
                }
            }
        };

        $this.maximize_start(data);
    }

    this.maximize_start = function (data) {
        $chat.addClass("on-animation");

        // On désactive l'intervale d'actualisation
        $this.deactivate_update();

        var actualW = $chat.width();
        var actualH = $chat.height();
        var diffW = data.width - actualW;
        var diffH = data.height - actualH;
        var extraW = diffW * 0.15;
        var extraH = diffH * 0.15;
        var w = data.width + extraW + "px";
        var h = data.height + extraH + "px";
        var speed = 200;

        $chat.animate( {width: w, height: h}, speed, "linear",
            function() {
                $this.maximize_animate(data);
            }
        );
    }

    this.maximize_animate = function (data) {
        var actualW = $chat.width();
        var actualH = $chat.height();
        var diffW = data.width - actualW;
        var diffH = data.height - actualH;

        // Fin de la recursion
        if (Math.abs(diffW) < 1 && Math.abs(diffH) < 1) {
            $this.maximize_end(data);
            return;
        }

        // Sinon
        var extraW = diffW * 0.4;
        var extraH = diffH * 0.4;

        var operW = (diffW > 0 ? "+=" : "-=");
        var operH = (diffH > 0 ? "+=" : "-=");
        var w = operW + Math.abs(diffW + extraW) + "px";
        var h = operH + Math.abs(diffH + extraH) + "px";

        var speed = 80;

        $chat.animate( {width: w, height: h}, speed, "linear",
            function() {
                $this.maximize_animate(data);
            }
        );
    }

    this.maximize_end = function (data) {
        data.end_callback();
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
        // On envoi le message
        sendRequest(
            "ajaxSendChatMessage",
            function(response, status, ajaxObj) {

                // Puis, on recupere les derniers chats
                sendRequest("ajaxGetLastChats", function(response, status, ajaxObj) {
                    // La réponse doit contenir les derniers messages publiés. Celui
                    // qui vient d'être envoyé inclus.
                    if (response) {
                        $this.add_new_messages(response);
                    }
                });
            },
            {"texte" : $('#chat #form-new-message textarea').val()}
        );
    }

    // Envoi de messages avec le bouton "Send"
    $("#chat #form-new-message button").click(this.send_new_message);

    // Envoi de messages avec la touche "Entrer"
    //$("#chat #form-new-message button").keypress(function () {}this.send_new_message);

    return this;

}
