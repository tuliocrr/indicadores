<?php
App::import("Model", "Usuario");
App::import("Model", "Perfil");
App::import("Model", "Permissao");

class ControleDeAcesso{

	private $Usuario;	
	private $Perfil;
	private $Permissao;
	private $user;
	private $nomeAcao;
	private $nomeControlador;
	private $acesso;
	
	/*Controller.action_OR_element.type
	* Exp action:  Principal.addVeiculo.action
	* Exp element: Principal.addVeiculo.element
	*/ 
	private $restricoes = array(
		'Perfil'=>array(
			'Adicionar'=>array('Perfis.adicionar.action', 'Perfis.adicionar.element'),
			'Excluir'=>array('Perfis.excluir.action', 'Perfis.excluir.element'),
			'Editar'=>array('Perfis.editar.action', 'Perfis.editar.element'),
			'Listagem'=>array('Perfis.index.action', 'Perfis.listar.element'),
			'Visualizar'=>array('Perfis.visualizar.action', 'Perfis.visualizar.element')
		),
		'Usuário'=>array(
			'Adicionar'=>array('Usuarios.adicionar.action','Usuarios.adicionar.element'),
			'Excluir'=>array('Usuarios.excluir.action', 'Usuarios.excluir.element'),
			'Editar'=>array('Usuarios.editar.action', 'Usuarios.editar.element'),
			'Listagem'=>array('Usuarios.index.action', 'Usuarios.listar.element'),
			'Visualizar'=>array('Usuarios.visualizar.action', 'Usuarios.visualizar.element')
		),
		'Cargo'=>array(
			'Adicionar'=>array('Cargos.adicionar.action','Cargos.adicionar.element'),
			'Excluir'=>array('Cargos.excluir.action', 'Cargos.excluir.element'),
			'Editar'=>array('Cargos.editar.action', 'Cargos.editar.element'),
			'Listagem'=>array('Cargos.index.action', 'Cargos.listar.element'),
			'Visualizar'=>array('Cargos.visualizar.action', 'Cargos.visualizar.element')
		),
		'Departamento'=>array(
			'Adicionar'=>array('Departamentos.adicionar.action','Departamentos.adicionar.element'),
			'Excluir'=>array('Departamentos.excluir.action', 'Departamentos.excluir.element'),
			'Editar'=>array('Departamentos.editar.action', 'Departamentos.editar.element'),
			'Listagem'=>array('Departamentos.index.action', 'Departamentos.listar.element'),
			'Visualizar'=>array('Departamentos.visualizar.action', 'Departamentos.visualizar.element')
		),
		'Faixa'=>array(
			'Adicionar'=>array('Faixas.adicionar.action','Faixas.adicionar.element'),
			'Excluir'=>array('Faixas.excluir.action', 'Faixas.excluir.element'),
			'Editar'=>array('Faixas.editar.action', 'Faixas.editar.element'),
			'Listagem'=>array('Faixas.index.action', 'Faixas.listar.element'),
			'Visualizar'=>array('Faixas.visualizar.action', 'Faixas.visualizar.element')
		),
		'Vinculo'=>array(
			'Adicionar'=>array('Vinculos.adicionar.action','Vinculos.adicionar.element'),
			'Excluir'=>array('Vinculos.excluir.action', 'Vinculos.excluir.element'),
			'Editar'=>array('Vinculos.editar.action', 'Vinculos.editar.element'),
			'Listagem'=>array('Vinculos.index.action', 'Vinculos.listar.element'),
			'Visualizar'=>array('Vinculos.visualizar.action', 'Vinculos.visualizar.element')
		),
		'Dimensão'=>array(
			'Adicionar'=>array('Dimensoes.adicionar.action','Dimensoes.adicionar.element'),
			'Excluir'=>array('Dimensoes.excluir.action', 'Dimensoes.excluir.element'),
			'Editar'=>array('Dimensoes.editar.action', 'Dimensoes.editar.element'),
			'Listagem'=>array('Dimensoes.index.action', 'Dimensoes.listar.element'),
			'Visualizar'=>array('Dimensoes.visualizar.action', 'Dimensoes.visualizar.element')
		),
		'Procedimentos'=>array(
			'Adicionar'=>array('Procedimentos.adicionar.action','Procedimentos.adicionar.element'),
			'Excluir'=>array('Procedimentos.excluir.action', 'Procedimentos.excluir.element'),
			'Editar'=>array('Procedimentos.editar.action', 'Procedimentos.editar.element'),
			'Listagem'=>array('Procedimentos.index.action', 'Procedimentos.listar.element'),
			'Visualizar'=>array('Procedimentos.visualizar.action', 'Procedimentos.visualizar.element')
		)
	);

	public function __construct($nameAction, $nameController){
		$this->Usuario = new Usuario();
		$this->Perfil = new Perfil();
		$this->Permissao = new Permissao();
		$this->nomeAcao = $nameAction;
		$this->nomeControlador = $nameController;
		if(isset($_SESSION['Auth']['Indicadores'])){
			$this->user = $_SESSION['Auth']['Indicadores'];
		}
	}

	public function validaAcessoAcao($acao='', $controller=''){	
		// Se a ação atual for restrita, será solicitado a permissão ao usuário
		if($this->_acessoRestrito('action', $acao, $controller)){
			return $this->_existePermissao($this->acesso);
		}
	 	return true;
	}
	
	public function validaAcessoElemento($element, $controller=''){
		// Se a ação atual for restrita, será solicitado a permissão ao usuário
		if($this->_acessoRestrito('element', $element, $controller)){
			return $this->_existePermissao($this->acesso);
		}
	 	return true;
	}	
	
	private function _acessoRestrito($tipo, $acao='', $controller=''){
		$this->_montaAcesso($tipo, $acao, $controller);
		foreach($this->restricoes as $restricoes){ 
			foreach($restricoes as $restricao){
				if(in_array($this->acesso, $restricao)){
					return true;	
				}
			}
		}
		return false;
	}
	
	private function _montaAcesso($tipo, $acao='', $controller=''){
		if(!empty($acao)){
			$this->nomeAcao = $acao;
		}
		if(!empty($controller)){
			$this->nomeControlador = $controller;
		}		
		return $this->acesso = $this->nomeControlador.'.'.$this->nomeAcao.'.'.$tipo; 		
	}
	 
	private function _existePermissao($descricao){
		
		$resp = $this->Usuario->find("all",array(
				'conditions'=> array(
					'Usuario.id'=>$this->user['id'],
					'I.descricao'=>$descricao
				),
                "joins" => array(
                    array(
                        "table" => "permissoes",
                        "alias" => "Permissao",
                        "type" => "INNER",
                        "conditions" => array('Usuario.perfil_id = Permissao.perfil_id')
                    ),
                    array(
                        "table" => "regras",
                        "alias" => "I",
                        "type" => "INNER",
                        "conditions" => array('Permissao.id = I.permissao_id')
                    )
                )
            )
		);
		return ($resp)?true:false;
	}
	
	public function setUser($user){
		$this->user = $user;
	}
	
	public function getRestricoes(){
		return $this->restricoes;
	}
	
	public function getRestricoesPorChave($chave){
		$dados = explode('.',$chave);
		if(count($dados)!=2)
			return array();
		$sessao = $dados[0];
		$chave = $dados[1];
		if(isset($this->restricoes[$sessao][$chave]))
			return $this->restricoes[$sessao][$chave];
		return array();
	}
	
}