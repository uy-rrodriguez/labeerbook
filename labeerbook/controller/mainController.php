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
			return context::SUCCESS;
		}

		else if (!empty($request['login']) || !empty($request['password'])) {
            try {
                $user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['password']);

                if ($user) {
                    $context->setSessionAttribute("user", $user);
                    $context->setSessionAttribute("userProfile", $user);
                    $context->setSessionAttribute("msgInfo", "Bonjour " . $user->identifiant);
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
    	Auteur : R.RODRIGUEZ
    /*//*//*/
    public static function showChats($request, $context) {
        try {
            $chats = chatTable::getChats();
            $lastChat = chatTable::getLastChat();

            $context->setSessionAttribute("chats", $chats);
            $context->setSessionAttribute("lastChat", $lastChat);

            return context::SUCCESS;
        }
        catch (Exception $e) {
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
	public static function editProfile($request,$context) {
		return context::SUCCESS;
	}

	public static function showProfile($request,$context) {
        //$id = $request["idProfile"];
        //$user = userData->get($id);
		//$context->setSessionAttribute("userProfile", $user);
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
	
}
