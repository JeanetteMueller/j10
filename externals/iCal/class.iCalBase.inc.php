<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//+----------------------------------------------------------------------+
//| WAMP (XP-SP2/2.2/5.2/5.1.0)                                          |
//+----------------------------------------------------------------------+
//| Copyright(c) 2001-2008 Michael Wimmer                                |
//+----------------------------------------------------------------------+
//| Licence: GNU General Public License v3                               |
//+----------------------------------------------------------------------+
//| Authors: Michael Wimmer <flaimo@gmail.com>                           |
//+----------------------------------------------------------------------+
//
// $Id$

/**
* @package iCalendar Everything to generate simple iCal files
*/
/**
* Base Class for the different Modules
*
* Tested with WAMP (XP-SP2/2.2/5.2/5.1.0)
* Last Change: 2008-04-07
*
* @access protected
* @author Michael Wimmer <flaimo@gmail.com>
* @copyright Copyright © 2002-2008, Michael Wimmer
* @license GNU General Public License v3
* @link http://code.google.com/p/flaimo-php/
* @package iCalendar
* @version 2.002
*/
abstract class iCalBase {

	/*-------------------*/
	/* V A R I A B L E S */
	/*-------------------*/

	/**
	* FALSE = GMT time, TRUE = locale time
	*/
	CONST USE_LOCALE_TIME = FALSE;

	/**#@+
	* @var string
	*/
	/**
	* Detailed information for the module
	*/
	private $description;

	/**
	* iso code language (en, de,…)
	*/
	private $lang;

	/**
	* If not empty, contains a Link for that module
	*/
	private $url;

	/**
	* Headline for the module (mostly displayed in your cal programm)
	*/
	private $summary;

	/**
	* String of days for the recurring module (example: “SU,MO”)
	*/
	private $rec_days;

	/**
	* Location of the module
	*/
	private $location;

	/**
	* String with the categories asigned to the module
	*/
	private $categories;

	/**
	* last modification date in iCal format
	*/
	private $last_mod;
	/**#@-*/

	/**#@+
	* @var array
	*/
	/**
	* Organizer of the module; $organizer[0] = Name, $organizer[1] = e-mail
	*/
	private $organizer = array('vCalEvent class', 'http://www.flaimo.com');

	/**
	* List of short strings symbolizing the weekdays
	*/
	private $short_daynames = array('SU','MO','TU','WE','TH','FR','SA');

	/**
	* If the method is REQUEST, all attendees are listet in the file
	*
	* key = attendee name, value = e-mail, second value = role of the attendee
	* [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON] (example: array('Michi' => 'flaimo@gmx.net,1'); )
	*/
	private $attendees = array();

	/**
	* Array with the categories asigned to the module (example:
	* array('Freetime','Party'))
	*/
	private $categories_array;

	/**
	* Exeptions dates for the recurring module (Array of timestamps)
	*/
	private $exept_dates;
	/**#@-*/

	/**#@+
	* @var int
	*/
	/**
	* set to 0
	*/
	private $sequence;

	/**
	* 0 = once, 1-7 = secoundly - yearly
	*/
	private $frequency;

	/**
	* If not empty, contains the status of the module
	* (0 = TENTATIVE, 1 = CONFIRMED, 2 = CANCELLED)
	*/
	private $status;

	/**
	* Short string symbolizing the startday of the week
	*/
	private $week_start = 1;

	/**
	* interval of the recurring date (example: every 2,3,4 weeks)
	*/
	private $interval = 1;

	/**
	* PRIVATE (0) or PUBLIC (1) or CONFIDENTIAL (2)
	*/
	private $class;

	/**
	* set to 5 (value between 0 and 9)
	*/
	private $priority;

	/**
	* Timestamp of the last modification
	*/
	private $last_mod_ts;
	/**#@-*/

	/*-----------------------*/
	/* C O N S T R U C T O R */
	/*-----------------------*/

	/**#@+
	* @return void
	*/
	function __construct() {
	} // end constructor


	/*-------------------*/
	/* F U N C T I O N S */
	/*-------------------*/

	/**
	* Set $startdate variable
	*
	* @param string $isocode
	* @see getStartDate()
	* @see $startdate
	* @uses isValidLanguageCode()
	* @uses iCalBase::$lang
	*/
	protected function setLanguage($isocode = '') {
		$this->lang = (string) (($this->isValidLanguageCode($isocode) == TRUE) ? ';LANGUAGE=' . $isocode : '');
	} // end function

	/**
	* Set $description variable
	*
	* @param string $description
	* @see getDescription()
	* @uses iCalBase::$description
	*/
	protected function setDescription($description) {
		$this->description = (string) $description;
	} // end function

	/**
	* Set $organizer variable
	*
	* @param (array) $organizer
	* @see getOrganizerName()
	* @see getOrganizerMail()
	* @uses iCalBase::$organizer
	*/
	protected function setOrganizer($organizer = '') {
		if (is_array($organizer)) {
			$this->organizer = (array) $organizer;
		} // end if
	} // end function

	/**
	* Set $url variable
	*
	* @param string $url
	* @see getURL()
	* @uses iCalBase::$url
	* @since 1.011 - 2002-12-22
	*/
	protected function setURL($url = '') {
		$this->url = (string) $url;
	} // end function

	/**
	* Set $summary variable
	*
	* @param string $summary
	* @see getSummary()
	* @uses iCalBase::$summary
	*/
	protected function setSummary($summary = '') {
		$this->summary = '';
		if (trim(strlen($summary)) > 0) { $this->summary = (string) $summary; }	
	} // end function

	/**
	* Set $sequence variable
	*
	* @param int $int
	* @see getSequence()
	* @uses iCalBase::$sequence
	*/
	protected function setSequence($int = 0) {
		$this->sequence = (int) $int;
	} // end function

	/**
	* Sets a string with weekdays of the recurring module
	*
	* @param (array) $recdays integers
	* @see getDays()
	* @uses iCalBase::$rec_days
	* @since 1.010 - 2002-10-26
	*/
	protected function setDays($recdays = '') {
		$this->rec_days = (string) '';
		if (!is_array($recdays) || count($recdays) == 0) {
			$this->rec_days = (string) $this->short_daynames[1];
		} else {
			if (count($recdays) > 1) {
				$recdays = array_values(array_unique($recdays));
			} // end if
			foreach ($recdays as $day) {
				if (array_key_exists($day, $this->short_daynames)) {
					$this->rec_days .= (string) $this->short_daynames[$day] . ',';
				} // end if
			} // end foreach
			$this->rec_days = (string) substr($this->rec_days,0,strlen($this->rec_days)-1);
		} // end if
	} // end function

	/**
	* Sets the starting day for the week (0 = Sunday)
	*
	* @param int $weekstart  0–6
	* @see getWeekStart()
	* @uses iCalBase::$week_start
	* @since 1.010 - 2002-10-26
	*/
	protected function setWeekStart($weekstart = 1) {
		if (is_int($weekstart) && preg_match('(^([0-6]{1})$)', $weekstart)) {
			$this->week_start = (int) $weekstart;
		} // end if
	} // end function

	/**
	* Set $attendees variable
	*
	* @param (array) $attendees
	* @see getAttendees()
	* @uses iCalBase::$attendees
	* @since 1.001 - 2002-10-10
	*/
	protected function setAttendees($attendees = '') {
		if (is_array($attendees)) {
			$this->attendees = (array) $attendees;
		} // end if
	} // end function

	/**
	* Set $location variable
	*
	* @param string $location
	* @see getLocation()
	* @uses iCalBase::$location
	*/
	protected function setLocation($location = '') {
		if (strlen(trim($location)) > 0) {
			$this->location = (string) $location;
		} // end if
	} // end function

	/**
	* Set $categories_array variable
	*
	* @param string $categories
	* @see getCategoriesArray()
	* @uses iCalBase::$categories_array
	*/
	protected function setCategoriesArray($categories = '') {
		$this->categories_array = (array) $categories;
	} // end function

	/**
	* Set $categories variable
	*
	* @param string $categories
	* @see getCategories()
	* @uses iCalBase::$categories
	*/
	protected function setCategories($categories = '') {
		$this->setCategoriesArray($categories);
		$this->categories = (string) implode(',',$categories);
	} // end function

	/**
	* Sets the frequency of a recurring event
	*
	* @param int $int Integer 0–7
	* @see getFrequency()
	* @uses iCalBase::$frequencies
	* @since 1.010 - 2002-10-26
	*/
	protected function setFrequency($int = 0) {
		$this->frequency = (int) $int;
	} // end function

	/**
	* Set $status variable
	*
	* @param int $status
	* @see getStatus()
	* @uses iCalBase::$status
	* @since 1.011 - 2002-12-22
	*/
	protected function setStatus($status = 1) {
		$this->status = (int) $status;
	} // end function

	/**
	* Sets the interval for a recurring event (2 = every 2 [days|weeks|years|…])
	*
	* @param int $interval
	* @see getInterval()
	* @uses iCalBase::$interval
	* @since 1.010 - 2002-10-26
	*/
	protected function setInterval($interval = 1) {
			$this->interval = (int) $interval;
	} // end function

	/**
	* returns a ical formated date depending on the locale constant at the beginning of the file
	*
	* @param int $timestamp
	* @uses USE_LOCALE_TIME
	* @since 2.001 - 2003-98-04
	*/
	protected function formatDate($timestamp = 0) {
		return (string) ((self::USE_LOCALE_TIME === TRUE) ? date('Ymd\THi00',$timestamp) : gmdate('Ymd\THi00\Z',$timestamp));
	} // end function

	/**
	* Sets an array of formated exeptions dates based on an array with timestamps
	*
	* @param (array) $exeptdates
	* @see getExeptDates()
	* @uses iCalBase::$exept_dates
	* @since 1.010 - 2002-10-26
	*/
	protected function setExeptDates($exeptdates = '') {
		if (!is_array($exeptdates)) {
			$this->exept_dates = (array) array();
		} else {
			foreach ($exeptdates as $timestamp) {
				$this->exept_dates[] = $this->formatDate($timestamp);
			} // end foreach
		} // end if
	} // end function

	/**
	* Set $class variable
	*
	* @param int $int
	* @see getClass()
	* @uses iCalBase::$class
	*/
	protected function setClass($int = 0) {
		$this->class = (int) $int;
	} // end function

	/**
	* Set $priority variable
	*
	* @param int $int
	* @see getPriority()
	* @uses iCalBase::$priority
	*/
	protected function setPriority($int = 5) {
		$this->priority = (int) ((is_int($int) && preg_match('(^([0-9]{1})$)', $int)) ? $int : 5);
	} // end function

	/**
	* Set $last_mod_ts variable
	*
	* @param int $timestamp
	* @see getLastModTS()
	* @uses iCalBase::$last_mod_ts
	* @since 1.020 - 2002-12-24
	*/
	protected function setLastModTS($timestamp = 0) {
		if (is_int($timestamp) && $timestamp > 0) {
			$this->last_mod_ts = (int) $timestamp;
		} // end if
	} // end function

	/**
	* Set $last_mod variable
	*
	* @param int $last_mod
	* @see getLastMod()
	* @uses setLastModTS()
	* @uses iCalBase::$last_mod
	* @since 1.020 - 2002-12-24
	*/
	protected function setLastMod($timestamp = 0) {
		$this->setLastModTS($timestamp);
		$this->last_mod = (string) $this->formatDate($this->last_mod_ts);
	} // end function
	/**#@-*/

	/**
	* Checks if a given string is a valid iso-language-code
	*
	* @param string $code  String that should validated
	* @return boolean isvalid  If string is valid or not
	* @since 1.001 - 2002/10/19
	*/
	public static final function isValidLanguageCode($code = '') {
		return (boolean) ((preg_match('(^([a-zA-Z]{2})((_|-)[a-zA-Z]{2})?$)',trim($code)) > 0) ? TRUE : FALSE);
	} // end function

	/**
	* Get $startdate variable
	*
	* @return string $lang
	* @see setLanguage()
	*/
	public function getLanguage() {
		return $this->lang;
	} // end function

	/**
	* Get $description variable
	*
	* @return string $description
	* @see setDescription()
	*/
	public function getDescription() {
		return $this->description;
	} // end function

	/**
	* Get name from $organizer variable
	*
	* @return string $organizer
	* @see setOrganizer()
	* @see getOrganizerMail()
	* @since 1.011 - 2002-12-22
	*/
	public function getOrganizerName() {
		return $this->organizer[0];
	} // end function

	/**
	* Get e-mail from $organizer variable
	*
	* @return string $organizer
	* @see setOrganizer()
	* @see getOrganizerName()
	* @since 1.011 - 2002-12-22
	*/
	public function getOrganizerMail() {
		return $this->organizer[1];
	} // end function

	/**
	* Get $url variable
	*
	* @return string $url
	* @see setURL()
	* @since 1.011 - 2002-12-22
	*/
	public function getURL() {
		return $this->url;
	} // end function

	/**
	* Get $summary variable
	*
	* @return string $summary
	* @see setSummary()
	*/
	public function getSummary() {
		return $this->summary;
	} // end function

	/**
	* Get $sequence variable
	*
	* @return int $sequence
	* @see setSequence()
	*/
	public function getSequence() {
		return $this->sequence;
	} // end function

	/**
	* Returns a string with recurring days
	*
	* @return string $rec_days
	* @see setDays()
	* @since 1.010 - 2002-10-26
	*/
	public function getDays() {
		return $this->rec_days;
	} // end function

	/**
	* Get the string from the $week_start variable
	*
	* @return string $short_daynames
	* @see setWeekStart()
	* @uses iCalBase::$week_start
	* @since 1.010 - 2002-10-26
	*/
	public function getWeekStart() {
		return ((array_key_exists($this->week_start, $this->short_daynames)) ? $this->short_daynames[$this->week_start] : $this->short_daynames[1]);
	} // end function

	/**
	* Get $attendees variable
	*
	* @return array $attendees
	* @see setAttendees()
	* @since 1.001 - 2002-10-10
	*/
	public function getAttendees() {
		return $this->attendees;
	} // end function

	/**
	* Get $location variable
	*
	* @return string $location
	* @see setLocation()
	*/
	public function getLocation() {
		return $this->location;
	} // end function

	/**
	* Get $categories_array variable
	*
	* @return array $categories_array
	* @see setCategoriesArray()
	*/
	public function getCategoriesArray() {
		return $this->categories_array;
	} // end function

	/**
	* Get $categories variable
	*
	* @return string $categories
	* @see setCategories()
	*/
	public function getCategories() {
		return $this->categories;
	} // end function

	/**
	* Get $frequency variable
	*
	* @return string $frequencies
	* @see setFrequency()
	* @since 1.010 - 2002-10-26
	*/
	public function getFrequency() {
		return $this->frequency;
	} // end function

	/**
	* Get $status variable
	*
	* @return string $status
	* @see setStatus()
	* @since 1.011 - 2002-12-22
	*/
	public function getStatus() {
		return $this->status;
	} // end function

	/**
	* Get $interval variable
	*
	* @return int $interval
	* @see setInterval()
	* @since 1.010 - 2002-10-26
	*/
	public function getInterval() {
		return $this->interval;
	} // end function

	/**
	* Returns a string with exeptiondates
	*
	* @return string
	* @see setExeptDates()
	* @since 1.010 - 2002-10-26
	*/
	public function getExeptDates() {
		$return = (string) '';
		foreach ($this->exept_dates as $date) {
			$return .= (string) $date . ',';
		} // end foreach
		$return = (string) substr($return,0,strlen($return)-1);
		return (string) $return;
	} // end function

	/**
	* Get $class variable
	*
	* @return string $class
	* @see setClass()
	*/
	public function getClass() {
		return $this->class;
	} // end function

	/**
	* Get $priority variable
	*
	* @return string $priority
	* @see setPriority()
	*/
	public function getPriority() {
		return $this->priority;
	} // end function

	/**
	* Get $last_mod_ts variable
	*
	* @return int $last_mod_ts
	* @see setLastModTS()
	* @since 1.020 - 2002-12-24
	*/
	public function getLastModTS() {
		return $this->last_mod_ts;
	} // end function

	/**
	* Get $last_mod variable
	*
	* @return int $last_mod
	* @see setLastMod()
	* @since 1.020 - 2002-12-24
	*/
	public function getLastMod() {
		return $this->last_mod;
	} // end function
} // end class iCalBase
?>