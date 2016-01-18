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
	
	public function index(){
		try{
			
			$this->setTitle("Usuários");
			$this->Usuario->bindModel(array("belongsTo"=>array("Pessoa","Perfil","Vinculo")));			
			$this->paginate['conditions'] = $this->_conditions();
			$this->paginate['order'] = array('Usuario.nome'=>'asc');
			$this->set('lista', $this->paginate());
			$this->set('options', array('Usuario.nome'=>'Nome'));
			
		}catch(Exception $e){
			$this->trataExcecao($e);
		}
	}
	
	public function editar(){
		
		try{
			
			if(!$registro = $this->Usuarios->findById($id)){
				throw new Exception("Registro #{$id} não encontrado");
			}
			
			$this->setTitle("Editar Usuário");
			if ($this->request->is('post')) {
				$DS = $this->Usuario->getDataSource();
				$DS->begin();
				if($this->Usuario->editar($id, $this->request->data)){
					$DS->commit();
					$this->Session->setFlash("Registro editado com sucesso", "success");
					$this->redirect(array("action"=>"index"));
				}else{
					$DS->rollback();
				}
			}
			
			$this->request->data = $registro;
			
			$this->set("perfis", $this->Perfil->listarAtivos("list"));
			$this->set("vinculos", $this->Vinculo->listarAtivos("list"));
			
		}catch(Exception $e){
			$this->trataExcecao($e, $DS);
		}
	}				
}
