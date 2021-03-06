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
//App::uses("Objetivo", "Model");
class Dimensao extends AppModel{
	
	var $useTable = "dimensoes";
	
	public $validate = array(
		"titulo"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo obrigatório"
			)
		),
		"ano"=>array(
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
			throw new RegistroNaoEncontradoException($id);
		}
		/*
		$Objetivo = new Objetivo();
		if($usuarios = $Usuario->find("all", array("conditions"=>array("Objetivo.Dimensao_id"=>$id, "Objetivo.status"=>1)))){
			throw new Exception("Este Dimensão não pode ser excluído pois existem usuários associados ao mesmo");
		}
		*/	
		$this->id = $id;
		if($this->saveField("status", 0)) 
			return true;
		return false;
		
	}
	/**
	 * Método que retorna as dimensões ativas
	 * @param string $type
	 * @return array
	 */	
	
	public function listarAtivos($type = 'all'){
		$options['order'] = 'Dimensao.titulo';
		if($type == 'list'){
			$options['fields'] = array('Dimensao.id', 'Dimensao.titulo');
		}
		return $this->find($type, $options);
	}

}