<?php

/**
 * TODO: Routing from the home page to the form is not working
 */

//use models\DataLayer;
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

// Create an Instance of the DataLayer for data encapsulation
$datalayer = new DataLayer();

// Define a default route
// Home page rendering
$f3->route('GET /', function()
{
	// Displaying the page
	global $con;
	$con->home();
});

$f3->route('GET /home', function()
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

$f3->route('GET|POST /login', function()
{
	// Displaying the page
	global $con;
	$con->login();
});

$f3->route('GET|POST /logout', function()
{
	// Displaying the page
	global $con;
	$con->logout();
});

$f3->route('GET|POST /admin', function()
{
    // Displaying the page
    global $con;
    $con->admin();
});

// Run fat free
$f3->run();