<?php
App::uses('AppController', 'Controller');
/**
 * SwordsUsers Controller
 *
 * @property SwordsUser $SwordsUser
 */
class SwordsUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SwordsUser->recursive = 0;
		$this->set('swordsUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SwordsUser->exists($id)) {
			throw new NotFoundException(__('Invalid swords user'));
		}
		$options = array('conditions' => array('SwordsUser.' . $this->SwordsUser->primaryKey => $id));
		$this->set('swordsUser', $this->SwordsUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SwordsUser->create();
			if ($this->SwordsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The swords user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The swords user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SwordsUser->exists($id)) {
			throw new NotFoundException(__('Invalid swords user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SwordsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The swords user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The swords user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SwordsUser.' . $this->SwordsUser->primaryKey => $id));
			$this->request->data = $this->SwordsUser->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SwordsUser->id = $id;
		if (!$this->SwordsUser->exists()) {
			throw new NotFoundException(__('Invalid swords user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SwordsUser->delete()) {
			$this->Session->setFlash(__('Swords user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Swords user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
