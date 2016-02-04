<?php
class VinculosController extends AppController{
	
	public $uses = array("Vinculo");
	
	public function index(){
		
		try{
			
			$this->setTitle("Vínculos");
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Vinculo.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Vinculo.titulo'=>'Título'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Vínculo");
			if ($this->request->is('post')) {
				$DS = $this->Vinculo->getDataSource();
				$DS->begin();
				if($this->Vinculo->adicionar($this->request->data)){
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
			
			if(!$registro = $this->Vinculo->findById($id)){
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->setTitle("Editar Vínculo");
			if ($this->request->is('post')) {
				$DS = $this->Vinculo->getDataSource();
				$DS->begin();
				if($this->Vinculo->editar($id, $this->request->data)){
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
			
			$this->setTitle("Visualizar Vínculo");
			if(!$registro = $this->Vinculo->findById($id)){
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->set("registro", $registro);
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function excluir($id){
		try{
			
			$this->autoRender = false;
			$this->Vinculo->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}
?>