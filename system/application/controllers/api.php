<?php


class api extends Controller {

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

		$this->load->model('PopulationModel');

	}
	
	/**
	 * this is our default if no method is specified on the URL
	 */
	public function index() {
		$this->_sendRaw("Not found", PopulationModel::FORMAT_JSON, '404 Not Found');
		return;
	}
	
	public function getCountries() {
		$this->PopulationModel->setFormat(PopulationModel::FORMAT_JSON);
		$countries = $this->PopulationModel->getCountries();
		$this->_sendRaw($countries);
		return;
	}

	public function getYears() {
		$this->PopulationModel->setFormat(PopulationModel::FORMAT_JSON);
		$years = $this->PopulationModel->getYears();
		$this->_sendRaw($years);
		return;
	}
	
	
	
	public function one($country, $year) {
		$this->PopulationModel->setFormat(PopulationModel::FORMAT_JSON);
		$data = $this->_search($country, $year);
		$this->_sendRaw($data);
		return;
	}
	
	
	
	public function country($country, $count=0, $start=0) {
		$this->PopulationModel->setFormat(PopulationModel::FORMAT_JSON);
		$data = $this->_search($country, null, $count, $start);
		$this->_sendRaw($data);
		return;
	}
	
	
	
	public function year($year, $count=0, $start=0) {
		$this->PopulationModel->setFormat(PopulationModel::FORMAT_JSON);
		$data = $this->_search(null, $year, $count, $start);
		$this->_sendRaw($data);
		return;
	}
	
	
	public function search() {
		$input = $this->uri->uri_to_assoc(3, array('country', 'year', 'count', 'start', 'format') );

		
		$data = $this->_search($input['country'],
								(int)$input['year'],
								(int)$input['count'],
								(int)$input['start'],
								$input['format']);
		
		$this->_sendRaw($data, $input['format']);
	}
	
	
	
	private function _search($country=null, $year=null, $count=0, $start=0, $format=PopulationModel::FORMAT_JSON) {
		
		// echo "<pre>"; echo print_r($format, true); echo "</pre>";
		
		$this->PopulationModel->setFormat($format);
		
		// echo "<pre>"; var_dump($this->PopulationModel); echo "</pre>";
		
		$data = $this->PopulationModel->get($country, $year, $count, $start);
		return $data;
	}
	
	
	/**
	 * takes a php structure (an array or object) and serves it as JSON
	 *
	 * @param object $data 
	 * @param string $status 
	 * @return void
	 * @author Ed Finkler
	 */
	private function _sendRaw($response, $format='json', $status = '200 OK')
	{
		$this->output->set_header("HTTP/1.0 ".$status);
		$this->output->set_header("HTTP/1.1 ".$status);
		
		switch($format) {
			case PopulationModel::FORMAT_JSON:
				$this->output->set_header('Content-Type: application/json');
				break;
			case PopulationModel::FORMAT_SERIALPHP:
				$this->output->set_header('Content-Type: text/php');
				break;
			default:
				$this->output->set_header('Content-Type: application/json');
				break;
		}
		
		
		$this->output->set_output($response);
		return;
	}
	
	
}

?>