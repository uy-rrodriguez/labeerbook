<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
        Description :
            Affiche une bulle, si on clique sur la bulle on affiche une fenetre de chat.
	/*//*//*/

    // On recupere les chats de la session
    $chats = $context->getSessionAttribute("chats");
?>

<!--<div id="chat-wrapper">-->
    <div id="chat" class="minimized hidden-xs">

        <!-- Pour tester la notification d'un nouveau message -->
        <!-- <button id="chat-bzzz-test">Simuler notification</button> -->

        <img id="chat-bzzz-biere" class="img" src="static/img/beer-1.png">

        <div id="chat-container">

            <div id="chat-bulle">
                <span>
                    Chat
                </span>
                <!--
                <svg xmlns="http://www.w3.org/2000/svg" style="height:10px;width:10px;">
                    <circle cx="5" cy="5" r="5" fill="green" />
                </svg>
                -->
            </div>


            <div id="chat-contenu">
                <!-- Ici on va afficher la liste de chats recupere par AJAX -->
                <svg id="img-loading">
                    <image xlink:href="static/img/loading.svg" src="static/img/loading.png" width="100%" height="100%" />
                </svg>
            </div>

            <div id="chat-form">
                <form method="post" action="#">
                    <div class="form-group">
                        <div id="chat-form-col-text">
                            <textarea class="form-control" name="message" placeholder="Message au chat"></textarea>
                        </div>
                        <div id="chat-form-col-btn">
                            <button type="button" class="btn btn-default">Send</button>
                        </div>
                        <div>
                            <span class="label label-info">[Entrer] envoie le message.</span>
                        </div>
                        <div>
                            <span class="label label-info">[Ctrl]+[Enter] retour à la ligne.</span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<!--</div>-->
