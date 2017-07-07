<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class LocationsController extends AppController {

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
		$this->Location->recursive = 0;
		$this->set('locations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
		$this->set('location', $this->Location->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			/*追加***********************************************************************************************************************************************/
			$parametar = "?sensor=false&region=jp&address=".urlencode(mb_convert_encoding($this->request->data['Location']['address'], 'UTF8', 'auto'));
			$datas = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json'.$parametar);

			// JSONデータをPHPの値に変換する
			$geo = json_decode($datas);
			$results = $geo->results[0];
			$geometry = $results->geometry;
			$location = $geometry->location;
			$lat = $location->lat; // 緯度を取得
			$lng = $location->lng; // 経度を取得

			$this->request->data['Location']['latitude'] = $lat;
			$this->request->data['Location']['longitude'] = $lng;
			
			
			$datas = file_get_contents("http://maps.googleapis.com/maps/api/elevation/json?sensor=false&locations=$lat,$lng");
			$elevations = json_decode($datas);
			$elevation = $elevations->results[0]->elevation; //標高を取得
			$this->request->data['Location']['elevation'] = $elevation;
			
			
			/****************************************************************************************************************************************************/
			
			
			$this->Location->create();
			if ($this->Location->save($this->request->data)) {
				$this->Flash->success(__('The location has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The location could not be saved. Please, try again.'));
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
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Location->save($this->request->data)) {
				$this->Flash->success(__('The location has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
			$this->request->data = $this->Location->find('first', $options);
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
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Location->delete()) {
			$this->Flash->success(__('The location has been deleted.'));
		} else {
			$this->Flash->error(__('The location could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
