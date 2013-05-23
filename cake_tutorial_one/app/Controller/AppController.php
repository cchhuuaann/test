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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
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
	
	public $uses = array('User');
	
	public $theme = 'security';
	
	public $helpers = array(
			'Html',
			'Form',
			'Js' => array('Jquery')
		);
	
	public $components = array(
			'DebugKit.Toolbar',
			'Session',
			'Auth' => array(
					'loginRedirect' => array(
							'controller' => 'posts',
							'action' => 'index'
						),
					'logoutRedirect' => array(
							'controller' => 'users',
							'action' => 'index'
						),
					'authorize' =>array(
							'Controller'
						)
					
				),
			'RequestHandler'
		);
	
	public $paginate = array(
			'limit' => 5
		);

	public function __ipAddress() {
		$this->User->id = $this->Auth->user('id');
		$ip = $this->User->field('ip_address');
	
		if($ip === $this->request->clientIp()) {
			return true;
		}
	
		return false;
	}
	
	public function isAuthorized($user) {
		if(isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		
		return false;
	}
	
	public function beforeFilter() {
		$this->Session->renew();
		
		if($this->Auth->user() && !$this->__ipAddress()) {
			$this->Session->setFlash(__('Your ip address is wrong. You are Logout!'));
			$this->redirect($this->Auth->logout());
		}
		
		$this->Auth->allow('index','view');
	}
	
}
