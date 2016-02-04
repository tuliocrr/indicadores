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
App::import('Component','ControleDeAcesso');
App::import('Model','Permissao');
App::import('Model','Regra');
App::import('Model','Usuario');

class Perfil extends AppModel{
	
	var $useTable = "perfis";
	
	public $validate = array(
		"titulo"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo obrigatório"
			)
		)
	);
	
	public function adicionar($dados, $CDA){
		if ($this->save($dados)) {
			if(isset($dados['permissoes']) && is_array($dados['permissoes'])){
				$Permissao = new Permissao();
				$Regra = new Regra();
				foreach($dados['permissoes'] as $chave => $flag){
					foreach($flag as $acao){
						$perfilPermissoes = $CDA->getRestricoesPorChave($chave. "." . $acao);
						if(count($perfilPermissoes)>0){
							$Permissao->create(array('perfil_id'=>$this->id, 'descricao'=>$chave. "." . $acao));
							$respPermissao = $Permissao->save();
							if(!$respPermissao){
								throw new Exception("Erro ao salvar permissão");
							}
							foreach($perfilPermissoes as $permissao){
								$Regra->create(array('permissao_id'=>$respPermissao['Permissao']['id'], 'descricao'=>$permissao));
								if(!$Regra->save()){
									throw new Exception("Erro ao salvar regra");
								}
							}
						}
					}
				}
				return true;
			}
			throw new Exception("Nenhum dado de permissão foi enviado");
		}
		return false;
	}
	
	public function editar($id, $dados, $CDA){
		
		$this->id = $id;
		if ($this->save($dados)) {
			if(isset($dados['permissoes']) && is_array($dados['permissoes'])){
				
				$Permissao = new Permissao();
				$Regra = new Regra();
				
				// DELETANDO AS REGRAS, PARA QUE POSSAM SER INSERIDAS NOVAMENTE
				$this->query("DELETE FROM regras WHERE permissao_id IN (SELECT id FROM permissoes WHERE perfil_id = $id)");
					
				// DELETANDO AS PERMISSÕES, PARA QUE POSSAM SER INSERIDAS NOVAMENTE
				$this->query("DELETE FROM permissoes WHERE perfil_id = $id");
				
				foreach($dados['permissoes'] as $chave => $flag){
					foreach($flag as $acao){
						$perfilPermissoes = $CDA->getRestricoesPorChave($chave. "." . $acao);
						if(count($perfilPermissoes)>0){
							$Permissao->create(array('perfil_id'=>$this->id, 'descricao'=>$chave. "." . $acao));
							$respPermissao = $Permissao->save();
							if(!$respPermissao){
								throw new Exception("Erro ao salvar permissão");
							}
							foreach($perfilPermissoes as $permissao){
								$Regra->create(array('permissao_id'=>$respPermissao['Permissao']['id'], 'descricao'=>$permissao));
								if(!$Regra->save()){
									throw new Exception("Erro ao salvar regra");
								}
							}
						}
					}
				}
				return true;
			}
			throw new Exception("Nenhum dado de permissão foi enviado");
		}
		return false;
	}

	public function excluir($id){
		
		if(!$registro = $this->findById($id)){
			throw new RegistroNaoEncontradoException($id);
		}
		
		$Usuario = new Usuario();
		if($usuarios = $Usuario->find("all", array("conditions"=>array("Usuario.perfil_id"=>$id, "Usuario.status"=>1)))){
			throw new Exception("Este perfil não pode ser excluído pois existem usuários associados ao mesmo");
		}
			
		$this->id = $id;
		if($this->saveField("status", 0)) 
			return true;
		return false;
		
	}
	
	public function listarAtivos($type = 'all'){
		$options['order'] = 'Perfil.titulo';
		if($type == 'list'){
			$options['fields'] = array('Perfil.id', 'Perfil.titulo');
		}
		return $this->find($type, $options);
	}
}