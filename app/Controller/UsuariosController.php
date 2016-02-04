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
				
				$this->Pessoa->set($this->request->data["Pessoa"]);
				$this->Usuario->set($this->request->data["Usuario"]);
				
				if($this->Pessoa->validates() && $this->Usuario->validates()){
				
					$DS = $this->Pessoa->getDataSource();
	
					if($this->Pessoa->save($this->request->data)){
						$this->request->data["Usuario"]["pessoa_id"] = $this->Pessoa->id;
						if($this->Usuario->save($this->request->data)){
							$DS->commit();
							$this->Session->setFlash("Registro adicionado com sucesso", "success");
							$this->redirect(array("action"=>"adicionar"));
						}else{
							$this->Session->setFlash("Erro ao tentar salvar registro", "danger");
							$DS->rollback();
						}
					}else{
						$this->Session->setFlash("Erro ao tentar salvar registro", "danger");
						$DS->rollback();
					}
				
				}else{
					$this->Session->setFlash("Seu formulário possui pendências de validação", "danger");
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
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->setTitle("Editar usuário");
			
			if($this->request->is('post')){

				$this->Pessoa->set($this->request->data["Pessoa"]);
				$this->Usuario->set($this->request->data["Usuario"]);
				
				if($this->Pessoa->validates() && $this->Usuario->validates()){
					
					$DS = $this->Pessoa->getDataSource();
				
					$this->Pessoa->id = $this->request->data["Pessoa"]["id"];
					if($this->Pessoa->save($this->request->data)){ 
						$this->Usuario->id = $this->request->data["Usuario"]["id"];
						if($this->Usuario->save($this->request->data)){
							$DS->commit();
							$this->Session->setFlash("Registro editado com sucesso", "success");
							$this->redirect(array("action"=>"index"));
						}else{
							$this->Session->setFlash("Erro ao tentar salvar registro", "danger");
							$DS->rollback();
						}
					}else{
						$this->Session->setFlash("Erro ao tentar salvar registro", "danger");
						$DS->rollback();
					}
				
				}else{
					$this->Session->setFlash("Seu formulário possui pendências de validação", "danger");
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
}
