<?php
/*
*
*
*
*
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

// echo $_GET['request'];

/* End of file index.php */
/* Location: ./index.php */
?>