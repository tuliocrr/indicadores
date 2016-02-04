<?php
class RegistroNaoEncontradoException extends Exception{
	
	public function __construct($id){
		parent::__construct("Registro #{$id} não encontrado.");
	}
	
}