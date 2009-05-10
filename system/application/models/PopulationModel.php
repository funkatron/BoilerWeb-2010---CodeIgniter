<?php

/**
 * PopulationModel is a CI Model class
 *
 * @package default
 * @author Ed Finkler
 **/
class PopulationModel extends Model {
	
	const FORMAT_PHP		= 'PHP';
	const FORMAT_JSON		= 'JSON';
	const FORMAT_SERIALPHP	= 'PHP_SERIAL';
	
	/**
	 * format determines the format returned by the model
	 * can be 'php' (default), 'json', or 'xml'
	 *
	 * @var string
	 **/
	public format = self::FORMAT_PHP;
	
	/**
	 * Constructor
	 *
	 * @author Ed Finkler
	 */
	public function __construct() {
		
		parent::__construct();
		
		/**
		 * load the database with settings defined in config/database.php
		 */
		$this->load->database();
	}
	
	
	/**
	 * returns a set of valid country names in database
	 *
	 * @return string|array
	 * @author Ed Finkler
	 */
	public function getCountries() {
		
		return $this->format($data);
	}
	
	/**
	 * returns a set of valid years in database
	 *
	 * @return string|array
	 * @author Ed Finkler
	 */
	public function getYears()
	{
		return $this->format($data)
	}
	
	
	/**
	 * get some data. all parameters are optional
	 *
	 * @param string $country 
	 * @param integer $year
	 * @param integer $start default 0
	 * @param string $count  default -1, which means "everything"
	 * @return string|array
	 * @author Ed Finkler
	 */
	public function get($country=null, $year=null, $start=0, $count=-1) {
		
		return $this->format($data);
	}

	/**
	 * get ALL data
	 *
	 * @return string|array
	 * @author Ed Finkler
	 */
	public function getAll() {
		$data = $this->get();
		return $this->format($data);
	}
	
	
	public function getOne($country, $year, $start=0, $count=-1) {
		
		$data = $this->getOne($country, $year, $start, $count);
		
		return $this->format($data);
	}
	
	
	public function getByYear($year, $start=0, $count=-1) {
		
		$data = $this->getOne($year, $start, $count);
		
		return $this->format($data);
	}
	
	
	public function getByCountry($country, $start=0, $count=-1) {
		
		$data = $this->getOne($country, $start, $count);
		
		return $this->format($data);
	}
	
	
	private function format($data) {
		switch($this->format) {
			case self::FORMAT_PHP:
				// don't do anything
				$return_data = $data;
				break;
			case self::FORMAT_JSON:
				$return_data = json_encode($data);
				break;
			case self::FORMAT_SERIALPHP:
				$return_data = serialize($data);
				break;
			default:
				// don't do anything
				$return_data = $data;				
		}
		return $return_data;
	}
	
}

?>