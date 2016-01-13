<?php
class AutenticacaoController extends AppController{
	
	public $uses = array("Usuario", "Pessoa");
	
	public function beforeRender(){
		$this->layout = "login";
		parent::beforeRender();
	}
	
	public function index(){
		if($this->request->is('post')){
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa", "Departamento", "Perfil")));
			if($this->Auth->login()){
				$this->redirect($this->Auth->loginRedirect);
			}else{
				$this->Session->setFlash('Login e/ou Senha inválidos', 'danger');
			}
		}
	}
	
	public function logout(){
		$this->Auth->logout();
		$this->redirect($this->Auth->logoutRedirect);
	}
	
}