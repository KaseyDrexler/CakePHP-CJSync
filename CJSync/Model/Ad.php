<?php 



class Ad extends CJSyncAppModel {

	

	public function getAd($ad_id=null) {
		return $this->find('first', array('conditions'=>array('id'=>(int)$ad_id)));
	}

	public function exists ($cj_link_id=null) {

		if ($this->find('first', array('conditions'=>array('cj_link_id'=>(int)$cj_link_id)))) {

			return true;

		} else {

			return false;

		}

	}

	

	public function getAllNonDeletedAds() {

		return $this->find('all', array('conditions'=>array('deleted'=>0)));

	}

	public function getAllShowableAds() {

		

		return $this->find('all', array('conditions'=>array('deleted'=>0, '(ads_start_date is null or ads_start_date<now()) and (ads_end_date is null or ads_end_date>now())')));

	}

	

	public function deleteAd($ad_id=null) {

		$this->updateAll(array('deleted'=>1),

						 array('id'=>(int)$ad_id));

	}

	

	public function add($cj_link_obj = null) {

		$this->id = null;

		$ad = array('Ad'=>array());

		$ad['Ad']['name'] = $cj_link_obj->name;

		$ad['Ad']['type'] = ($cj_link_obj->link_type == 'Text Link') ? 'text' : 'image';

		$ad['Ad']['description'] = $cj_link_obj->description;

		$ad['Ad']['targeted_sex'] = 'both';

		$ad['Ad']['targeted_age_start'] = 1;

		$ad['Ad']['targeted_age_end'] = 99;

		$ad['Ad']['enabled'] = 1; // don't automattically ad them into rotation

		$ad['Ad']['deleted'] = 0;

		$ad['Ad']['ads_start_date'] = $cj_link_obj->start_date;

		$ad['Ad']['ads_end_date'] = $cj_link_obj->end_date;

		$ad['Ad']['advertiser_id'] = $cj_link_obj->advertiser_id;

		$ad['Ad']['advertiser_name'] = $cj_link_obj->advertiser_name;

		$ad['Ad']['category'] = $cj_link_obj->category;

		$ad['Ad']['commission_click'] = $cj_link_obj->commission_click;

		$ad['Ad']['height'] = $cj_link_obj->height;

		$ad['Ad']['width'] = $cj_link_obj->width;

		$ad['Ad']['link_html'] = addslashes(htmlspecialchars($cj_link_obj->link_html));

		$ad['Ad']['link_javascript'] = '';

		$ad['Ad']['destination'] = $cj_link_obj->destination;

		$ad['Ad']['cj_link_id'] = $cj_link_obj->id;

		$ad['Ad']['promotion_type'] = $cj_link_obj->promotion_type;

		$this->save($ad);

	}

	

}



?>