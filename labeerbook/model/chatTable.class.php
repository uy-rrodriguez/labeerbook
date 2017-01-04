<?php

/*
    Classe Outils en lien avec l'entité chat composée de méthodes statiques.
*/

class chatTable {

    /*//*//*/
	    Auteur : R.RODRIGUEZ
	    Description :
	    	La méthode a pour but de récupérer tous les chats dans la BDD, mais limité aux 20 derniers.
	    Sortie :
			$chats => Liste de tous les chats dans le système.
	/*//*//*/

    public static function getChats() {
        $em = dbconnection::getInstance()->getEntityManager();

        //$chatRepository = $em->getRepository('chat');
        //$chats = $chatRepository->findAll();
        $query = $em->createQuery("SELECT c FROM chat c JOIN c.post p ORDER BY c.id DESC");
                    //->setMaxResults(20);
        $chats = $query->getResult();
        $chats = array_reverse($chats);

        return $chats;
    }


    /*//*//*/
	    Auteur : R.RODRIGUEZ
	    Description :
	    	La méthode a pour but de récupérer les derniers chats publiés.
            On utilise un Query personnalisée.
	    Sortie :
			$lastChats => Correspondent aux derniers chats publiés.
	/*//*//*/

    public static function getLastChats($lastID) {
        $em = dbconnection::getInstance()->getEntityManager();

        //$query = $em->createQuery("SELECT c FROM chat c JOIN c.post p WHERE p.date = (SELECT MAX(p2.date) FROM chat c2 JOIN c2.post p2)");
        $query = $em->createQuery("SELECT c FROM chat c JOIN c.post p WHERE c.id > :lastID ORDER BY c.id ASC");
        $query->setParameter("lastID", $lastID);
        $lastChats = $query->getResult();

        return $lastChats;
    }

}

?>
