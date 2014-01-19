<?php 



class AdsToPool extends CJSyncAppModel {

	
	public function getAdsForPool($pool_id=null) {
		return $this->find('all', array('conditions'=>array('AdsToPool.ad_pools_id'=>(int)$pool_id),
										'joins'=>array(array('table'=>'ads', 'alias'=>'Ad', 'type'=>'left', 'conditions'=>array('Ad.id=AdsToPool.ads_id'))),
										'fields'=>array('Ad.*', 'AdsToPool.*')
										));
	}
	

}



?>