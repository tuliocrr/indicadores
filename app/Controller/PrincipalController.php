<?php
class PrincipalController extends AppController{
	
	public $uses = array("Produto","TipoProduto");
	
	public function index(){
			if(!$produtos = $this->Produto->find("all")){
				throw new RegistroNaoEncontradoException('');
			}
			
			$this->set("produtos", $produtos);
		
	}
	
	
	public function excluirfiltro($controller, $key){
		unset($_SESSION['Search'][$controller][$key]);
		$this->redirect(array('controller'=>$controller,'action'=>'index'));
		exit;
	}
	
}