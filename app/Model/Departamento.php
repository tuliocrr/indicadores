<?php
App::uses("Usuario", "Model");
class Departamento extends AppModel{
	
	var $useTable = "departamentos";
	
	public $validate = array(
		"titulo"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo obrigatório"
			)
		)
	);
	
	public function adicionar($dados){
		if ($this->save($dados)) {
				return true;
		}
		throw new Exception("Erro ao salvar registro");
	}
	
	public function editar($id, $dados){
		$this->id = $id;
		if ($this->save($dados)) {
				return true;
		}
		throw new Exception("Erro ao salvar registro");
	}

	public function excluir($id){
		
		if(!$registro = $this->findById($id)){
			throw new Exception("Registro #{$id} não encontrado");
		}
		
		$Usuario = new Usuario();
		if($usuarios = $Usuario->find("all", array("conditions"=>array("Usuario.departamento_id"=>$id, "Usuario.status"=>1)))){
			throw new Exception("Este departamento não pode ser excluído pois existem usuários associados ao mesmo");
		}
			
		$this->id = $id;
		if($this->saveField("status", 0)) 
			return true;
		return false;
		
	}

}
?>