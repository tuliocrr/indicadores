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
	
	public $title_for_layout = "Civis Estratégia";
	
	public $components = array(
		'Session',
		'Paginator',
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
		AuthComponent::$sessionKey = "Auth.Indicadores";
		Security::setHash('md5');
	}
	
	public function beforeRender(){
		$this->set("title_for_layout", $this->title_for_layout);
		$this->set('usuarioLogado', $this->Auth->user());
	}
	
}
