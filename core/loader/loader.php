<?php 

define( 'CONTROLLER_PATH', MVC_PATH . 'controller/' );
define( 'MODEL_PATH', MVC_PATH . 'model/' );
define( 'VIEW_PATH', MVC_PATH . 'view/' );

/**
* This class will be called in the Router class to load the controllers, the method etc ...
* Can also be used in all the Controllers and files in the structure when we will need to load something for example
*
* @file core/loader/loader.php
* @author Quentin LOZACH 
* @version 0.1
*/ 
class Loader extends Singleton { 

 /**
  * Method to load a specific controller
  *
  * @method loadController
  * @access public
  * @param  string $controller name of the controller
  * @return void 
  * @author Quentin LOZACH
  * @version 0.1
  */
  public function loadController( $controller = FALSE ) {

      // If the controller in parameter is not empty
      if( isset( $controller ) ) {

        // If the file is not existing
        if(!file_exists(CONTROLLER_PATH. "$controller.php")) {
          Router::getInstance()->error( "no-controller", $controller );
        } 
        else {
           // If the file exists, we load the Controller 
           include CONTROLLER_PATH . "$controller.php";
           // We load a new instance of the controller
           $controller::getInstance();
        }

      }
      else {
          Router::getInstance()->errors("no-controller");
      }

  }

 /**
  * Method to load a specific method
  *
  * @method loadMethod
  * @access public
  * @param  string $controller name of the controller
  * @return void 
  * @author Quentin LOZACH
  * @version 0.1
  */
  public function loadMethod( $method = FALSE ) {

      $controller = Router::getInstance()->getController();

      // If the controller in parameter is not empty
      if( isset( $method ) ) {

        // If the file is not existing
        if( !method_exists ( $controller, $method ) ) {
          Router::getInstance()->error( "no-method", $method );
        } 
        else {
           $controller::$method();
        }

      }
      else {
          Router::getInstance()->errors("no-method");
      }

  }

  public function loadModel( $model = FALSE ) {

  }

  public function loadView( $view = FALSE ) {
  	echo "VIEW";
  }
}
?>