<?php

/*
    Classe Outils en lien avec l'entité chat composée de méthodes statiques.
*/

class chatTable {
u
ne méthode
getLastChat()
permettant de récupérer le dernier message posté sur le chat.

    public static function getChats() {
        $em = dbconnection::getInstance()->getEntityManager();

        $chatRepository = $em->getRepository('chat');
        $chats = $chatRepository->findAll();

        return $chats; // Miaouuu
    }

    public static function getLastChat() {
        $em = dbconnection::getInstance()->getEntityManager() ;

        $query = $em->createQuery("SELECT c FROM chat c WHERE c.id = (SELECT MAX(c2.id) FROM chat c2)");
        $results = $query->getResult();

        if (count($results) > 0)
            return $results[0];
        else
            return NULL;
    }

}

?>
