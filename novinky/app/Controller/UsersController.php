<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('login');
	}
	
	public function login() {
		if($this->Session->read('Auth.User')) {
			$this->redirect(array('plugin' => 'admin', 'controller' => 'news', 'action' => 'index'), null, false);
		}
		
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl(array('plugin' => 'admin', 'controller' => 'news', 'action' => 'index')));
			} else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	} 

}
