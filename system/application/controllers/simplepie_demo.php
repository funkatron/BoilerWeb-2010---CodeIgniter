<?php

class Simplepie_Demo extends Controller {

    function Simplepie_Demo()
    {
        parent::Controller();
    }

	function index() {
		/*
			Had to rename to Simplepie.php. Constructor naming fits OOTB tho
		*/
		$this->load->library('simplepie');
		
		$this->simplepie->set_feed_url('http://www.phpdeveloper.org/feed');
		$this->simplepie->set_cache_location('system/cache');
		$this->simplepie->init();
		
		$items = $this->simplepie->get_items();
		
		echo '<h1><a href='.$this->simplepie->get_link().'>'.$this->simplepie->get_title().'</a></h1>';
		
		foreach ($items as $item) {
			echo '<h2><a href='.$item->get_link().'>'.$item->get_title().'</a></h2>';
			echo '<p>'.$item->get_description().'</p>';
		}
		
	}
}
?>