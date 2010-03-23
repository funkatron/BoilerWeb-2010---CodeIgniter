<?php

class Error_Demo extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{	
		restore_error_handler();

		echo 'log_errors:'.ini_get('log_errors')."<br/>";
		echo 'display_errors:'.ini_get('display_errors')."<br/>";

		trigger_error("foo!", E_USER_WARNING);
		
		ini_set('display_errors', 0);
		
		trigger_error("foo2!", E_USER_ERROR);
		
		echo "display after error";
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */


