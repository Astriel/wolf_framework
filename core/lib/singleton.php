<?php
/**
* @file core/lib/singleton.php
* @author : Quentin LOZACH 
* @version : 0.1
* @role : Singleton abstract class
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
   * private constructor
   */
  final private function __construct(){
  	
  }

  /**
   * No object cloning
   */ 
  final private function __clone() {}

 /**
  * Singleton patern : return the only instance of the router class
  *
  * @method getInstance
  * @access public
  * @param  string $request URL of the requested page
  * @return Router
  * @author Quentin LOZACH
  * @version 0.1
  */
  final public static function getInstance( ) {
	$c = get_called_class();
     if(!isset(self::$_instances[$c])) {
       self::$_instances[$c] = new $c;  
     }
 
     return self::$_instances[$c];
  }
}
