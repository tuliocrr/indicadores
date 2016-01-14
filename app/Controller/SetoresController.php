<?php
class SetoresController extends AppController{
	
	public $uses = array("Setor", "TipoSetor");
	
	public function index(){
		try{
			
			$this->setTitle("Setores");
			$this->Setor->bindModel(array("belongsTo"=>array("TipoSetor")));
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Setor.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Setor.titulo'=>'Título'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Setor");
			if ($this->request->is('post')) {
				$DS = $this->Setor->getDataSource();
				$DS->begin();
				if($this->Setor->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->set("tipos", $this->TipoSetor->listarAtivos("list"));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}

	public function editar($id){
		try{
			
			if(!$registro = $this->Setor->findById($id)){
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->setTitle("Editar Setor");
			if ($this->request->is('post')) {
				$DS = $this->Setor->getDataSource();
				$DS->begin();
				if($this->Setor->editar($id, $this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->request->data = $registro;
			
			$this->set("tipos", $this->TipoSetor->listarAtivos("list"));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}
	
	public function visualizar($id){
		try{
			
			$this->setTitle("Visualizar Setor");
			if(!$registro = $this->Setor->findById($id)){
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
			$this->Setor->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}