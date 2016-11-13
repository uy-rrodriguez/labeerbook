<?php

/*
    Classe Outils en lien avec l'entité chat composée de méthodes statiques.
*/

class chatTable {

    /*//*//*/
	    Auteur : R.RODRIGUEZ
	    Description :
	    	La méthode a pour but de récupérer tous les chats dans la BDD.
	    Sortie :
			$chats => Liste de tous les chats dans le système.
	/*//*//*/

    public static function getChats() {
        $em = dbconnection::getInstance()->getEntityManager();

        $chatRepository = $em->getRepository('chat');
        $chats = $chatRepository->findAll();

        return $chats; // Miaouuu
    }


    /*//*//*/
	    Auteur : R.RODRIGUEZ
	    Description :
	    	La méthode a pour but de récupérer le dernier chat publié.
            On utilise un Query personnalisée.
	    Sortie :
			$lastChat => Correspond au dernier chat publié, le seul trouvé par la requête.
	/*//*//*/

    public static function getLastChat() {
        $em = dbconnection::getInstance()->getEntityManager();

        $query = $em->createQuery("SELECT c FROM chat c WHERE c.id = (SELECT MAX(c2.id) FROM chat c2)");
        $lastChat = $query->getSingleResult();

        return $lastChat;
    }

}

?>
