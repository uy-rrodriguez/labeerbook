<?php

/* Classe Outils en lien avec l'entité message
	composée de méthodes statiques
*/

class messageTable {

    /*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but de récupérer les messages publiés
	    	sur notre mur
	    
	/*//*//*/
	public static function getMessages($context){
        $em = dbconnection::getInstance()->getEntityManager();

        $user = $context->getSessionAttribute("user");
        //$chatRepository = $em->getRepository('chat');
        //$chats = $chatRepository->findAll();
        $query = $em->createQuery("SELECT m FROM message m WHERE m.destinataire = :id")
                    ->setMaxResults(20);
        $query->setParameter("id", $user->id);
        $messages = $query->getResult();


        

        return $messages;
	}




    /*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but de poster un message	    
	/*//*//*/
	public static function createMessage($message,$id){

		$em =dbconnection::getInstance()->getEntityManager();

		$newMessage = new message;
		$newMessage->emetteur = $id;
		$newMessage->destinataire = $id;
		$newMessage->parent = $id;
		$newMessage->aime = 0;

		$em->persist($newMessage);
		$em->flush();
	}

}


?>