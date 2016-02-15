<?php
class TipoProduto extends AppModel{
	
	var $useTable = "tipo_produto";
	
	public function listarAtivos($type = "all"){
		return $this->find($type, array("fields"=>array("id", "titulo"), "order"=>"titulo"));
	}
	
	public function beforeFind($queryData){
		$queryData["conditions"][$this->name . ".status != "] = 0;
		return $queryData;
	}
	
}