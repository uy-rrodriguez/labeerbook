<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application 
 *
 */

class mainController{

	public static function helloWorld($request,$context){
		$context->mavariable="hello world";
		return context::SUCCESS;
	}


	public static function index($request,$context){
			
		return context::SUCCESS;

	}


	public static function login($request, $context){
		if(!empty($_POST['login']) && !empty($_POST['password']))
		{
			
			if( utilisateurTable::getUserByLoginAndPass($_POST['login'],$_POST['password']) )
			{
				return context::SUCCESS;
			}
		}
		else{
			return context::ERROR;
		}
	}



}
