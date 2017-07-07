<?php
App::uses('AppController', 'Controller');
/**
 * Sensors Controller
 *
 * @property Sensor $Sensor
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class SensorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sensor->recursive = 0;
		$this->set('sensors', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sensor->exists($id)) {
			throw new NotFoundException(__('Invalid sensor'));
		}
		$options = array('conditions' => array('Sensor.' . $this->Sensor->primaryKey => $id));
		$this->set('sensor', $this->Sensor->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sensor->create();
			if ($this->Sensor->save($this->request->data)) {
				$this->Flash->success(__('The sensor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sensor could not be saved. Please, try again.'));
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
		if (!$this->Sensor->exists($id)) {
			throw new NotFoundException(__('Invalid sensor'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sensor->save($this->request->data)) {
				$this->Flash->success(__('The sensor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sensor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sensor.' . $this->Sensor->primaryKey => $id));
			$this->request->data = $this->Sensor->find('first', $options);
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
		$this->Sensor->id = $id;
		if (!$this->Sensor->exists()) {
			throw new NotFoundException(__('Invalid sensor'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Sensor->delete()) {
			$this->Flash->success(__('The sensor has been deleted.'));
		} else {
			$this->Flash->error(__('The sensor could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
