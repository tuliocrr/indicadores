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
 
App::uses('Util', 'Lib');

class ObjetivosController extends AppController{
	
	public $uses = array("Objetivo","Usuario","Dimensao");
	
	public function index(){
	
		try{
			
			
			$this->setTitle("Objetivos");
			$this->Objetivo->bindModel(array("belongsTo"=>array("Usuario")));
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa")));
			$this->Objetivo->recursive = 2;
			
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['recursive'] = 2;
			$this->paginate['joins'][] = array('type'=>'inner', 'alias'=>'PessoaJoin', 'table'=>'pessoas' ,'conditions'=>"Usuario.pessoa_id = PessoaJoin.id");
			$this->paginate['order'] = array('Objetivo.titulo'=>'asc');
			
			$this->set('lista', $this->paginate()); 
			$this->set('options', array('Objetivo.titulo'=>'Título', 'Pessoa.nome'=>'Reponsável'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}

	public function adicionar(){
		try{
			$this->setTitle("Adicionar Objetivo");
			if ($this->request->is('post')) {
				$DS = $this->Objetivo->getDataSource();
				$DS->begin();
				if($this->Objetivo->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));
				}else{
					$DS->rollback();
				}
			}
			$this->set('objetivos', $this->Objetivo->listarAtivos('list'));
			$this->set('usuarios', $this->Usuario->listarAtivos('list'));
			$this->set('dimensoes', $this->Dimensao->listarAtivos('list'));
			$this->set('anos', Util::retornaAnos(date("Y")+5, date("Y")-5));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}

	public function editar($id){
		try{
			
			if(!$registro = $this->Objetivo->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar Objetivo");
			if ($this->request->is('post')) {
				$DS = $this->Objetivo->getDataSource();
				$DS->begin();
				if($this->Objetivo->editar($id, $this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->request->data = $registro;
			$this->set('objetivos', $this->Objetivo->listarAtivos('list'));
			$this->set('usuarios', $this->Usuario->listarAtivos('list'));
			$this->set('dimensoes', $this->Dimensao->listarAtivos('list'));
			$this->set('anos', Util::retornaAnos(date("Y")+5, date("Y")-5));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}
	
	public function visualizar($id){
		try{
			
			$this->setTitle("Visualizar Objetivo");
			if(!$registro = $this->Objetivo->findById($id)){
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
			$this->Objetivo->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}