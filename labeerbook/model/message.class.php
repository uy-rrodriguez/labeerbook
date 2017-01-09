<?php

/*//*//*/
    Auteur : Q.CASTILLO/R.RODRIGUEZ
/*//*//*/

/**
 * @Entity
 * @Table(name="fredouil.message")
 */
class message {

	/**
	 *  @Id @Column(type="integer")
	 *  @GeneratedValue
	 */
	public $id;

    // On a supprime @Column(type="integer") pour obtenir un objet utilisateur dans
	// l'attribut $emetteur. La récupération est faite de manière LAZY.
	/**
	 *  @OneToOne(targetEntity="utilisateur", inversedBy="messages", fetch="LAZY")
	 *  @JoinColumn(name="emetteur", referencedColumnName="id")
	 */
	public $emetteur;

    // On a supprime @Column(type="integer") pour obtenir un objet utilisateur dans
	// l'attribut $destinataire. La récupération est faite de manière LAZY.
	/**
	 *  @OneToOne(targetEntity="utilisateur", fetch="LAZY")
	 *  @JoinColumn(name="destinataire", referencedColumnName="id")
	 */
	public $destinataire;

    // On a supprime @Column(type="integer") pour obtenir un objet utilisateur dans
	// l'attribut $parent. La récupération est faite de manière LAZY.
	/**
	 *  @OneToOne(targetEntity="utilisateur", fetch="LAZY")
	 *  @JoinColumn(name="parent", referencedColumnName="id")
	 */
	public $parent;

    // On a supprime @Column(type="integer") pour obtenir un objet post dans
	// l'attribut $post. La récupération est faite de manière LAZY.
	/**
     *  @OneToOne(targetEntity="post", fetch="LAZY")
	 *  @JoinColumn(name="post", referencedColumnName="id")
	 */
	public $post;

	/** @Column(type="integer") */
	public $aime;

}

?>
