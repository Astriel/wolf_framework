<?php

/*
* File index.php
* @Author : Quentin LOZACH 
* @Version : 0.1
* @Page : index
* @Role : Link all the page and the structure to load the page the user wants
*/ 
// Defining PATH constants related to the project
define( 'BASE_PATH', dirname( realpath(__FILE__) ) );
define( 'CORE_PATH', BASE_PATH . '/core' );
define( 'CONFIG_PATH', BASE_PATH . '/configuration' );
define( 'APP_PATH', BASE_PATH . '/application' );

// Include constants 
include CONFIG_PATH . '/constants/mode.php';

// Configuring error handler
switch ( APP_MODE ) {

    case "development" :
    case "testing" :
        error_reporting( E_ALL );
        break;

    case "production" :
        error_reporting( 0 );
        break;

    default:
        error_reporting( E_ALL );

}

// Load the Router class
include BASE_PATH . '/core/router/router.php';

// Create an instansiation of a new page
if( !isset( $_GET['request'] ) ) {
	$page = new Router( );
}
else {
    $page = new Router( $_GET['request'] );
}

/* End of file index.php */
/* Location: ./index.php */
?>