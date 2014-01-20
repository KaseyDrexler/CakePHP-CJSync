<?php



class Advertisers {





	private function getAdvertisersXML () {

		

		$ch = curl_init("https://advertiser-lookup.api.cj.com/v3/advertiser-lookup?advertiser-ids=joined");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(

		'Authorization: '.Configure::read('CJ.Authorization')

				));

		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close($ch);

		return $result;

	}

	

	public function getAdvertisers() {

		$xml = $this->getAdvertisersXML();

		$advertisers_array = simplexml_load_string($xml);

		$return_objects = array();

		if (isset($advertisers_array->advertisers)) {

			//echo 'advertisers exists';

			foreach($advertisers_array->advertisers->advertiser as $advertiser) {

				//print_r($advertiser);

				$advertiser_obj = new stdClass();

				$advertiser_obj->name   = (string) $advertiser->{'advertiser-name'};

				$advertiser_obj->id     = (string) $advertiser->{'advertiser-id'};

				$advertiser_obj->status = (string) $advertiser->{'account-status'};

				$return_objects[] = $advertiser_obj;

			}

		}

		return $return_objects;

	}

	

	private function getLinksXML($advertiser_id) {

		$ch = curl_init("https://linksearch.api.cj.com/v2/link-search?advertiser-ids=".$advertiser_id."&website-id=".Configure::read('CJ.website_id'));

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(

		'Authorization: '.Configure::read('CJ.Authorization')

				));

				curl_setopt($ch, CURLOPT_HEADER, 0);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$result = curl_exec($ch);

				curl_close($ch);

				return $result;

	}

	

	public function getLinks($advertiser_id) {

		$this->Ad = ClassRegistry::init('CJSync.Ad');

		$this->Ad->create();

		

		$xml = $this->getLinksXML($advertiser_id);



		$links_array = simplexml_load_string($xml);

		$link_objects = array();

		

		if (isset($links_array->links)) {

			foreach($links_array->links->link as $link) {

				$link_obj = new stdClass();

				$link_obj->advertiser_id    = (string) $link->{'advertiser-id'};

				$link_obj->advertiser_name  = (string) $link->{'advertiser-name'};

				$link_obj->category         = (string) $link->{'category'};

				$link_obj->commission_click = (string) $link->{'click-commision'};

				$link_obj->height		    = (string) $link->{'creative-height'};

				$link_obj->width		    = (string) $link->{'creative-width'};

				$link_obj->link_html	    = (string) $link->{'link-code-html'};

				$link_obj->link_javascript  = (string) $link->{'link-code-javascript'};

				$link_obj->description	    = (string) $link->{'description'};

				$link_obj->destination	    = (string) $link->{'destination'};

				$link_obj->id			    = (string) $link->{'link-id'};

				$link_obj->name			    = (string) $link->{'link-name'};

				$link_obj->link_type	    = (string) $link->{'link-type'};

				$link_obj->start_date       = (string) $link->{'promotion-start-date'};

				$link_obj->end_date		    = (string) $link->{'promotion-end-date'};

				$link_obj->promotion_type   = (string) $link->{'promotion-type'};

				$link_obj->exists			= $this->Ad->exists((string) $link->{'link-id'});

				$link_obj->language			= (string) $link->language;

				$link_objects[] = $link_obj; 

				

			}

		}

		return $link_objects;

	}



} 



?>