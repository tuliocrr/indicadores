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
class ProcedimentosController extends AppController{
	
	public $uses = array("Procedimento","Usuario","Pessoa");
	
	public function index(){
	
		try{
			
			$this->setTitle("Procedimentos");
			$this->Procedimento->recursive = 2;
			$this->Procedimento->bindModel(array("belongsTo"=>array("Usuario")));
			
			
			
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Procedimento.titulo'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Procedimento.titulo'=>'Título', 'Pessoa.nome'=>'Usuário'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			
			$this->setTitle("Adicionar Procedimentos");
			
			if ($this->request->is('post')) {
				
				$DS = $this->Procedimento->getDataSource();
				$DS->begin();
				
				if($this->Procedimento->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->set('usuarios', $this->Usuario->listarAtivos('list'));
			
		}catch(Exception $e){
			$this->trataExcecao($e, @$DS);
		}
	}

	public function editar($id){
		try{
			
			if(!$registro = $this->Procedimento->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Procedimento");
			if ($this->request->is('post')) {
				$DS = $this->Procedimento->getDataSource();
				$DS->begin();
				if($this->Procedimento->editar($id, $this->request->data)){
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
			
			$this->setTitle("Visualizar Procedimento");
			$this->Procedimento->recursive = 2;
			$this->Procedimento->bindModel(array("belongsTo"=>array("Usuario")));

			if(!$registro = $this->Procedimento->findById($id)){
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
			$this->Procedimento->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}