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
class UsuariosController extends AppController{
	
	public $uses = array("Usuario", "Pessoa", "Perfil", "Cargo", "Vinculo", "Setor", "Departamento");
	
	public function index(){
		try{
			
			$this->setTitle("Usuários");
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa","Perfil","Vinculo")));
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Pessoa.nome'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Pessoa.nome'=>'Nome', 'Usuario.login'=>'Login', 'Perfil.titulo'=>'Perfil', 'Vinculo.titulo'=>'Vínculo'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
	public function adicionar(){
		try{
			
			$this->setTitle("Adicionar usuário");
			
			if($this->request->is('post')){
				$DS = $this->Usuario->getDataSource();
				$DS->begin();
				if($this->Usuario->adicionar($this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro adicionado com sucesso", "success");
					$this->redirect(array("action"=>"adicionar"));	
				}else{
					$DS->rollback();
				}
			}
			
			$this->set('perfis', $this->Perfil->listarAtivos('list'));
			$this->set('cargos', $this->Cargo->listarAtivos('list'));
			$this->set('vinculos', $this->Vinculo->listarAtivos('list'));
			$this->set('setores', $this->Setor->listarAtivos('list'));
			$this->set('departamentos', $this->Departamento->listarAtivos('list'));
			
		}catch(Exception $e){
			if(isset($DS)){$DS->rollback();}
			$this->trataExcecao($e);
		}
	}
	
	public function editar($id){
		
		try{
			
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa")));
			if(!$registro = $this->Usuario->findById($id)){
				throw new RegistroNaoEncontradoException($id);
			}
			
			$this->setTitle("Editar usuário");
			
			if($this->request->is('post')){

				$DS = $this->Usuario->getDataSource();
				$DS->begin();
				if($this->Usuario->editar($id, $this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));	
				}else{
					$DS->rollback();
				}
				
			}else{
				$this->request->data = $registro;
				unset($this->request->data['Usuario']['senha']);
			}
			
			$this->set('perfis', $this->Perfil->listarAtivos('list'));
			$this->set('cargos', $this->Cargo->listarAtivos('list'));
			$this->set('vinculos', $this->Vinculo->listarAtivos('list'));
			$this->set('setores', $this->Setor->listarAtivos('list'));
			$this->set('departamentos', $this->Departamento->listarAtivos('list'));
			
		}catch(Exception $e){
			if(isset($DS)){$DS->rollback();}
			$this->trataExcecao($e);
		}
		
	}				

	public function visualizar($id){
		try{
			$this->setTitle("Visualizar usuário");
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa", "Vinculo", "Perfil", "Cargo", "Setor", "Departamento")));
			if(!$registro = $this->Usuario->findById($id)){
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
			$this->Usuario->excluir($id);
			$this->Session->setFlash("Registro excluído com sucesso", "success");
			$this->redirect(array("action"=>"index"));
				
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
}
