<?php

/* Classe Outils en lien avec l'entité utilisateur
	composée de méthodes statiques
*/

class utilisateurTable {

	public static function getUserByLoginAndPass($login,$pass){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	

		return $user; 
	}


	/*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but de récupérer un utilisateur à partir
	    	de son ID.
	    Entrée :
			$id   => Entier 
	    Sortie :
			$user => Objet de la classe utilisateur
	/*//*//*/
	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->find($id);	

		return $user; 
	}


	/*//*//*/
	    Auteur : Q.CASTILLO
	    Description : 
	    	La méthode a pour but de récupérer l'ensemble des 
	    	utilisateurs de la table fredouil.utilisateur
	    Sortie :
			$user => Tableau d'objets de la classe utilisateur
	/*//*//*/
	public static function getUsers(){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findAll();

		return $user;
	}

}

?>
