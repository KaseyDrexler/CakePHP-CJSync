<?php 



class AdPool extends CJSyncAppModel {

	public function getPools() {
		return $this->find('all');
	}

	public function getPool($id=null) {
		return $this->find('first', array('conditions'=>array('id'=>(int)$id)));
	}
}



?>