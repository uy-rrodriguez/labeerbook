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

	// On a supprime @Column(type="integer") pour obtenir un objet utilisateur dans
	// l'attribut $emetteur.
	/**
     *  @OneToOne(targetEntity="utilisateur", inversedBy="chats", fetch="LAZY")
     *  @JoinColumn(name="emetteur", referencedColumnName="id")
	 */
	public $emetteur;

	// On a supprime @Column(type="integer") pour obtenir un objet post dans
	// l'attribut $post.
	/**
     *  @OneToOne(targetEntity="post", inversedBy="chats", fetch="LAZY")
     *  @JoinColumn(name="post", referencedColumnName="id")
	 */
	public $post;

}

?>
