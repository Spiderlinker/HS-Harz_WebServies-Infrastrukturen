<?php

Class Mobile {
	
	private $mobiles = array(
		1 => 'Samsung Galaxy Fold Z2 ',
		2 => 'Samsung Galaxy S10',
		3 => 'Apple iPhone X ',
		4 => 'LG G4',  			
		5 => 'Samsung Galaxy S6 edge',  
		6 => 'OnePlus 2');
		

	public function getAllMobile(){
		return $this->mobiles;
	}
	
	public function getMobile($id){
		
		$mobile = array($id => ($this->mobiles[$id]) ? $this->mobiles[$id] : $this->mobiles[1]);
		return $mobile;
	}	
}