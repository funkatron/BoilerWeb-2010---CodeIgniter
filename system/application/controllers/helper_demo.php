<?php

class Helper_Demo extends Controller {

    function Helper_Demo()
    {
        parent::Controller();
    }

	function index() {
		
		$this->load->helper('php');
		
		/*** a complex object ***/
	    $obj = new stdClass;
	    $obj->foo = new stdClass;
	    $obj->foo->baz = 'baz';
	    $obj->bar = 'bar';
	
		echo "BEFORE:<pre>"; var_dump($obj); echo "</pre>";
	
		$arr = objectToArray($obj);
		
		echo "AFTER:<pre>"; var_dump($arr); echo "</pre>";
	}
}

?>