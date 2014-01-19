<?php 


App::uses('Advertisers', 'CJSync.cj'); // Filename, Plugin.Package

App::Uses('CjLinkSyncer', 'CJSync.cj');





class AdsController extends CJSyncAppController {

	

	var $components = array('RequestHandler');

	

	public function beforeFilter() {

	

		parent::beforeFilter();

		if ($this->Session->check('admin')) {


		} else {

			$this->redirect('/');

		}

	}

	

	public function index() { 
		$this->loadModel('CJSync.AdPool');
		if (!empty($this->request->data)) {
			if (isset($_POST['add_to_pool'])) {
			
				$this->loadModel('CJSync.AdsToPool');
				foreach($this->request->data['Ad']['ids'] as $id ) {
					$this->AdsToPool->id = null;
					$this->AdsToPool->save(array('AdsToPool'=>array('ads_id'=>$id,
																	'ad_pools_id'=>$this->request->data['Ad']['pool_to_add_to'])));
				}
				$this->Session->setFlash('Ads added to pool');
			} 
			
			if (isset($_POST['ad_pool'])) {
				//pr($this->request->data);
				if ($this->request->data['Ad']['ad_pool_name']!='') {
					
					$this->AdPool->id = null;
					$this->AdPool->save(array('AdPool'=>array('name'=>$this->request->data['Ad']['ad_pool_name'])));
					
					$this->loadModel('CJSync.AdsToPool');
					foreach($this->request->data['Ad']['ids'] as $id ) {
						$this->AdsToPool->id = null;
						$this->AdsToPool->save(array('AdsToPool'=>array('ads_id'=>$id,
																		'ad_pools_id'=>$this->AdPool->id)));
					}
					
					$this->Session->setFlash('Pool saved sucessfully.');
				} else {
					$this->Session->setFlash('Please enter a name for the Ad Pool.');
				}
			}
		}
		$pools = $this->AdPool->getPools();
		$pools_list = array();
		foreach($pools as $pool) {
			$pools_list[$pool['AdPool']['id']] = $pool['AdPool']['name'];
		}
		$this->set('ads', $this->Ad->getAllShowableAds());
		$this->set('ad_pools', $pools);
		$this->set('pools_list', $pools_list);
	}
	
	public function pool($pool_id=null) {
		$this->loadModel('CJSync.AdPool');
		$this->loadModel('CJSync.AdsToPool');
		
		
		if (!empty($this->request->data)) {
			if (sizeof($this->request->data['Ad']['ids'])>0) {
				foreach($this->request->data['Ad']['ids'] as $id) {
					$this->AdsToPool->deleteAll(array('id'=>$id));
				}
			}
			$this->Session->setFlash('Ad removed from pool');
		}
		
		
		$this->set('pool', $this->AdPool->getPool($pool_id));
		$this->set('ads', $this->AdsToPool->getAdsForPool($pool_id));
	}

	public function displayPool($pool_id=null) {
		$this->loadModel('CJSync.AdsToPool');
		$ads = $this->AdsToPool->getAdsForPool($pool_id);

		$this->set('ad', $ads[rand(0,sizeof($ads)-1)]);
		$this->set('pool_id', $pool_id);
	}
	

	public function viewCjAds() {

		$advertisers = new Advertisers();

		$advertisers_list = $advertisers->getAdvertisers();

		$ad_list = array();

		foreach($advertisers_list as $advertiser) {

			$links = $advertisers->getLinks($advertiser->id);

			$ad_list = array_merge($ad_list, $links);

		}

		$this->set('ad_list', $ad_list);

	}

	

	public function syncCjAds() {

		$cj_sync = new CjLinkSyncer();

		$cj_sync->sync();

		

		$this->redirect(array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'index'));

	}

	

	public function randomAd() {

		$ads = $this->Ad->getAllShowableAds();

		$this->set('ad', $ads[rand(0,sizeof($ads)-1)]);

		

	}
	
	public function viewAd($ad_id=null) {
		$this->set('ad', $this->Ad->getAd($ad_id));
		$this->render('view_ad', 'none');
	}

}



?>