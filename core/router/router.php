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

  // The model to load
  public $model;

  // The view to load 
  public $view;

  // The param which will be send to the controller and maybe to the model
  public $params;

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
	    	$this->view = "mainView";
	    	$this->model = "mainModel";
	    	$this->params = NULL;

	        break;

	    // We are on another page so load the Controller and the model with the same name 
	    default:
	        // Load the mainController, mainView and mainModel 
	    	$request = explode( "/", $request );

	    	$this->controller = $request[0];
	    	$this->view = $request[1];
	    	$this->model = $request[0];

	    	// Getting parameters, so let's keep only useful informations
	    	unset( $request[0] );
	    	unset( $request[1] );

	    	$this->params = $request;

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

	echo "<h2>Current view :</h2>";
	var_dump( $this->view );

	echo "<h2>Current params :</h2>";
	var_dump( $this->params );

  } 

}
?>