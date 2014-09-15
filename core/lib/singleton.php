<?php
/**
* @file core/lib/singleton.php
* @class Singleton
* @author Quentin LOZACH 
* @version 0.1
* @role Singleton abstract class
*/ 
class Singleton {
 /**
  * get the unique instance of the class regarding the Singleton pattern
  *
  * @var instances 
  * @access private
  * @static
  */
  private static $_instances = array();

 /**
  * Constructor of a Singleton Class
  *
  * @method __construct
  * @access private
  * @param  void
  * @return Object 
  * @author Quentin LOZACH
  * @version 0.1
  */
  final private function __construct(){
  	
  }

 /**
  * No clone object
  *
  * @method __clone
  * @access private
  * @param  void
  * @return void 
  * @author Quentin LOZACH
  * @version 0.1
  */ 
  final private function __clone() {

  }

 /**
  * Singleton patern : return the only instance of the router class
  *
  * @method getInstance
  * @access public
  * @param  void
  * @return Object 
  * @author Quentin LOZACH
  * @version 0.1
  */
  final public static function getInstance( ) {

	$calledClass = get_called_class( );

     if( !isset( self::$_instances[$calledClass] ) ) {
       self::$_instances[$calledClass] = new $calledClass;  
     }
 
     return self::$_instances[$calledClass];
  }
  
}
