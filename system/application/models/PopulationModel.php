<?php

/**
 * PopulationModel is a CI Model class
 *
 * @package default
 * @author Ed Finkler
 **/
class PopulationModel extends Model {
	
	const FORMAT_PHP		= 'php';
	const FORMAT_JSON		= 'json';
	const FORMAT_SERIALPHP	= 'sphp';
	
	/**
	 * format determines the format returned by the model
	 * see FORMAT_xxx class constants for options
	 *
	 * @var string
	 **/
	public $format = self::FORMAT_PHP;
	
	
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
		
		$data = array();
		
		$q = $this->db->query('SELECT DISTINCT country FROM country_population');
		
		foreach ($q->result() as $row) {
			$data[] = $row->country;
		}
		
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
		$data = array();
		
		$q = $this->db->query('SELECT DISTINCT year FROM country_population');
		
		foreach ($q->result() as $row) {
			$data[] = $row->year;
		}
		
		return $this->format($data);
	}
	
	
	/**
	 * get some data. all parameters are optional
	 *
	 * @param string $country   a valid country name
	 * @param integer $year     a valid year
	 * @param integer $start    default 0
	 * @param string $count     default 0, which means "everything"
	 * @return string|array
	 * @author Ed Finkler
	 */
	public function get($country=null, $year=null, $count=0, $start=0) {
		
		$data = array();
		
		/**
		 * for performance, specify columns instead of using '*'
		 */
		$this->db->select('country, year, population');
		if ( isset($country) && $country) {
			$this->db->where("country", $country);
		}
		if ( isset($year) && $year ) {
			$this->db->where("year", $year);
		}
		
		if ($start > 0 && $count > 0) {
			$this->db->limit($count, $start);
		} elseif ($count > 0) {
			$this->db->limit($count);
		}
		
		$q = $this->db->get('country_population');
		
		foreach ($q->result() as $row) {
			$data[] = $row;
		}
		
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
	
	
	public function getOne($country, $year, $count=0, $start=0) {
		
		$data = $this->get($country, $year, $start, $count);
		
		return $this->format($data);
	}
	
	
	public function getByYear($year, $count=0, $start=0) {
		
		$data = $this->get($year, $start, $count);
		
		return $this->format($data);
	}
	
	
	public function getByCountry($country, $count=0, $start=0) {
		
		$data = $this->get($country, $start, $count);
		
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
	
	
	public function setFormat($format)
	{
		$this->format = $format;
	}

	public function getFormat()
	{
		return $this->format;
	}
	
}

?>