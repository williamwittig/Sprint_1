<?php

/**
 * TODO: Routing from the home page to the form is not working
 * TODO: Add token to the form
 * TODO: Add server-side functionality to the form
 * TODO: Add client-side validation to the form
 * TODO: Add server-side validation to the form
 * TODO: Add form retrieval to the form from previous tokens
 */

//use model\DataLayer;
include 'controllers/controller.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once('vendor/autoload.php');

// Start the session
session_start();

// Create instance of the base class
$f3 = Base::instance();

// Creating an instance of the controllers class
$con = new Controller($f3);

// Define a default route
// Home page rendering
$f3->route('GET /', function()
{
	// Displaying the page
	global $con;
	$con->home();
});

$f3->route('GET|POST /educationPlan', function()
{
	// Displaying the page
	global $con;
	$con->educationPlan();
});

// Run fat free
$f3->run();