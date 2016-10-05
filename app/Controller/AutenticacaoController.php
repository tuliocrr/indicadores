<?php
class AutenticacaoController extends AppController{
	
	public $uses = array("Usuario");
	
	public function beforeRender(){
		$this->layout = "login";
		parent::beforeRender();
	}
	
	public function index(){
		if($this->request->is('post')){
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa", "Departamento", "Perfil", "Conta")));
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
	
	public function esqueciminhasenha(){
		if($this->request->isPost()){
			$esqueciSenha = new EsqueciSenha();
			if($usuarioId = $esqueciSenha->verificaEmail($this->request->data['Usuario']['login'])){
				if($rash = $esqueciSenha->registraSolicitacaoSenha($usuarioId)){
					if($this->enviarEmailRecuperarSenha($usuarioId, $rash)){
						$this->Session->setFlash("Sua solicitação de nova senha foi enviada. Por favor, verifique seu e-mail", 'default', array('class'=>'message sucesso'));
						$this->redirect(array("controller"=>"Usuario", "action"=>"login"));
					}
				}
			}else{
				$this->Usuario->invalidate('login', 'Email não encontrado');
			}
		}
	}
	
	private function enviarEmailRecuperarSenha($usuarioId, $rash) {
	
		$usuario = new Usuario();
		$usuario = $usuario->find('first', array('conditions' => array('Usuario.id' => $usuarioId)));
	
		$link = "http://" . env('SERVER_NAME') . $this->webroot . "autenticacao/recuperarsenha/" . $rash;
	
		$email = new CakeEmail('smtp');
		$email->subject("[Civis][Indicadores] Recuperar Senha")
		->emailFormat('html')
		->template('\Emails\html\esqueci_senha')
		->viewVars(array('usuario' => $usuario, 'link' => $link))
		->from(array('contato@civis.com.br' => 'Civis Indicadores'))
		->to($usuario['Pessoa']['email']);
	
		return $email->send() ? true : false;
	}
	
	public function recuperarsenha($hash) {
	
		$esqueciSenha = new EsqueciSenha();
		$conditions = array('EsqueciSenha.hash' => $hash,'EsqueciSenha.ativo' => true, 'EsqueciSenha.data >= '=>date('Y-m-d H:i:s'));
	
		$retorno = $esqueciSenha->find('first', array('conditions' => $conditions));
	
		// SE NÃO HOUVER RETORNO, REDIRECIONA PARA A TELA DE ESQUECI MINHA SENHA
		if (!$retorno) {
			$this->Session->setFlash(__('Link para recuperar senha expirou / inativo. Por favor, tente novamente.'), 'default', array('class' => 'message error'));
			$this->redirect(array('action' => 'esqueciminhasenha'));
		}
	
		if ($this->request->is('post')) {
				
			$id = $retorno['Usuario']['id'];
			$this->request->data['Usuario']['id'] = $id;
			$this->Usuario->id = $id;
	
			// VALIDAÇÃO
			$validate = true;
			if(empty($this->request->data['Usuario']['nova_senha'])){
				$this->Usuario->invalidate('nova_senha', 'Campo obrigatório');
				$validate = false;
			}
			if(empty($this->request->data['Usuario']['confirmacao_nova_senha'])){
				$this->Usuario->invalidate('confirmacao_nova_senha', 'Campo obrigatório');
				$validate = false;
			}
			if(!empty($this->request->data['Usuario']['nova_senha']) && strlen($this->request->data['Usuario']['nova_senha']) < 6){
				$this->Usuario->invalidate('nova_senha', 'Campo deve conter no mínimo 6 caracteres');
				$validate = false;
			}
			if(!empty($this->request->data['Usuario']['nova_senha']) && !empty($this->request->data['Usuario']['confirmacao_nova_senha']) && $this->request->data['Usuario']['nova_senha'] != $this->request->data['Usuario']['confirmacao_nova_senha']){
				$this->Usuario->invalidate('confirmacao_nova_senha', 'Confirmação de senha inválida');
				$validate = false;
			}
			// FINAL DAS VALIDAÇÕES
	
			$db = $this->Usuario->getDataSource();
			$db->begin();
			$this->request->data['Usuario']['senha'] = AuthComponent::password($this->request->data['Usuario']['nova_senha']);
			if($validate && $this->Usuario->save($this->request->data)){
				$this->EsqueciSenha->id = $retorno['EsqueciSenha']['id'];
				if($this->EsqueciSenha->save(array('id'=>$retorno['EsqueciSenha']['id'],'ativo'=> false))){
					$db->commit();
					$this->Session->setFlash("Senha alterada com sucesso", 'default', array('class'=>'message sucesso'));
					$this->redirect(array("controller"=>"Usuario", "action"=>"login"));
				}else{
					$db->rollback();
				}
			}else{
				$db->rollback();
			}
		}
	
		$this->set('hash', $hash);
	}
	
}