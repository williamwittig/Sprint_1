<?php

class DataLayer {
    // FIELDS
	private $_dbh;

	/**
	 * DataLayer Constructor. Initializes PDO and enables error reporting.
	 */
	function __construct() {
		// Get PDO object
		require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';
        $this->_dbh = $dbh;

		// Enable Error reporting
		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
	}
    

    ////   EXISTENCE CHECKING METHODS   ////  

	/**
	 * Method to check if a token exists in the database.
	 * @param string $token plan identifier to search for
	 * @return bool True if plan was found, false otherwise
	 */
	function planExists($token) {
		// Get Plan
        $sql = "SELECT * FROM plans WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

		// Return True if plan was found, false otherwise
        return !empty($sql->fetch(PDO::FETCH_ASSOC));
	}

	/**
	 * Method to check if a school year has been previously saved
	 * on a given plan.
	 * @param int $schoolYear school year the look for
	 * @param string $token plan identifyer
	 * @return bool True if year exists for given plan, false otherwise
	 */
	function yearExists($schoolYear, $token): bool 
	{
        // Try to get a quarter of the SchoolYear
        $sql = "SELECT * FROM quarters WHERE token = :token AND year = :schoolYear AND quarter = 'winter'";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':schoolYear', $schoolYear, PDO::PARAM_STR);
        $sql->execute();

        return !empty($sql->fetch(PDO::FETCH_ASSOC));
    }


    ////   GETTER METHODS   ////

	/**
	 * Method to retrieve a Plan/Schedule with all quarter data using a token.
     * Stores data in Schedule object and saves to SESSION['schedule']
     * @param string $token unique identifier for a plan/schedule
	 */
	function getSchedule($token) {
		// Get Plan
        $sql = "SELECT * FROM plans WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

        $plan = $sql->fetch(PDO::FETCH_ASSOC);

        // Get Quarter data
        $sql = "SELECT * FROM quarters WHERE token = :token ORDER BY `year`";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

		// Parse Quarter data into school years // columns: token, year, quarter, notes
		$schoolYears = array();
        $quarters = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($quarters)) {
			
			foreach ($quarters as $quarter) {
				// Calendar year offset
				$offset = 0;
				if ($quarter['quarter'] == 'fall') {
					$offset = 1;
				}
				
				// GET OR CREATE School Year
                $newYear = $schoolYears[$quarter['year'] + $offset] ??
                        new SchoolYear($quarter['year'] + $offset);

				// Add quarter data to school year
				switch($quarter['quarter']) {
					case 'fall':
						$newYear.setFallNotes($quarter['notes']);
						break;
					case 'winter':
						$newYear.setWinterNotes($quarter['notes']);
						break;
					case 'spring':
						$newYear.setSpringNotes($quarter['notes']);
						break;
					case 'summer':
						$newYear.setSummerNotes($quarter['notes']);
				}
			}
		}
        // Render years that appear between years with data
        $schoolYears = markMiddleYearsForRender($schoolYears);

		// Create and Store Schedule object		
		$_SESSION['schedule'] = new Schedule(
            $plan['token'], $plan['advisor'], $plan['lastUpdated'], $schoolYears);
	}

    // Method to mark years with no data for render if they are between
    // two years with data.
    private static function markMiddleYearsForRender($schoolYears): array
    {
        $first = 3000;
        $last = 0;

        // Find lowest and highest years with data
        foreach ($schoolYears as $schoolYear) {
            if ($schoolYear.shouldRender() == true) {
                $year = $schoolYear.getYear();
                
                if ($year < $first) {
                    $first = $year;
                }
                else if ($year > $last) {
                    $last = $year;
                }
            }
        }

        // Mark middle years for render
        for ($i = $first; $i < $last; $i++) {
            $schoolYear.setRender(true);
        }

        return $schoolYears;
    }

    /**
	 * Method to get all plans. Does not include quarter data.
	 * @return array of plans containing token, advisor, and lastUpdated
	 */
	function getAllSchedules() {
		$sql = "SELECT * FROM plans";
        $sql = $this->_dbh->prepare($sql);
        $sql->execute();

        // Get query results
        return $sql->fetchAll(PDO::FETCH_ASSOC);
	}


    ////   SAVE NEW PLAN   ////

	/**
	 * Method to save a new schedule/plan
     * @param string $token unique identifier for a plan/schedule
     * @return bool True if the plan was saved, false if an error was detected
	 */
	function saveNewPlan($token): bool
    {
        // Attempt to insert Plan
        $sql = "INSERT INTO plans (token, lastUpdated, advisor)
            VALUES (:token, :lastUpdated, :advisor)";

        $sql = $this->_dbh->prepare($sql);

        // TODO: GET DATA WHEN POST FORMAT IS CONFIRMED
        $advisor = $_POST['advisor'];
        $lastUpdated = time();

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);
        $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

        // Check if plan was saved
        if (!$sql->execute()) {
            return false;
        }

        // TODO: UPDATE WHEN POST FORMAT IS CONFIRMED
        foreach($_POST['schoolYears'] as $schoolYear) {
            $this->saveYear($schoolYear, $token);
        }
        return true;
    }

    // Method to store a single year
    private function saveYear($schoolYear, $token): bool
    {
        $sql = "INSERT INTO quarters (token, year, quarter, notes)
                VALUES (:token1, :fallYear, 'fall', :fall),
                       (:token2, :winterYear, 'winter', :winter),
                       (:token3, :springYear, 'spring', :spring),
                       (:token4, :summerYear, 'summer', :summer)";

        $sql = $this->_dbh->prepare($sql);

        $fall = $schoolYear['fall']['notes'];
        $winter = $schoolYear['winter']['notes'];
        $spring = $schoolYear['spring']['notes'];
        $summer = $schoolYear['summer']['notes'];
        $fallYear = $schoolYear['fall']['calendarYear'];
        $winterYear = $schoolYear['winter']['calendarYear'];
        $springYear = $schoolYear['spring']['calendarYear'];
        $summerYear = $schoolYear['summer']['calendarYear'];

        $sql->bindParam(':token1', $token, PDO::PARAM_STR);
        $sql->bindParam(':token2', $token, PDO::PARAM_STR);
        $sql->bindParam(':token3', $token, PDO::PARAM_STR);
        $sql->bindParam(':token4', $token, PDO::PARAM_STR);
        $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
        $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
        $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
        $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
        $sql->bindParam(':fallYear', $fallYear, PDO::PARAM_INT);
        $sql->bindParam(':winterYear', $winterYear, PDO::PARAM_INT);
        $sql->bindParam(':springYear', $springYear, PDO::PARAM_INT);
        $sql->bindParam(':summerYear', $summerYear, PDO::PARAM_INT);

        return $sql->execute();
    }


    ////   UPDATE EXISTING PLAN   ////

    /**
     * Method to update an existing plan/schedule.
     * @param string $token unique identifier for a plan/schedule
     * @return bool True if plan was updated, false if an error was detected
     */
	function updateSchedule($token) {
		// Attempt to update
        $sql = "UPDATE plans SET  
            lastUpdated = :lastUpdated,
            advisor = :advisor
            WHERE token = :token";

        $sql = $this->_dbh->prepare($sql);

        // Load data from POST
        $advisor = $_POST['advisor'];
        $lastUpdated = time();

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);
        $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

        // Attempt to save plan data
        if ($sql->execute()) {
            // Update all years and quarters passed
            foreach ($_POST['schoolYears'] as $schoolYear) {
                if ($this->yearExists($schoolYear, $token)) {
                    $this->updateYear($schoolYear, $token);
                }
                else {
                    $this->saveYear($schoolYear, $token);
                }
            }
            return true;
        }
        return false;
	}

    // Method to update a single given year
    private function updateYear($schoolYear, $token): bool
    {
        // FALL
        $sql = "UPDATE quarters 
                SET `notes` = :fall
                WHERE `token` = :token AND `year` = :fallYear AND quarter = 'fall'";
        $sql = $this->_dbh->prepare($sql);
        $fall = $schoolYear['fall']['notes'];
        $fallYear = $schoolYear['fall']['calendarYear'];
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
        $sql->bindParam(':fallYear', $fallYear, PDO::PARAM_INT);
        $sql->execute();

        // WINTER
        $sql = "UPDATE quarters 
                SET `notes` = :winter
                WHERE `token` = :token AND `year` = :winterYear AND quarter = 'winter'";
        $sql = $this->_dbh->prepare($sql);
        $winter = $schoolYear['winter']['notes'];
        $winterYear = $schoolYear['winter']['calendarYear'];
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
        $sql->bindParam(':winterYear', $winterYear, PDO::PARAM_INT);
        $sql->execute();

        // SPRING
        $sql = "UPDATE quarters 
                SET `notes` = :spring
                WHERE `token` = :token AND `year` = :springYear AND quarter = 'spring'";
        $sql = $this->_dbh->prepare($sql);
        $spring = $schoolYear['spring']['notes'];
        $springYear = $schoolYear['spring']['calendarYear'];
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
        $sql->bindParam(':springYear', $springYear, PDO::PARAM_INT);
        $sql->execute();

        // SUMMER
        $sql = "UPDATE quarters 
                SET `notes` = :summer
                WHERE `token` = :token AND `year` = :summerYear AND quarter = 'summer'";
        $sql = $this->_dbh->prepare($sql);
        $summer = $schoolYear['summer']['notes'];
        $summerYear = $schoolYear['summer']['calendarYear'];
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
        $sql->bindParam(':summerYear', $summerYear, PDO::PARAM_INT);

        return $sql->execute();
    }


	////   UNUSED METHODS   ////

    /**
     * Function to randomly generate a new token.
     * Ensures that the token does not already exist
     * @return string unique token for a new plan
     */
    function generateToken(): string
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = substr(str_shuffle($permitted_chars), 0, 6);

        // Prevent reusing tokens
        while(!(Validator::validToken($token)) || $this->planExists($token)) {
            $token = substr(str_shuffle($permitted_chars), 0, 6);
        }

        return $token;
    }


    static function createBlankPlan()
    {
        // Get data
        $currentSchoolYear = self::getCurrentSchoolYear();

        $plan['schoolYears'][$currentSchoolYear] = []; // Add current year
        $plan['schoolYears'][$currentSchoolYear]['render'] = true; // Set year to render
        $plan['schoolYears'][$currentSchoolYear]['fall']['notes'] = ""; // Initialize notes to empty
        $plan['schoolYears'][$currentSchoolYear]['winter']['notes'] = "";
        $plan['schoolYears'][$currentSchoolYear]['spring']['notes'] = "";
        $plan['schoolYears'][$currentSchoolYear]['summer']['notes'] = "";
        $plan['schoolYears'][$currentSchoolYear]['fall']['calendarYear'] = $currentSchoolYear - 1; // Set calendar Years
        $plan['schoolYears'][$currentSchoolYear]['winter']['calendarYear'] = $currentSchoolYear;
        $plan['schoolYears'][$currentSchoolYear]['spring']['calendarYear'] = $currentSchoolYear;
        $plan['schoolYears'][$currentSchoolYear]['summer']['calendarYear'] = $currentSchoolYear;

        return $plan;
    }

    static function getCurrentSchoolYear(): int
    {
        // If date is july or later, return next school year
        if (idate("m") > 6) {
            return idate("Y") + 1;
        }
        // If date is before july, return current school year
        return idate ("Y");
    }

}