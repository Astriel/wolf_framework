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
  * If an error is in the Router, it would be useful to know it before
  *
  * @var error 
  * @access private
  */
  private $error;

 /**
  * Each time a page will be load, this method will be called each time
  *
  * TODO : How are we supposed to provide the request string like so if it is a singleton? 
  *	Maxime Martineau
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
  				$this->error("empty-method");
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

 /**
  * If there is an error, this method will handle it, such as 404 error for example
  * 
  * @method error
  * @access public
  * @param string $typeError the type of the error, array $infosError some params linked to the error
  * @return void
  * @author Quentin LOZACH 
  * @version 0.1
  */ 
  public function error( $typeError, $infosError ) { 

    	// There is an error in the Router
    	$this->setError( TRUE );

    	switch ( $typeError ) {

  		// If there is no method in the requested page
  	    case "empty-method" :
  	    	echo "<h1 style='color:red'>No method in the URL.</h1>";
  	        break;

  	    case "wrong-format" :
  	    	echo "<h1 style='color:red'>The requested URL has a wronf format.</h1>";
  	        break;

        case "wrong-controller" :
          echo "<h1 style='color:red'>The controller does not exist</h1>";
            break;

        case "no-controller" :
          echo "<h1 style='color:red'>No controller was loaded</h1>";
            break;

        case "no-method" :
          echo "<h1 style='color:red'>No method was loaded</h1>";
            break;

  	    default :
  	        echo "<h1 style='color:red'>Undefined error.</h1>";
  	}

  } 

  /* =================== GETTERS ========================= */

  /**
  * Return the error attribute of the class
  * 
  * @method getError
  * @access public
  * @param void
  * @return string $error return the attribute of the classe Router
  * @author : Quentin LOZACH 
  * @version : 0.1
  */ 
  public function getError( ) { 
  	return $this->error;
  }

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

  /* =================== SETTERS ========================= */

  /**
  * Set the error attribute of the class
  * 
  * @method setError
  * @access public
  * @param string $value new value of the paramater error
  * @return void
  * @author : Quentin LOZACH 
  * @version : 0.1
  */ 
  public function setError( $value ) { 
    $this->error = $value;
  }

}
?>