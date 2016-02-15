<?php
class ProdutosController extends AppController{
	
	public $uses = array("Produto","TipoProduto");
	
	public function index(){
		try{
			
			$this->setTitle("Produtos");
			$this->Produto->bindModel(array("belongsTo"=>array("TipoProduto")));
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Produto.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Produto.titulo'=>'Título','Produto.valor'=>'Valor','Produto.referencia'=>'Referência','Produto.perda'=>'Perda(%)','TipoProduto.titulo'=>'Tipo'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Produto");
			if ($this->request->is('post')) {
				$DS = $this->Produto->getDataSource();
				$DS->begin();
				if($this->Produto->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
			$this->set('tipo_produto', $this->TipoProduto->listarAtivos('list'));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}

	public function editar($id){
		try{
			
			if(!$registro = $this->Produto->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Produto");
			if ($this->request->is('post')) {
				$DS = $this->Produto->getDataSource();
				$DS->begin();
				if($this->Produto->editar($id, $this->request->data)){
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
			
			$this->setTitle("Visualizar Produto");
			if(!$registro = $this->Produto->findById($id)){
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
			$this->Produto->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}