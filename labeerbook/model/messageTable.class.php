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
	public static function createMessage($message,$user,$destinataire,$parent){

		$em =dbconnection::getInstance()->getEntityManager();

		$post = new post();
		$post->texte = $message;
		$post->date = new DateTime();
		$post->image ="";

		$em->persist($post);
        $em->flush();

        $userRepository = $em->getRepository("utilisateur");
        $user = $userRepository->findOneBy(array('id' => $user->id));
        $destinataire = $userRepository->findOneBy(array('id' => $destinataire->id));
        $parent = $userRepository->findOneBy(array('id' => $parent->id));

		$newMessage = new message();
		$newMessage->emetteur = $user;
		$newMessage->destinataire = $destinataire;
		$newMessage->parent = $parent;
		$newMessage->post = $post;
		$newMessage->aime = 0;
		

		$em->persist($newMessage);
		$em->flush();

	}

	/*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but de liker le message
	/*//*//*/
	public static function addLike($idMessage){

		$em =dbconnection::getInstance()->getEntityManager();

		$messageRepository = $em->getRepository("message");
		$message = $messageRepository->findOneBy(array('id'=> $idMessage));

		$message->aime++;

		$em->persist($message);
		$em->flush();

	}

		/*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but partager un message sur notre mur  
	/*//*//*/
	public static function shareMessage($idMessage,$user,$userProfile){
		$em =dbconnection::getInstance()->getEntityManager();

		$messageRepository = $em->getRepository("message");
		$message = $messageRepository->findOneBy(array('id'=> $idMessage));
		$texte = $message->post->texte;

		messageTable::createMessage($texte,$user,$user,$userProfile);
	}

}


?>