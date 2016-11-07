<?php

/** 
 * @Entity
 * @Table(name="fredouil.post")
 */
class post{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @Column(type="TEXT") */
	public $texte;

	/** @Column(type="TIMESTAMP") */
	public $date;

	/** @Column(type="string", length=45) */
	public $image;

}



?>