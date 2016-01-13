<?php
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
		throw new Exception("Erro ao salvar perfil");
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
		throw new Exception("Erro ao salvar perfil");
	}

	public function excluir($id){
		
		if(!$registro = $this->findById($id)){
			throw new Exception("Registro #{$id} não encontrado");
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
}