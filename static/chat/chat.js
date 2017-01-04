/* ***************************  CHAT  ********************************** */
/* Auteur : R.RODRIGUEZ                                                  */
/* Description :                                                         */
/*     Fonctions pour controller le fonctionnement du chat.              */
/*     On definit une classe JavaScript "Chat".                          */
/* ********************************************************************* */

// Initialisation du chat après le chargement de la page
$(function() {
    Chat();
});


// Initialisation. On crée un objet global qui stocke le chat
var Chat = function () {

    // Pointeur vers la classe
    var parent = this;

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



    // Cet attribut va nous indiquer si les chqts on ete recuperes de la
    // BDD une premiere fois
    var chatsLoaded = false;

    // On va activer le timer (interval) qui va chercher les derniers chats toutes les 15 secondes.
    // (sendRequest est defini dans ajax.js)
    /*
    setInterval(
        function() {
            sendRequest("ajaxGetLastChats", function(response, status, ajaxObj) {
                $('#chat-contenu').append(response.data);
                parent.notification();
            });
        }
        , 3000);
    */


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

        $chat.css("top", $chat.position().top);
        $chat.css("left", $chat.position().left);
        $chat.css("bottom", "auto");
        $chat.css("right", "auto");
    }

    this.resize_stop = function (event, ui) {
        var state = resizeData.beforeState;

        $chat.css("top", state.top);
        $chat.css("left", state.left);
        $chat.css("bottom", state.bottom);
        $chat.css("right", state.right);

        // On stocke dans l'objet chat l'info. de la dernière taille
        resizeData.maximized = {
            width:     $chat.width(),
            height:    $chat.height()
        };
    }

    // Initialisation de resizable
    $chat.resizable({
        handles: "se",
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
        $chat.addClass("chat-bzzz");

        $chat.animate( { left: "-=5px" }, 100, "linear" );

        for (var i = 0; i < 5; i++) {
            $chat.animate( { left: "+=10px" }, 100, "linear" );
            $chat.animate( { left: "-=10px" }, 100, "linear" );
        }

        $chat.animate( { left: "+=5px" }, 100, "linear",
            function () {
                $chat.removeClass("chat-bzzz");
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
        $chat.animate(
            {
                width: resizeData.minimized.width + "px",
                height: resizeData.minimized.height + "px"
            },
            200,
            "linear",
            function () {
                $chat.addClass("minimise");
                $chat.removeClass("maximise");
            }
        );
    }

    this.maximize = function () {
        var data = {
            width:        resizeData.maximized.width,
            height:       resizeData.maximized.height,

            end_callback: function () {
                $chat.removeClass("minimise");
                $chat.addClass("maximise");

                // On va charger par AJAX les chats existants
                // (showChats se trouve dans le fichier ajax.js)
                if (! this.chatsLoaded) {
                    showChats();
                    this.chatsLoaded = true;
                }
            }
        };

        parent.maximize_start(data);
    }

    /*
    function maximize_get_position(target) {
        var win = $(window);
        var left = target.position.left;
        var top = target.position.top;
        var right = win.width() - (left + target.width());
        var bottom = win.height() - (top + target.height());
        return {
            left:     left,
            right:    right,
            top:      top,
            bottom:   bottom
        };
    }

    function maximize_fix_position(target) {
        var pos = maximize_get_position(target);
        var state = {
            top:        target.css("top") ? target.css("top") : "auto",
            bottom:     target.css("bottom") ? target.css("bottom") : "auto",
            left:       target.css("left") ? target.css("left") : "auto",
            right:      target.css("right") ? target.css("right") : "auto",
            position:   target.css("position") ? target.css("position") : "auto"
        };

        // Fixed left / right
        if (pos.left < pos.right) {
            target.css("right", "auto");
        }
        else {
            target.css("left", "auto");
            target.css("right", pos.right);
        }

        // Fixed top / bottom
        if (pos.top < pos.bottom) {
            target.css("bottom", "auto");
        }
        else {
            target.css("top", "auto");
            target.css("bottom", pos.bottom);
        }

        target.css("position", "fixed");

        return state;
    }

    function maximize_restore_position(target, state) {
        var pos = maximize_get_position(target);

        target.css("position") = state.position;
        target.css("top") = state.top;
        target.css("bottom") = state.bottom;
        target.css("left") = state.left;
        target.css("right") = state.right;
    }
    */

    this.maximize_start = function (data) {
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
                parent.maximize_animate(data);
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
            parent.maximize_end(data);
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
                parent.maximize_animate(data);
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
            // Cas chat minimise
            if ($chat.hasClass("minimise"))
                parent.maximize();

            // Cas chat maximise
            else
                parent.minimize();
        }
    });

}
