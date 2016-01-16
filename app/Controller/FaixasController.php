<?php
class FaixasController extends AppController{
	
	public $uses = array("Faixa");
	
	public function index(){
		try{
			
			$this->setTitle("Faixas");
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Faixa.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Faixa.titulo'=>'Título'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Faixa");
			if ($this->request->is('post')) {
				$DS = $this->Faixa->getDataSource();
				$DS->begin();
				if($this->Faixa->adicionar($this->request->data)){
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
			
			if(!$registro = $this->Faixa->findById($id)){
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->setTitle("Editar Faixa");
			if ($this->request->is('post')) {
				$DS = $this->Faixa->getDataSource();
				$DS->begin();
				if($this->Faixa->editar($id, $this->request->data)){
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
			
			$this->setTitle("Visualizar Faixa");
			if(!$registro = $this->Faixa->findById($id)){
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
			$this->Faixa->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}