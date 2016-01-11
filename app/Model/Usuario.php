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
/**
 * Usuario Model
 *
 * @property Pessoa $Pessoa
 * @property Cargo $Cargo
 * @property Vinculo $Vinculo
 */
class Usuario extends AppModel {
	
	var $useTable = "usuario";

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
				'message'=>'Campo senha é obrigatório'
			),
			'Tamanho Mínimo'=>array(
				'rule' => array('minLength', 6),
				'message'=>'Senha deve ter no mínimo 6 caracteres'
			),
			'Match Passwords'=>array(
				'rule'=>'matchPasswords',
				'message'=>'Confirmação de senha inválida'
			)
		),
		"confirmacao_senha"=>array(
			"Obrigatório"=>array(
				"rule"=>"notEmpty",
				"message"=>"Confirme sua senha"
			)
		),
		'grupo_id' => array(
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
	
	public function isUnicoLoginAtivo($data){
		return true;
	}
	
	public function matchPasswords($data){
		if(Router::getParam('action') == 'adicionar'){
			if($data['senha'] != $this->data['Usuario']['confirmacao_senha']){
				$this->invalidate('confirmacao_senha','Confirmação de senha inválida');
				return false;
			}
		}
		return true;
	}
	
}
