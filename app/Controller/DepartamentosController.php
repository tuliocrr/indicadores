<?php
class DepartamentosController extends AppController{
	
	public $uses = array("Departamento");
	
	public function index(){
		
		try{
			
			$this->setTitle("Departamentos");
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Departamento.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Departamento.titulo'=>'Título'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Departamento");
			if ($this->request->is('post')) {
				$DS = $this->Departamento->getDataSource();
				$DS->begin();
				if($this->Departamento->adicionar($this->request->data)){
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
			
			if(!$registro = $this->Departamento->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Departamento");
			if ($this->request->is('post')) {
				$DS = $this->Departamento->getDataSource();
				$DS->begin();
				if($this->Departamento->editar($id, $this->request->data)){
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
			
			$this->setTitle("Visualizar Departamento");
			if(!$registro = $this->Departamento->findById($id)){
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
			$this->Departamento->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}
?>