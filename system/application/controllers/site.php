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

		$this->output->enable_profiler(TRUE);
		
		$this->load->model('PopulationModel');

	}
	
	/**
	 * this is our default if no method is specified on the URL
	 */
	public function index() {
		$this->load->view('welcome_message');
	}
	
	
	
	public function one($country, $year) {
		$vdata = $this->search($country, null, $count, $start);
		$this->load->view('dumpdata', $vdata);
	}
	
	
	
	public function country($country, $count=0, $start=0) {
		$vdata = $this->search($country, null, $count, $start);
		$this->load->view('dumpdata', $vdata);
	}
	
	
	
	public function year($year, $count=0, $start=0) {
		$vdata = $this->search(null, $year, $count, $start);
		$this->load->view('dumpdata', $vdata);	
	}
	
	
	
	private function search($country=null, $year=null, $count=0, $start=0) {
		
		$vdata = array();
		
		$vdata['data'] = $this->PopulationModel->get($country, $year, $count, $start);
		
		return $vdata;
	}
	
	
}

?>