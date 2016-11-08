<?php

/*//*//*/
    Auteur : Q.CASTILLO/R.RODRIGUEZ
/*//*//*/

/**
 * @Entity
 * @Table(name="fredouil.chat")
 */
class chat {

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */
	public $id;

	/**
	 *  @Column(type="integer")
     *  @OneToOne(targetEntity="utilisateur", inversedBy="chats")
     *  @JoinColumn(name="emetteur", referencedColumnName="id")
	 */
	public $emetteur;

	/**
	 *  @Column(type="integer")
     *  @OneToOne(targetEntity="post", inversedBy="chats")
     *  @JoinColumn(name="post", referencedColumnName="id")
	 */
	public $post;

}

?>
