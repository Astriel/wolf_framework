<?php 

/**
* Route the page the user is requested : controller/view/param
*
* @file core/router/router.php
* @class router
* @author Quentin LOZACH 
* @version : 0.1
*/ 
class Router extends Singleton { 
  
  /**
  * The controller to load
  *
  * @var controller 
  * @access private
  */
  private $controller;

  /**
  * The method in the controller to load
  *
  * @var method 
  * @access private
  */
  private $method;

  /**
  * The param which will be send to the controller and maybe to the model
  *
  * @var params 
  * @access private
  */
  private $params;

 /**
  * Each time a page will be load, this method will be called each time
  *
  * @method parseRequest
  * @access public
  * @param string $request URL of the requested page
  * @return void
  * @author Quentin LOZACH 
  * @version 0.1
  */ 
  public function parseRequest( $request = FALSE ) { 

    // Load the Loader class
  	include BASE_PATH . '/core/loader/loader.php';

    // Are we on the index page or note ?
  	switch ( $request ) {

  		// We are on the index page
  	    case FALSE :

  	      // Load the mainController, the index method, mainView 
  	    	$this->controller = "mainController";
  	    	$this->method = "index";
  	    	$this->params = NULL;

  	    	Loader::getInstance()->loadController( $this->controller );
          Loader::getInstance()->loadMethod( $this->method );

  	    break;

  	    // We are on another page so load the Controller and the model with the same name 
  	    default:

  			// Load the mainController, mainView and mainModel 
  			$requestExploded = explode( "/", $request );

  			// If the user is trying to load a file directly in the URL such as : .php, .html, .css, .js, .sql ...
  			$requestSecured = explode( ".", $request );

  			// If there is only a controller with no method, raise an error with error() method
  			if( empty( $requestExploded[1] ) && !empty( $requestExploded[0] ) ) {
  				Error::getInstance()->setError( "No method was in parameters." );
  			}
        
  			// If there is a controller and a method in parameters in the URL 
  			else {

  				// If requestSecured[1] is not empty the user tried to load a file in the URL
  				if( isset( $requestSecured[1] ) ) {
  					// The controller is the name of the 1st param but cleaned with the explode
  					$this->controller = $requestSecured[0];
  				}
  				else {
  					// The controller is the first parameter of the URL 
  					$this->controller = $requestExploded[0];
  				}

  				// The method is the second parameter of the URL 
  				$this->method = $requestExploded[1];
  			}

  			// Getting parameters, so let's keep only useful informations
  			unset( $requestExploded[0] );
  			unset( $requestExploded[1] );

  			// Getting the rest of the parameters in the $_GET['request'] in the URL
  			if( !empty( $requestExploded[2] ) ) {
  				$this->params = $requestExploded;
  			}
  			else {
  				$this->params = NULL;
  			}

        // Load the controller
        Loader::getInstance()->loadController( $this->controller );

        // Load the method
        Loader::getInstance()->loadMethod( $this->method );
  	}

  } 


 /**
  * If there is a problem in the core we can know exactly where does the problem comes from
  * 
  * @method debug
  * @access public
  * @param void
  * @return void
  * @author Quentin LOZACH 
  * @version 0.1
  */ 
  public function debug( ) { 

    echo "<h1>Debugging the Router class :</h1>";

    echo "<h2>Current controller :</h2>";
  	var_dump( $this->controller );

  	echo "<h2>Current method in the $this->controller Controller :</h2>";
  	var_dump( $this->method );

  	// If there is a param, we can print it to the user
  	if( !is_null( $this->params ) ) {
  		echo "<h2>Current params :</h2>";
  		var_dump( $this->params );
  	}

  } 

  /* =================== GETTERS ========================= */

  /**
  * Return the controller attribute of the class
  * 
  * @method getController
  * @access public
  * @param void
  * @return string $controller return the attribute of the classe Router
  * @author : Quentin LOZACH 
  * @version : 0.1
  */ 
  public function getController( ) { 
    return $this->controller;
  }

}
?>
