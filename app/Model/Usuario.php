<?php
/**
 *
 * Copyright [2014] -  Civis Gestão Inteligente
 * Este arquivo é parte do programa Civis Estratégia
 * O civis estratégia é um software livre, você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF) na versão 2 da Licença.
 * Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA, sem uma garantia implícita de ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "licença GPL.odt", junto com este programa. Se não encontrar,
 * Acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA 
 *
 */
app::uses("Pessoa", "Model");
class Usuario extends AppModel {

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		"login"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Campo login é obrigatório"
			),
            'between' => array(
                'rule' => array('between', 4, 100),
                'message' => 'Login deve conter entre 4 e 100 caracteres'
            ),
			"Unico"=>array(
				"rule"=>"isUnicoLoginAtivo",
				"message"=>"Login inválido, favor informe outro."
			)
		),
		'senha'=>array(
			'Obrigatório'=>array(
				'rule'=>'notEmpty',
				'message'=>'Campo senha é obrigatório',
				'on'=>'create'
			),
			'Tamanho Mínimo'=>array(
				'rule' => array('minLength', 6),
				'message'=>'Senha deve ter no mínimo 6 caracteres',
				'allowEmpty'=>true
			),
			'Match Passwords'=>array(
				'rule'=>'matchPasswords',
				'message'=>'Confirmação de senha inválida'
			)
		),
		"confirmacao_senha"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Confirme sua senha",
				"on"=>"create"
			)
		),
		'perfil_id' => array(
			'Obrigatório' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Grupo é obrigatório',
			),
		),
		'cargo_id' => array(
			'Obrigatório' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Cargo é obrigatório',
			),
		),
		'vinculo_id' => array(
			'Obrigatório' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Vínculo é obrigatório',
			),
		),
		'setor_id' => array(
			'Obrigatório' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Setor é obrigatório',
			),
		),
		'chefe' => array(
			'Obrigatório' => array(
				'rule' => array('notempty'),
				'message' => 'Campo Chefia é obrigatório',
			),
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Pessoa' => array(
			'className' => 'Pessoa',
			'foreignKey' => 'pessoa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	public function isUnicoLoginAtivo($data){
		if($this->id){
			$conditions["Usuario.id != "] = $this->id;
		}
		$conditions["Usuario.login"] = strtolower($data["login"]);
		return !(boolean) $this->find("first", array("conditions"=>$conditions));
	}
	
	public function matchPasswords($data){
		if($data['senha'] != $this->data['Usuario']['confirmacao_senha']){
			$this->invalidate('confirmacao_senha','Confirmação de senha inválida');
			return false;
		}
		return true;
	}
	
	public function beforeSave($options = array()){
		
		// APLICANDO O HASH DA SENHA
		if(!empty($this->data['Usuario']['senha'])){
			$this->data['Usuario']['senha'] = AuthComponent::password($this->data['Usuario']['senha']);
		}else{
			unset($this->data['Usuario']['senha']);
		}
		
		// COLOCANDO O LOGIN SEMPRE MINUSCULO
		if(!empty($this->data['Usuario']['login'])){
			$this->data['Usuario']['login'] = strtolower($this->data['Usuario']['login']);
		}
		
		parent::beforeSave($options); 
	}

	public function adicionar($dados){
		$Pessoa = new Pessoa();
		$Pessoa->set($dados["Pessoa"]);
		$this->set($dados["Usuario"]);
		if($Pessoa->validates() && $this->validates()){
			if($Pessoa->save($dados["Usuario"])){
				$dados["Usuario"]["pessoa_id"] = $Pessoa->id;
				if($this->save($dados["Usuario"])){
					return true;
				}
				throw new Exception("Erro ao tentar salvar registro");
			}
			throw new Exception("Erro ao tentar salvar registro");
		}
		return false;
	}
	
	public function editar($id, $dados){
		$Pessoa = new Pessoa();
		$Pessoa->set($dados["Pessoa"]);
		$this->set($dados["Usuario"]);
		if($Pessoa->validates() && $this->validates()){
			$Pessoa->id = $dados["Pessoa"]["id"];
			if($Pessoa->save($dados["Usuario"])){
				$this->id = $id;
				if($this->save($dados["Usuario"])){
					return true;
				}
				throw new Exception("Erro ao tentar salvar registro");
			}
			throw new Exception("Erro ao tentar salvar registro");
		}
		return false;
	}
	
	public function excluir($id){
	
		if(!$registro = $this->findById($id)){
			throw new RegistroNaoEncontradoException($id);
		}
			
		$this->id = $id;
		if($this->saveField("status", 0))
			return true;
		return false;
	
	}
	
	public function listarAtivos($type = 'all'){
		$options['order'] = 'Pessoa.nome';
		if($type == 'list'){
			$options['fields'] = array('Usuario.id', 'Pessoa.nome');
		}
		
		
		return $this->find($type, $options);
	}

}
