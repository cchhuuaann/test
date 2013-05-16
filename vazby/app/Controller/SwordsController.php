<?php
App::uses('AppController', 'Controller');
/**
 * Swords Controller
 *
 * @property Sword $Sword
 */
class SwordsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sword->recursive = 0;
		$this->set('swords', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sword->exists($id)) {
			throw new NotFoundException(__('Invalid sword'));
		}
		$options = array('conditions' => array('Sword.' . $this->Sword->primaryKey => $id));
		$this->set('sword', $this->Sword->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sword->create();
			if ($this->Sword->save($this->request->data)) {
				$this->Session->setFlash(__('The sword has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sword could not be saved. Please, try again.'));
			}
		}
		$users = $this->Sword->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Sword->exists($id)) {
			throw new NotFoundException(__('Invalid sword'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sword->save($this->request->data)) {
				$this->Session->setFlash(__('The sword has been saved'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sword could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sword.' . $this->Sword->primaryKey => $id));
			$this->request->data = $this->Sword->find('first', $options);
		}
		$users = $this->Sword->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sword->id = $id;
		if (!$this->Sword->exists()) {
			throw new NotFoundException(__('Invalid sword'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sword->delete()) {
			$this->Session->setFlash(__('Sword deleted'),'default',array('class'=>'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sword was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
