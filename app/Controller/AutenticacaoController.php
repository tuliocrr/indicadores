<?php
class AutenticacaoController extends AppController{
	
	public function beforeRender(){
		$this->layout = "login";
		parent::beforeRender();
	}
	
	public function index(){
		
	}
	
}