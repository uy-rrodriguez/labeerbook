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


	public static function index($request,$context){

		return context::SUCCESS;

	}


	public static function login($request, $context) {
		if (!empty($request['login']) || !empty($request['password'])) {

            $user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['password']);
			if ($user) {
                $context->setSessionAttribute("user", $user);
				$context->setSessionAttribute("msgInfo", "Bonjour " . $user->identifiant);
                return context::SUCCESS;
			}
            else {
                $context->setSessionAttribute("msgErreur", "Login incorrect !");
                return context::ERROR;
            }
		}
		else {
			return context::ERROR;
		}
	}

    public static function logout($request, $context) {
        $context->setSessionAttribute("user", NULL);
		$context->setSessionAttribute("msgInfo", "Ciao " . $user->identifiant);
        return context::SUCCESS;
    }


    public static function showMessage($request, $context) {
        try {
        	        $idUser = $request["idUtilisateur"];
			        $user = utilisateurTable::getUserById($idUser);

			        if($user == NULL){
			        	return context::ERROR;
			        }
			        else{
			        	$messages = $user->messages;
				        $context->setSessionAttribute("userMessages", $user);
				        $context->setSessionAttribute("messages", $messages);

				        return context::SUCCESS;
        }
        } catch (Exception $e) {
        			echo "erreur";
        }


    }


    public static function showChats($request, $context) {
        try {
            /*
            $chats = chatTable::getChats();
            $lastChat = chatTable::getLastChat();

            $context->setSessionAttribute("chats", $chats);
            $context->setSessionAttribute("lastChat", $lastChat);
            */
            return context::SUCCESS;
        }
        catch (Exception $e) {
            $context->setSessionAttribute("msgErreur", $e->getMessage());
            return context::ERROR;
        }
    }


}
