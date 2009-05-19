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
		$this->load->helper('url');
		$this->load->helper('html');	
	}
	
	/**
	 * this is our default if no method is specified on the URL
	 */
	public function index() {
		
		$this->output->cache(5);
		
		$vdata = array();
		$vdata['page_title'] = 'Population Estimates';
		$vdata['countries'] = $this->PopulationModel->getCountries();
		$vdata['years']	    = $this->PopulationModel->getYears();
		
		$this->load->view('splash', $vdata);
	}
	
	
	
	public function one($country, $year) {
		$vdata = array();
		$vdata['page_title'] = 'One Result';
		$vdata['data'] = $this->_search($country, $year, $count, $start);
				
		$this->load->view('dumpdata', $vdata);
	}
	
	
	
	public function country($country, $count=0, $start=0) {
		$vdata = array();
		$vdata['page_title'] = 'Country';
		$vdata['data'] = $this->_search($country, null, $count, $start);
		$this->load->view('country', $vdata);
	}
	
	
	
	public function year($year, $count=0, $start=0) {
		$vdata = array();
		$vdata['page_title'] = 'Year';
		$vdata['data'] = $this->_search(null, $year, $count, $start);
		$this->load->view('year', $vdata);	
	}
	
	
	public function search() {
		$input = $this->uri->uri_to_assoc(3, array('country', 'year', 'count', 'start') );
		
		$vdata = array();
		$vdata['page_title'] = 'Search';
		$vdata['data'] = $this->_search($input['country'], (int)$input['year'], (int)$input['count'], (int)$input['start']);
		
		$this->load->view('year', $vdata);
	}
	
	
	
	private function _search($country=null, $year=null, $count=0, $start=0) {
		
		$data = array();
		
		$data = $this->PopulationModel->get($country, $year, $count, $start);
		
		return $data;
	}
	
	
}

?>