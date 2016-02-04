<?php
class PerfisController extends AppController{
	
	public $uses = array("Perfil");
	
	public function index(){
		try{
			
			$this->setTitle("Perfis");
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Perfil.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Perfil.titulo'=>'Título'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Perfil");
			if ($this->request->is('post')) {
				$DS = $this->Perfil->getDataSource();
				$DS->begin();
				if($this->Perfil->adicionar($this->request->data, $this->ControleDeAcesso)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
			$this->set('restricoes', $this->ControleDeAcesso->getRestricoes());
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}

	public function editar($id){
		try{
			
			$this->Perfil->bindModel(array("hasMany"=>array("Permissao"=>array("foreignKey"=>"perfil_id"))));
			if(!$registro = $this->Perfil->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Perfil");
			if ($this->request->is('post')) {
				$DS = $this->Perfil->getDataSource();
				$DS->begin();
				if($this->Perfil->editar($id, $this->request->data, $this->ControleDeAcesso)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->request->data = $registro;
			$permissoes = array() ;
			if(isset($this->request->data['Permissao']) && count($this->request->data['Permissao'])>0){
				foreach($this->request->data['Permissao'] as $permissao){
					$permissoes[] = $permissao['descricao'];
				}
			}
			$this->set('permissoes', $permissoes);
			$this->set('restricoes', $this->ControleDeAcesso->getRestricoes());
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}
	
	public function visualizar($id){
		try{
			
			$this->setTitle("Visualizar Perfil");
			$this->Perfil->bindModel(array("hasMany"=>array("Permissao"=>array("foreignKey"=>"perfil_id"))));
			if(!$registro = $this->Perfil->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$permissoes = array() ;
			if(isset($registro['Permissao']) && count($registro['Permissao'])>0){
				foreach($registro['Permissao'] as $permissao){
					$permissoes[] = $permissao['descricao'];
				}
			}
			$this->set('permissoes', $permissoes);
			$this->set('restricoes', $this->ControleDeAcesso->getRestricoes());
			$this->set("registro", $registro);
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function excluir($id){
		try{
			
			$this->autoRender = false;
			$this->Perfil->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}