<?php

/*//*//*/
    Auteur : R.RODRIGUEZ/Q.CASTILLO
/*//*//*/

/**
 * @Entity
 * @Table(name="fredouil.utilisateur")
 */
class utilisateur {

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */
	public $id;

	/** @Column(type="string", length=45) */
	public $identifiant;

	/** @Column(type="string", length=45) */
	public $pass;

	/** @Column(type="string", length=45) */
	public $nom;

	/** @Column(type="string", length=45) */
	public $prenom;

	/** @Column(type="string", length=100) */
	public $statut;

	/** @Column(type="string", length=200) */
	public $avatar;

	/** @Column(type="TIMESTAMP") */
	public $date_de_naissance;


	/**
	 * @OneToMany(targetEntity="message", mappedBy="emetteur")
	 */
	public $messages;

	/**
	 * @OneToMany(targetEntity="chat", mappedBy="emetteur")
	 */
	public $chats;

}

?>
