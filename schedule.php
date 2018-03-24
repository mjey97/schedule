<!DOCTYPE html>
<html>
<body>

<?php

// API connection to the SQL
// 

class Shift 
{
	private $ws_id = 1;
	private $p_id = 2;
	
	private $date = 'heute';
	private $week = 25;
	private $weekday = 'Montag';
	
	private $start = '07:00';
	private $end = '17:00';

}

class Schedule
{
	public $shifts = array();
	
	public function initialize()
	{
		$shift = new Shift();
		array_push($this->shifts, $shift);
		print_r($this->shifts);
	}
}

$schedule = new Schedule();
$schedule->initialize();

?>

</body>
</html>