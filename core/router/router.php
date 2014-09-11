<?php 

/*
* @File core/router/router.php
* @Author : Quentin LOZACH 
* @Version : 0.1
* @Role : Route the page the user is requested : controller/view/param
*/ 
class Router { 
  
  // The controller to load
  public $controller;

  // The method in the controller to load
  public $method;

  // The model to load
  public $model;

  // The param which will be send to the controller and maybe to the model
  public $params;

  // If an error is in the Router, it would be useful to know it before
  public $error;

 /*
  * @Class Router
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : __construct : Each time a page will be load, this method will be called each time
  */ 
  function __construct( $request = FALSE ) { 
  		
  	// Are we on the index page or note ?
	switch ( $request ) {

		// We are on the index page
	    case FALSE :

	        // Load the mainController, mainView and mainModel 
	    	// We suppose that we don't have any param in the index
	    	$this->controller = "mainController";
	    	$this->method = "index";
	    	$this->model = "mainModel";
	    	$this->params = NULL;

	        break;

	    // We are on another page so load the Controller and the model with the same name 
	    default:
	        // Load the mainController, mainView and mainModel 
	    	$request = explode( "/", $request );

	    	if( empty( $request[1] ) && !empty( $request[0] ) ) {
	    		$this->error("empty-method");
	    	}
	    	else {
	    	$this->controller = $request[0];
	    	$this->method = $request[1];
	    	$this->model = $request[0];
	    	}

	    	// Getting parameters, so let's keep only useful informations
	    	unset( $request[0] );
	    	unset( $request[1] );

	    	// Getting the rest of the parameters in the $_GET['request'] in the URL
	    	if( !empty( $request[2] ) ) {
	    		$this->params = $request;
	    	}
	    	else {
	    		$this->params = NULL;
	    	}

	}

  } 

 /*
  * @Class Router
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : If there is a problem in the core we can know exactly where does the problem comes from
  */ 
  public function debug( ) { 

  	echo "<h1>Debugging the Router class :</h1>";

  	echo "<h2>Current controller :</h2>";
	var_dump( $this->controller );

	echo "<h2>Current model :</h2>";
	var_dump( $this->model );

	echo "<h2>Current method in the $this->controller :</h2>";
	var_dump( $this->method );

	// If there is a param, we can print it to the user
	if( !is_null( $this->params ) ) {
		echo "<h2>Current params :</h2>";
		var_dump( $this->params );
	}

  } 

 /*
  * @Class Router
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : If there is an error, this method will handle it, such as 404 error for example
  */ 
  private function error( $typeError ) { 

  	// There is an error in the Router
  	$this->error = TRUE;

  	switch ( $typeError ) {

		// If there is no method in the requested page
	    case "empty-method" :
	    	echo "<h1 style='color:red'>No method in the URL.<h1>";
	        break;

	    case "wrong-format" :
	    	echo "<h1 style='color:red'>The requested URL has a wronf format.<h1>";
	        break;

	    default:
	        echo "<h1 style='color:red'>Undefined error.<h1>";
	}

  } 

}
?>