<?php 

/*
* @File core/loader/loader.php
* @Author : Quentin LOZACH 
* @Version : 0.1
* @Role : This class will be called in the Router class to load the controllers, the method etc ...
* Can also be used in all the Controllers and files in the structure when we will need to load something for example
*/ 
class Loader { 

 /*
  * @Class Loader
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : __construct : Constructor will be called at the initialization of the Loader
  */ 
  function __construct(  ) { 

    // Defining constants to access to Controller, Model, View folders
  	define( 'CONTROLLER_PATH', MVC_PATH . 'controller/' );
    define( 'MODEL_PATH', MVC_PATH . 'model/' );
    define( 'VIEW_PATH', MVC_PATH . 'view/' );

  } 

  public function loadController( $controller = FALSE ) {

    include CONTROLLER_PATH . "$controller.php";
    new $controller();
    
  }

  public function loadModel( $model = FALSE ) {

  }

  public function loadMethod( $method = FALSE ) {
  	
  }

  public function loadView( $view = FALSE ) {
  	echo "VIEW";
  }
}
?>