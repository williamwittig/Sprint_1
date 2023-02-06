<?php

class Controller {
	private $_f3;

	/**
	 * This method constructs a controllers object
	 * @param $f3
	 */
	function __construct($f3) {
		$this->_f3=$f3;
	}

	function home() {
		$view=new Template();
		echo $view->render('views/home.html');
	}

	function educationPlan() {
		// Get the token from the URL
		$url = parse_url($_SERVER['REQUEST_URI']);
		$token = $url['query'];

		// If the date is before June show previous year's schedule
		if ($this->getCurrentMonth() < 6) {
			$this->_f3->set('year', $this->getCurrentYear());
		}
		// If the date is after June show next year's schedule
		else {
			$this->_f3->set('year', ((int)$this->getCurrentYear()) + 1);
		}

		// If the user input a token, retrieve the schedule
		if ($token!='' && $GLOBALS['datalayer']->planExists($token)) {
			// echo "Retrieving schedule...<br>";
			$GLOBALS['datalayer']->getSchedule($token);
		}
		// If the user did not input a token, generate a new one
		else {
			// echo "Generating new token...<br>";
			$token = $this->generateStudentToken();
			$_SESSION['schedule'] = new Schedule($token, "", "",
				"", "", "", "");
		}

		// Rendering the education plan page
		$view=new Template();
		echo $view->render('views/education_plan.html');

		// Saving the schedule to the database
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			if ($GLOBALS['datalayer']->planExists($_SESSION['schedule']->getToken())) {
				$GLOBALS['datalayer']->updateSchedule($token, $_POST['advisor'], $_POST['fallQtr'],
					$_POST['winterQtr'], $_POST['springQtr'], $_POST['summerQtr'],
					$this->getTime());
			}
			else {
				$GLOBALS['datalayer']->saveNewPlan($token, $this->getTime());
			}
			$this->addTokenToURL($token);
		}

        // Adding more quarter blocks
        if (array_key_exists('addYearBackward', $_POST)) {
            echo '<h1>works1</h1>';
            $this->addYearBackward();
        }

        if (array_key_exists('addYearForward', $_POST)) {
            echo '<h1>works2</h1>';
            $this->addYearForward();
        }
	}

	function login() {
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
			header("Location: admin");
			exit();
		}

		// Checking for login
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			// Get the username and password from the form
			$username = $_POST['username'];
			$password = $_POST['password'];

			// Check if the username and password are valid
			if ($this->isValidLogin($username, $password)) {
				// Redirect to the admin page
				$_SESSION['loggedIn'] = true;
				header("Location: admin");
				exit();
			} else {
                // Incorrect username
                if (!$this->isValidUsername($username)) {
                    $_SESSION['usernameError'] = 'Username Error';
                }

                // Incorrect password
                if (!$this->isValidPassword($password)) {
                    $_SESSION['passwordError'] = 'Password Error';
                }

                // Redirect to the login page
                $_SESSION['loggedIn'] = false;
            }
		}

		// Rendering the education plan page
		$view=new Template();
		echo $view->render('views/login.html');
	}

    function isValidUsername($username) {
        return $username === 'admin';
    }

    function isValidPassword($password) {
        return $password === 'admin';
    }

	function isValidLogin($username, $password) {
		return $this->isValidUsername($username) && $this->isValidPassword($password);
	}

	function logout() {
		session_destroy();
		header("Location: home");
		exit();
	}


    function admin() {
        if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
            header("Location: login");
            exit();
        }

		// Get all schedules from the database
		$schedules = $GLOBALS['datalayer']->getAllSchedules();
		$this->_f3->set('schedules', $schedules);

        $view=new Template();
        echo $view->render('views/admin.html');
    }


	function getCurrentDay() {
		date_default_timezone_set('America/Los_Angeles');
		return date('d');
	}

	function getCurrentMonth() {
		date_default_timezone_set('America/Los_Angeles');
		return date('m');
	}

	function getCurrentYear() {
		date_default_timezone_set('America/Los_Angeles');
		return date('Y');
	}

	function getTime() {
		date_default_timezone_set('America/Los_Angeles');
		return date('h:i:s a', time());
	}

	function hasQuery() {
		$url = parse_url($_SERVER['REQUEST_URI']);
		return $url['query']!='';
	}

	function addTokenToURL($token) {
		if (!$this->hasQuery()) {
			$url=$_SERVER['REQUEST_URI'];
			$url=$url."?".$token;
			header("Location: $url");
		}
	}

	function generateStudentToken() {
//		return random_int(100000, 999999);
		$token = $this->randHash();
		while ($GLOBALS['datalayer']->planExists($token)) {
			$token = $this->randHash();
		}
		return $token;
	}

	function randHash() {
		$token = md5(uniqid(rand(), true));
		return substr($token, -6);
	}

    function test() {
        $view=new Template();
        echo $view->render('views/test.php');
    }
}