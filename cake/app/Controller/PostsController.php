<?php
	class PostsController extends AppController {
		public $helpers = array('Html','Form');
		
		public function isAuthorized($user) {
			if($this->action == 'add') {
				return true;
			}
			
			if(in_array($this->action, array('edit','delete'))) {
				$postId = $this->request->params['pass'][0];
				if($this->Post->isOwnedBy($postId,$user['id'])) {
					return true;
				}
			}
			
			return parent::isAuthorized($user);
		}
		
		public function index() {
			$this->set('posts',$this->Post->find('all'));
		}
		
		public function view($id = NULL) {
			if(!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			$post = $this->Post->findById($id);
			
			if(!$post) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			$this->set('post', $post);
		}
		
		public function add() {
			if($this->request->is('post')) {
				$this->request->data['Post']['user_id'] = $this->Auth->user('id');
				if($this->Post->save($this->request->data)) {
					$this->Session->setFlash('Your post has been saved.');
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash('Ubnable to add your post.');
				}
			}
		}
		
		public function edit($id = NULL) {
			if(!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			$post = $this->Post->findById($id);
			if(!$post) {
				throw new NotFoundException(__('Invalid post'));
			}
			
			if($this->request->is('post') || $this->request->is('put')) {
				$this->Post->id = $id;
				if ($this->Post->save($this->request->data)) {
					$this->Session->setFlash('Your post has been updated.');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Unable to update your post.');
				}
			}
			
			if(!$this->request->data) {
				$this->request->data = $post;
			}
		}
		
		public function delete($id = NULL) {
			if($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}
			
			if($this->Post->delete($id)) {
				$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
				$this->redirect(array('action'=>'index'));
			}
		}
		
	}
