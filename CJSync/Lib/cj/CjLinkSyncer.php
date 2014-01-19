<?php 



App::Uses('Advertisers', 'CJSync.cj');





class CjLinkSyncer {

	

	function __construct() {

		$this->advertisers = new Advertisers();

		$this->Ad = ClassRegistry::init('CJSync.Ad');

		$this->Ad->create();

	}

	

	public function sync() {

		// get links

		$advertisers_list = $this->advertisers->getAdvertisers();

		$ad_list = array();

		foreach($advertisers_list as $advertiser) {

			$links = $this->advertisers->getLinks($advertiser->id);

			$ad_list = array_merge($ad_list, $links);

		}

		

		// delete ads that are no longer supported by CJ (they exist in the db but not in list from cj)

		$this->deleteAdsNotInCJ($ad_list);

		// delete ads that are expired

		// TODO

		// add links that are not in db

		$this->addAdsNotInDB($ad_list);

	}

	

	private function deleteAdsNotInCJ($cj_links=null) {

		$db_ads = $this->Ad->getAllNonDeletedAds();

		foreach($db_ads as $ad) {

			$ad_found = false;

			foreach($cj_links as $cj_link) {

				if ($cj_link->id == $ad['Ad']['cj_link_id']) {

					$ad_found = true;

				}

			}

			

			// if ad was not found mark as deleted in the db

			if (!$ad_found) {

				$this->Ad->deleteAd($ad['Ad']['id']);

			}

		}

	}

	

	private function addAdsNotInDB($cj_links=null) {

		foreach ($cj_links as $cj_link) {

			if (!$this->Ad->exists($cj_link->id)) {

				$this->Ad->add($cj_link);

			}

		}

	}

	

	

}





?>