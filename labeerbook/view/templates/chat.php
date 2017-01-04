<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
        Description :
            Affiche une bulle, si on clique sur la bulle on affiche une fenetre de chat.
	/*//*//*/

    /*
	$chatTemplate = $context->getSessionAttribute("chatTemplate");
	echo "<b>" . $chatTemplate->post->texte . "</b>";
	echo ", créé par <b>" . $chatTemplate->emetteur->identifiant . "</b>";
	echo ", le <b>" . $chatTemplate->post->date->format("d/m/Y H:i") . "</b>";
	echo ".";
    */

    // On recupere les chats de la session
    $chats = $context->getSessionAttribute("chats");


    // Contenu de test
    /*
    $chats = array();

    for ($i = 0; $i < 10; $i++) {

        $e = new utilisateur();
        $e->identifiant = "Test";

        $p = new post();
        $p->texte = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco";
        $p->date = "10/12/2016 2:57";

        $c = new chat();
        $c->id = $i + 1;
        $c->emetteur = $e;
        $c->post = $p;

        $chats[] = $c;
    }
    */
?>

<!--<div id="chat-wrapper">-->
    <div id="chat" class="minimized hidden-xs">

        <!-- Pour tester la notification d'un nouveau message -->
        <!-- <button id="chat-btn-test">Simuler notification</button> -->

        <img id="chat-biere" class="img" src="static/img/beer-1.png">

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
                    <div class="form-group container-fluid">
                        <div class="row">
                            <div class="col-sm-8">
                                <textarea class="form-control" name="message" placeholder="Message au chat"></textarea>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-default">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<!--</div>-->
