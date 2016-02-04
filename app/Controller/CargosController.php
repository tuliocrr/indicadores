<?php
class CargosController extends AppController{
	
	public $uses = array("Cargo");
	
	public function index(){
		try{
			
			$this->setTitle("Cargos");
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Cargo.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Cargo.titulo'=>'Título', 'Cargo.descricao'=>'Descrição'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Cargo");
			if ($this->request->is('post')) {
				$DS = $this->Cargo->getDataSource();
				$DS->begin();
				if($this->Cargo->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}

	public function editar($id){
		try{
			
			if(!$registro = $this->Cargo->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Cargo");
			if ($this->request->is('post')) {
				$DS = $this->Cargo->getDataSource();
				$DS->begin();
				if($this->Cargo->editar($id, $this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->request->data = $registro;
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}
	
	public function visualizar($id){
		try{
			
			$this->setTitle("Visualizar Cargo");
			if(!$registro = $this->Cargo->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			$this->set("registro", $registro);
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function excluir($id){
		try{
			
			$this->autoRender = false;
			$this->Cargo->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}