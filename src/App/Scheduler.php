<?php
namespace App;

class Scheduler {
	public function isOpened() {
		$time = time();
//		$time = 1458757093; // wednesday
//		$time = 1459005493; // saturday

		$time = localtime($time, true);
		$day_of_week = $time['tm_wday'];
		$hour = $time['tm_hour'];

		if($day_of_week == 3 && $hour >= 19 && $hour < 23 // wednesday
		   || $day_of_week == 6 && $hour >= 13 && $hour <= 19) { // saturday
			return true;
		}

		return false;
	}
}