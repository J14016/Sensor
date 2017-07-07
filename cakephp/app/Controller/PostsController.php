<?php
	App::uses('APPController', 'Controller');
	
	class PostsController extends AppController {
		//public $scaffold;
		public $layout= "j14016";
		function index() {
			$posts = $this->Post->find('all');
			$this->set('posts', $posts);
		}
		
		
		public function add() {
			if($this->request->is('post')) {
				$this->Post->create();
				if($this->Post->save($this->request->data)) {
					$this->Session->setFlash(_('•Û‘¶‚µ‚Ü‚µ‚½B'));
					return $this->redirect(array('action' => 'index'));
				}
			}
		}
		
		
		public function view() {
			$options = array('conditions'=>array('Post.'.$this->Post->primaryKey=>$id));
			$this->set('post', $this->Post->find('first', $options));
		}
		
		
		public function delete($id = null) {
			$this->Post->id = $id;
			$this->request->allowMethod('post', 'delete');
			if($this->Post->delete()) {
				$this->Session->setFlash(__('íœ‚µ‚Ü‚µ‚½'));
			}
			
			return $this->redirect(array('action'=>'index'));
		}
		
		
		public function edit($id = null) {
			if($this->request->is(array('post', 'put'))) {
				if($this->Post->save($this->request->data)) {
					return $this->redirect(array('action'=>'index'));
				}
			}
			else {
				$options = array('conditions'=>array('Post.'.$this->Post->primaryKey=>$id));
				$this->request->data=$this->Post->find('first', $options);
			}
		}
	}
	
	
?>