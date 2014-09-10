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
  		
  	var_dump($request);

  	// Are we on the index page or note ?
	switch ( $request ) {

		// We are on the index page
	    case FALSE :
	        // Load the mainController, mainView and mainModel 
	    	$this->controller = "mainController";
	    	$this->view = "mainView";
	    	$this->model = "mainModel";
	    	$this->params = NULL;

	        break;

	    // We are on another page so load the Controller and the model with the same name 
	    default:
	        // Load the mainController, mainView and mainModel 
	    	$this->controller = $request[0];
	    	$this->view = $request[1];
	    	$this->model = $request[0];
	    	$this->params = NULL;

	}

	var_dump( $this->controller );
	var_dump( $this->model );
	var_dump( $this->view );
	var_dump( $this->params );

  } 

}
?>