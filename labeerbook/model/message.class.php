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

	/** 
	 *  @Column(type="integer") 
	 *  @OneToOne(targetEntity="utilisateur", inversedBy="messages")
	 *  @JoinColumn(name="emetteur", referencedColumnName="id")
	 */
	public $emetteur;

	/** 
	 *  @Column(type="integer")
	 *  @OneToOne(targetEntity="utilisateur")
	 *  @JoinColumn(name="destinataire", referencedColumnName="id")
	 */
	public $destinataire;

	/** 
	 *  @Column(type="integer") 
	 *  @OneToOne(targetEntity="utilisateur")
	 *  @JoinColumn(name="parent", referencedColumnName="id")
	 */
	public $parent;

	/** 
	 *  @Column(type="integer") 
     *  @OneToOne(targetEntity="post")
	 *  @JoinColumn(name="post", referencedColumnName="id")
	 */
	public $post;


	/** @Column(type="integer") */
	public $aimer;

}

?>