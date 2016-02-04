<?php
App::uses("Usuario", "Model");
class Setor extends AppModel{
	
	var $useTable = "setores";
	
	public $validate = array(
		"titulo"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo obrigatório"
			)
		),"tipo_setor_id"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo obrigatório"
			)
		)
	);
	
	public function adicionar($dados){
		return $this->save($dados);
	}
	
	public function editar($id, $dados){
		$this->id = $id;
		return $this->save($dados);
	}

	public function excluir($id){
		
		if(!$registro = $this->findById($id)){
			throw new Exception("Registro #{$id} não encontrado");
		}
		
		$Usuario = new Usuario();
		if($usuarios = $Usuario->find("all", array("conditions"=>array("Usuario.setor_id"=>$id, "Usuario.status"=>1)))){
			throw new Exception("Este setor não pode ser excluído pois existem usuários associados ao mesmo");
		}
			
		$this->id = $id;
		if($this->saveField("status", 0)) 
			return true;
		return false;
		
	}

	public function listarAtivos($type = 'all'){
		$options['order'] = 'Setor.titulo';
		if($type == 'list'){
			$options['fields'] = array('Setor.id', 'Setor.titulo');
		}
		return $this->find($type, $options);
	}
}