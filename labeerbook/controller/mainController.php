<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application
 *
 */

class mainController{

	public static function helloWorld($request,$context){
		$context->mavariable="hello world";
		return context::SUCCESS;
	}


	public static function index($request,$context) {
		return context::SUCCESS;
	}


	public static function login($request, $context) {
		if ($context->getSessionAttribute("user") != null) {
            // on fait appel à la méthode récupérant les messages
            mainController::ajaxGetMessages($request, $context);
			return context::SUCCESS;
		}

		else if (!empty($request['login']) || !empty($request['password'])) {
            try {
                $user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['password']);

                if ($user) {
                    $context->setSessionAttribute("user", $user);
                    $context->setSessionAttribute("userProfile", $user);
                    $context->setSessionAttribute("msgInfo", "Bonjour " . $user->identifiant);

                    // on fait appel à la méthode récupérant les messages
                     mainController::ajaxGetMessages($request, $context);

                    return context::SUCCESS;
                }
                else {
                    $context->setSessionAttribute("msgErreur", "Login incorrect !");
                    return context::ERROR;
                }
            }
            catch (Exception $e) {
                $context->setSessionAttribute("msgErreur", $e->getMessage());
                return context::ERROR;
            }
		}

		else {
			return context::ERROR;
		}
	}

    public static function showMessage($request, $context) {
        try {
            $idUser = $request["idUtilisateur"];
            $user = utilisateurTable::getUserById($idUser);

            if($user == NULL){
                return context::ERROR;
            }
            else {
                $context->setSessionAttribute("userMessages", $user);
                return context::SUCCESS;
            }
        }
         catch (Exception $e) {
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }

    /*//*//*/
    	Auteur : Q.CASTILLO
    /*//*//*/
    public static function showUsers($request, $context) {
    	try {
		$users = utilisateurTable::getUsers();

		$context->setSessionAttribute("users",$users);

		return context::SUCCESS;
	}
	catch(Exception $e) {
	    $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
	}
    }


    /*//*//*/
        Auteur : Q.CASTILLO
    /*//*//*/
    public static function showFriends($request, $context) {
        try{
            $friends = utilisateurTable::getUsers();
            $context->setSessionAttribute("friends", $friends);
            return context::SUCCESS;
        }
        catch (Exception $e) {
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }


    /*//*//*/
        Auteur : R.RODRIGUEZ
    /*//*//*/
	public static function showProfile($request, $context) {
        // Recherche de l'utilisateur
        $userProfile = null;
        if (key_exists("idProfile", $request)) {
            $userID = $request["idProfile"];
            $userProfile = utilisateurTable::getUserById($userID);
        }
        else {
            $userProfile = $context->getSessionAttribute("user");
        }

        // Controle du resultat
        if ($userProfile != null) {
            $messagesProfile = messageTable::getMessagesByDestinataire($userProfile);

            $context->setSessionAttribute("messagesProfile", $messagesProfile);
            $context->setSessionAttribute("userProfile", $userProfile);
        }
        else {
            return context::ERROR;
        }

        return context::SUCCESS;
	}

	public static function editProfile($request, $context) {
		return context::SUCCESS;
    }


	/* ************************************************************************** *
     * 								ACTIONS AJAX
     * ************************************************************************** */

    public static function ajaxLogout($request, $context) {
    	$user = $context->getSessionAttribute("user");
    	$context->setSessionAttribute("user", NULL);
        $context->setSessionAttribute("userProfile", NULL);
        return context::NONE;
    }


    /*//*//*/
        Auteur : Q.CASTILLO
        Description:
            On recupere les nouvelles infos du profil et on modifie
    /*//*//*/
	public static function ajaxEditProfile($request, $context) {
		var_dump($request);die;
		$user = $context->getSessionAttribute("user");

		$user->nom = $request['nom'];
		$user->prenom = $request['prenom'];
		$user->statut = $request['status'];
		$user->pass = $request['password'];


		utilisateurTable::modifUser($user);

        return context::SUCCESS;
    }


    /*//*//*/
        Auteur : Q.CASTILLO
        Description:
            On recupere le message à afficher avec l'id de celui qui écrit et l'id du profil
            sur lequel on se trouve
    /*//*//*/
    public static function ajaxAddMessage($request, $context) {
        try{
            $userActuel = $context->getSessionAttribute("user");

            $newMessage = MessageTable::createMessage($message,$userActuel->id);
            return context::SUCCESS;

        }catch  (Exception $e){
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }


    /*//*//*/
        Auteur : Q.CASTILLO
        Description:
            Affiche tous les messages
    /*//*//*/
    public static function ajaxGetMessages($request, $context) {
        try{

            $messages = messageTable::getMessages($context);

            $context->setSessionAttribute("messages", $messages);
            return context::SUCCESS;

        } catch( Exception $e){
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }

    /*//*//*/
        Auteur : Q.CASTILLO
        Description:
            Récupère l'id de la personne sur qui on a cliqué et nous envoie
            sur son profil.
    /*//*//*/
    public static function ajaxShowProfile($request, $context) {

    }

    /*//*//*/
    	Auteur : R.RODRIGUEZ
        Description:
            On recupere tous les chats de la BDD et on stocke l'ID du dernier.
    /*//*//*/
    public static function ajaxShowChats($request, $context) {
        try {
            $chats = chatTable::getChats();

            $context->setSessionAttribute("chats", $chats);

            // On stocke le dernier ID
            $context->setSessionAttribute("lastChatID", $chats[count($chats)-1]->id);

            return context::SUCCESS;
        }
        catch (Exception $e) {
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }

    /*//*//*/
    	Auteur : R.RODRIGUEZ
        Description:
            On recupere tous les chats de la BDD qui ont ete crees apres la derniere recherche.
            On stocke l'ID du dernier.
    /*//*//*/
    public static function ajaxGetLastChats($request, $context) {
        try {
            // On recupere la liste des derniers chats
            $lastChats = chatTable::getLastChats($context->getSessionAttribute("lastChatID"));
            $context->setSessionAttribute("lastChats", $lastChats);

            // On stocke le dernier ID
            if (count($lastChats) > 0)
                $context->setSessionAttribute("lastChatID", $lastChats[count($lastChats)-1]->id);

            return context::SUCCESS;
        }
        catch (Exception $e) {
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }

    /*//*//*/
    	Auteur : R.RODRIGUEZ
        Description:
            On ajoute le nouveau message de chat et on récupère tous les chats de la BDD
            crées après la dernière mise-à-jour.
    /*//*//*/
    public static function ajaxSendChatMessage($request, $context) {
        $user = $context->getSessionAttribute("user");

        // Ajout du message
        chatTable::addChatMessage($user, $request['texte']);

        /*
        // Listing des derniers messages
        $lastChats = chatTable::getLastChats($context->getSessionAttribute("lastChatID"));

        // On stocke le dernier ID
        if (count($lastChats) > 0)
            $context->setSessionAttribute("lastChatID", $lastChats[count($lastChats)-1]->id);
        */

        return "Chat crée OK";
    }

}
