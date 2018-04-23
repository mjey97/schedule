<!doctype html>
<html lang="en">
    
<head
<!-- @Author MJ -->
<!-- Start Project 24.03.2018 -->
<!-- Shortcut Netbeans delete line: Ctrl+E -->

<!-- necessary for bootstrap -->
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
  
<body>
    
<!-- necessary for bootstrap -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
<?php

// API connection to the SQL
// 

class Weekdays
{
    const Monday = 'Monday';
    const Tuesday = 'Tuesday';
    const Wednesday = 'Wednesday';
    const Thursday = 'Thursday';
    const Friday = 'Friday';
    const Saturday = 'Saturday';
    const Sunday = 'Sunday';
    
    public static $Weekdays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    
    /**
     * get the number of weekdays (7)
     * no magic value because the weekdays could be lower in other companies
     * @return int
     */
    public static function numberOfWeekdays() {
        return count(Weekdays::$Weekdays);
    }
    
    /**
     * test if the index with value is matching
     * @param int $int array index
     * @param str $str array str value
     * @return boolean
     */
    public static function testIfSameWeekday($int, $str) {
        return (Weekdays::$Weekdays[$int] == $str);
    }
    
    /**
     * get the weekday str by index
     * @param int $int weekday index
     * @return str
     */
    public static function getWeekDayNameByIndex($int) {
        return Weekdays::$Weekdays[$int];
    }
}

/**
 * Shift class contains all necessary dates of one shift.
 */
class Shift 
{
    //todo use an interface
    public $ws_id;
    public $p_id;

    public $date;
    public $week;
    public $weekday;

    public $start;
    public $end;
    
    public $name;

    function __construct($ws_id, $p_id, $date, $week, $weekday, $start, $end, $name)
    {	
        $this->ws_id = $ws_id;
        $this->p_id = $p_id;
        $this->date = $date;
        $this->week = $week;
        $this->weekday = $weekday;
        $this->start = $start;
        $this->end = $end;
        $this->name = $name; //todo create new db table/class/interface for person
    }
}

/**
 * Schedule class is responsible for all schedule dates. This includes to get 
 * and show them.
 */
class Schedule
{
    //contains all shift dates, usage of the shift class
    public $schedule = array();

    /**
     * creates the db connection and fills the $schedule array
     */
    public function initialize()
    {
        include 'db/access.php';
        $servername = DB_SERVERNAME;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $dbname = DB_DB_NAME;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM schedule";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // add new instance to the schedule variable
                $shift = new Shift($row["ws_id"], $row["p_id"], $row["date"], $row["week"], $row["weekday"], $row["start"], $row["end"], $row["name"]);
                array_push($this->schedule, $shift);
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    
    /**
     * prints one sorted week of a table based on the week of a year. 
     * TODO take care of the year
     * @param int $week week of a year
     */
    public function printWeekTable($week) {
        $schedule = $this->schedule;
        
        $schedule = $this->extractWeekOfSchedule($schedule, $week);
        $schedule = $this->sortScheduleByDateAndTime($schedule);
        
        //div week
        echo "<div id='week' class='m-2' style='overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap; display:flex;'>";
        
        for ($weekdays = 0; $weekdays < Weekdays::numberOfWeekdays(); $weekdays++) {
            //div days
            echo "<div id='day' style='display: inline-block;'>";
            
            //if no db entry for this day
            if (empty($schedule) or !Weekdays::testIfSameWeekday($weekdays, $schedule[0]->weekday)) {
                //div emty shift
                echo "<div id='shift' class='card border-danger mb-3'>";
                echo "<div class='card-header text-center bg-light'><h4 class='text-primary'><strong>" .
                    Weekdays::getWeekDayNameByIndex($weekdays). "</strong></h4></div>";
                echo "<h5 class='list-group-item text-center text-danger'><strong>Open</strong></h5>";
                echo "</div>"; //end shift
            }
            
            //todo check if all bootstrap statements necessary
            while (!empty($schedule) and (Weekdays::testIfSameWeekday($weekdays, $schedule[0]->weekday))) {
                //div shifts
                $shift = array_shift($schedule);
                echo "<div id='shift' class='card bg-light mb-3'>";
                echo "<div class='card-header text-center bg-light'><h4 class='text-primary'><strong>$shift->weekday</strong></h4> $shift->date</div>";
                echo " <div class='card-body p-0'>
                    <ul class='list-group list-group-flush'>
                    <li class='list-group-item'><h5 class='text-center'><strong>$shift->name</strong></h5></li>
                    <li class='list-group-item'>Start: $shift->start </br> End: $shift->end</li>
                    </ul>
                    </div> ";
                echo "</div>"; //end shift
            }
            //todo create empty box if no shift in that day
            
            echo "</div>"; //end day
        }
          
        echo "</div>"; //end week
    }
    
    /**
     * Return a schedule array with contains only dates of the specified week
     * @param array of Shifts $array
     * @param type $week this week gets extracted from the schedule array
     * @return Schedule[] array with dates only from a specific week
     */
    private function extractWeekOfSchedule($array, $week) {
        $array = $this->helper_array_remove_object($array, $week, 'week');
        return $array;
    }
    
    /**
    * Remove each instance of an object within an array (matched on a given property, $prop)
    * @param array $array
    * @param mixed $value
    * @param string $prop
    * @return array
    */
   private function helper_array_remove_object($array, $value, $prop)
   {
        return array_filter($array, function($a) use($value, $prop) {
            return $a->$prop == $value;
        });
    }
    
    /**
     * sorts the given schedule by date and time
     * alternative idea was to sort inside the db
     * @param Schedule[] $schedule sorted array as descripted
     * @return array of Shift 
     */
    private function sortScheduleByDateAndTime($schedule) {
        usort($schedule, array($this, 'helper_sort_objects_by_date_and_time'));
        return $schedule;
    }
    
    /**
     * helper function for sortScheduleByDateAndTime
     * @param Shift $a
     * @param Shift $b
     * @return int return value for the usort function
     */
    private function helper_sort_objects_by_date_and_time($a, $b) {
	if(($a->date == $b->date) and ($a->start == $b->start)) { return 0 ; }
        if(($a->date == $b->date)) {
            return ($a->start < $b->start) ? -1 : 1;
        } else {
            return ($a->date < $b->date) ? -1 : 1;
        }
    }
    
}

?>



<?php

/**
 * Prints the headline and week number.
 * @param int $week
 */
function printHeader($week) {
    echo "<h1 class='text-center bg-primary text-white m-0'>Work Schedule</h1>";
    echo "<h2 class='bg-dark text-white p-2'>Week $week</h2>";
}

/**
 * Prints the footer including a link to the github project.
 */
function printFooter() {
    echo "<blockquote class='blockquote text-right mr-3'>
        <p class='mb-0'><strong>Personal project which shows a work schedule based on a sql database.</strong></p>
        <p class='mb-0'>Open source code on GitHub -> <a href='https://github.com/mjey97/schedule' target='_blank'>Source Code</a></p>
        <footer class='blockquote-footer'>Developed by Marcel Unger - 20y.></footer>
        </blockquote>";
}

$Schedule = new Schedule();
$Schedule->initialize();
$date = new DateTime();
$week = $date->format("W");

//output
printHeader($week);
$Schedule->printWeekTable($week);
printFooter();

?>

</body>
</html>