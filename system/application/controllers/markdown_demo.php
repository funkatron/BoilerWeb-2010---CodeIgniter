<?php
class Markdown_Demo extends Controller {

	var $to_mdown = "[Funkatron!](http://funkatron.com)";

    function Markdown_Demo()
    {
        parent::Controller();
    }

	
	function index() {
		/*
			need to name file properly, place in app/libraries,
			and use parser object directly
		*/
		$this->load->library('markdownExtra_parser', null, 'mdown');
		
		echo "BEFORE:<pre>{$this->to_mdown}</pre>";
		
		echo "AFTER:".$this->mdown->transform($this->to_mdown);
	}

	public function justinclude()
	{
		/*
			just include it, and we don't need to massage
		*/
		include 'vendors/markdown.php';
		
		echo "BEFORE:<pre>{$this->to_mdown}</pre>";
		
		echo "AFTER:".markdown($this->to_mdown);
		
		
	}

}