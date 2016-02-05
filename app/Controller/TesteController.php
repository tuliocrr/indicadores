<?php
class TesteController extends AppController{
	
	public $uses = array("Perfil", "Cargo", "Vinculo", "Setor", "Departamento");
	
	public function index(){
		
		$this->set('perfis', $this->Perfil->listarAtivos('list'));
		$this->set('cargos', $this->Cargo->listarAtivos('list'));
		$this->set('vinculos', $this->Vinculo->listarAtivos('list'));
		$this->set('setores', $this->Setor->listarAtivos('list'));
		$this->set('departamentos', $this->Departamento->listarAtivos('list'));
		
	}
	
}