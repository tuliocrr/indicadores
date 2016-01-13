<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

App::uses('Util', 'Lib');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	protected $title;
	
	protected $title_for_layout = "Civis Estratégia";
	
	protected $paginate;
	
	public $components = array(
		'ControleDeAcesso',
		'Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'autenticacao',
				'action' => 'index'
			),
			'authError' => 'Você precisa estar logado para acessar a página.',
			'loginRedirect' => array('controller'=>'principal', 'action'=>'index'),
			'logoutRedirect' => array('controller'=>'autenticacao', 'action'=>'index'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'login', 'password' => 'senha'),
					'userModel' => 'Usuario',
					'scope' => array('Usuario.status' => 1)
				)
			)
		)
	);
	
	public function beforeFilter(){
		
		if(!$this->ControleDeAcesso->validaAcessoAcao()){
			//$this->Session->setFlash('<strong>Atenção!</strong> Você não tem permissão para acessar esta página.', 'danger');
			//$this->redirect(array('controller'=>'principal','action'=>'index'));
		}
		
		AuthComponent::$sessionKey = "Auth.Indicadores";
		Security::setHash('md5');
	}
	
	public function beforeRender(){
		$this->set("title", $this->title);
		$this->set("title_for_layout", $this->title_for_layout);
		$this->set('usuarioLogado', $this->Auth->user());
	}
	
	protected function trataExcecao($e, $DS = null){
		if(isset($DS)){$DS->rollback();}
		$this->Session->setFlash($e->getMessage(), 'danger');
		$this->redirect(array("action"=>"index"));
	}
	
	/**
	 * Método responsável por retornar as condições de busca para o paginate
	 * @param unknown $date
	 * @param unknown $boolean
	 * @param unknown $integer
	 * @return Ambigous <multitype:, multitype:boolean , multitype:number , multitype:string >
	 */
	protected function _conditions($otherConditions = array(), $date = array(), $boolean = array(), $integer = array()){
	
		/* salvando a sessão de busca */
		if($this->request->is('post')){
			if(!empty($this->request->data["busca"])){
				$indiceSessao = (empty($_SESSION['Search'][$this->request->params['controller']])) ? 0 : max(array_keys($_SESSION['Search'][$this->request->params['controller']])) + 1;
				$adicionar = true;
				if(!empty($_SESSION['Search'][$this->request->params['controller']])){
					foreach($_SESSION['Search'][$this->request->params['controller']] as $valores){
						if($valores['busca'] == $this->request->data["busca"] && $valores['buscar_em'] == $this->request->data["buscar_em"]){
							$adicionar = false;
							break;
						}
					}
				}
				if($adicionar){
					$_SESSION['Search'][$this->request->params['controller']][$indiceSessao]['busca'] = $this->request->data["busca"];
					$_SESSION['Search'][$this->request->params['controller']][$indiceSessao]['buscar_em'] = $this->request->data["buscar_em"];
				}
			}
		}
	
		/* lendo a sessão da busca e retornando o array de condições para o paginate */
		$conditions['AND'][] = $otherConditions;
		if(!empty($_SESSION['Search'][$this->request->params['controller']])){
			$array = array();
			foreach($_SESSION['Search'][$this->request->params['controller']] as $valores){
				if(in_array($valores['buscar_em'], $date)){
					$array[$valores['buscar_em']][] = array("to_char(".$valores['buscar_em'] . ", 'DD/MM/YYYY') ILIKE " => '%' . $valores['busca'] . '%');
				}else if(in_array($valores['buscar_em'], $boolean)){
					$array[$valores['buscar_em']][] = array($valores['buscar_em'] => (boolean)$valores['busca']);
				}else if(in_array($valores['buscar_em'], $integer)){
					$array[$valores['buscar_em']][] = array($valores['buscar_em'] => (int)$valores['busca']);
				}else{
					$array[$valores['buscar_em']][] = array("sem_acento(".$valores['buscar_em'] . ") ILIKE " => '%' . Util::retiraAcento($valores['busca']) . '%');
				}
			}
				
			foreach($array as $busca_em=>$linha){
				$or = array();
				foreach($linha as $cond){
					$or['OR'][] = $cond;
				}
				$conditions['AND'][] = $or;
			}
		}
		return $conditions;
	
	}
	
	protected function setTitle($titulo){
		$this->title = $titulo;
		$this->title_for_layout = $titulo . " | " . $this->title_for_layout;
	}
	
}
