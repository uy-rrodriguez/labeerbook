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
	    	La méthode a pour but de récupérer les messages publiés
	    	sur notre mur
	    
	/*//*//*/
	public static function getMessagesByDestinataire($user){
		
        $em = dbconnection::getInstance()->getEntityManager();

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
	public static function createMessage($message,$user){

		$em =dbconnection::getInstance()->getEntityManager();

		$post = new post();
		$post->texte = $message;
		$post->date = new DateTime(date("Y-m-d H:i:s"));
		$post->image ="";



		$newMessage = new message();
		$newMessage->emetteur = $user;
		$newmessage->destinataire = $user;
		$newMessage->parent = $user;
		$newMessage->post = $post;
		$newMessage->aimer = 0;
		

		$em->persist($newMessage);
		$em->flush();

	}

}


?>