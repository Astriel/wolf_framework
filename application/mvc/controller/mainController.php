<?php 

/*
* @File application/mvc/controller/mainController.php
* @Author : Quentin LOZACH 
* @Version : 0.1
* @Role : This Controller will be load on the index page
*/ 
class mainController { 

 /*
  * @Class mainController
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : __construct : Constructor of the mainController called in the index page
  */ 
  function __construct( ) { 

  } 

 /*
  * @Class mainController
  * @Author : Quentin LOZACH 
  * @Version : 0.1
  * @Method : When you go on the root of the project : index page, this method will be automatically load in this controller
  */ 
  public function index( ) {

  		echo "<h1 style='color:blue'>I'm the index method, in the mainController.</h1>";
  		echo "<h3 style='color:blue'>I should appear on the root of the project and nowhere else.</h3>";

  }

}
?>