<?php

/*//*//*/
    Auteur : Q.CASTILLO/R.RODRIGUEZ
/*//*//*/

/**
 * @Entity
 * @Table(name="fredouil.post")
 */
class post {

	/**
	 *  @Id @Column(type="integer")
	 *  @GeneratedValue
	 */
	public $id;

	/** @Column(type="string", length=2000) */
	public $texte;

	/** @Column(type="TIMESTAMP") */
	public $date;

	/** @Column(type="string", length=200) */
	public $image;


	/**
	 *  @ManyToOne(targetEntity="message", mappedBy="post")
	 */
	public $messages;

	/**
	 *  @ManyToOne(targetEntity="chat", mappedBy="post")
	 */
	public $chats;

}



?>
