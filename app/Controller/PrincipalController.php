<?php
class PrincipalController extends AppController{
	
	public function index(){
		
	}
	
	
	public function excluirfiltro($controller, $key){
		unset($_SESSION['Search'][$controller][$key]);
		$this->redirect(array('controller'=>$controller,'action'=>'index'));
		exit;
	}
	
}