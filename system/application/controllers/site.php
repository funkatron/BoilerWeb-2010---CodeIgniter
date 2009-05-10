<?php


class Site extends Controller {


	/**
	 * We can use either an "old-style" constructor
	 *
	 * public function Site() {
	 * 	parent::Controller();
	 * }
	 *
	 * or a new-style constructor. In either case we have to
	 * explicitly call the parent constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * this is our default if no method is specified on the URL
	 */
	public function index() {
		$this->load->view('welcome_message');
	}
	
	
	
	public function search($country=null, $year=null, $start=0, $length=25) {
		
	}
	
	
	
	public function getOne($country, $year) {
			
	}
	
	
	
	public function country($country) {
		
	}
	
	
	
	public function year($year) {
		
	}
	
}

?>