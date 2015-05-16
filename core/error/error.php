<?php 
/**
*
* @file core/error/error.php
* @role Class to handle all the error in the structure
* @class router
* @author Quentin LOZACH 
* @version : 0.1
*/ 
class Error extends Singleton { 

  // TRUE if there is an error, false if not
  public $status = FALSE;

 /**
  * Print an error message
  *
  * @method printError
  * @access public
  * @param  string $message error message
  * @return void
  * @author Quentin LOZACH 
  * @version 0.1
  */

	public function setError( $message ) {
		$this->status = TRUE;
		echo "<h1 style='color:red'>$message</h1>";
	}
}
?>