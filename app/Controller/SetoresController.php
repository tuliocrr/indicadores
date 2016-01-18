<?php
/**
 *
 * Copyright [2016] -  Civis Gestão Inteligente
 * Este arquivo é parte do programa Civis Estratégia
 * O civis estratégia é um software livre, você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF) na versão 2 da Licença.
 * Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA, sem uma garantia implícita de ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "licença GPL.odt", junto com este programa. Se não encontrar,
 * Acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA 
 *
 */
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