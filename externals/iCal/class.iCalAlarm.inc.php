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
* We need the base class
*/
include_once 'class.iCalBase.inc.php';

/**
* Container for an alarm (used in event and todo)
*
* Tested with WAMP (XP-SP2/2.2/5.2/5.1.0)
* Last Change: 2008-04-07
*
* @access public
* @author Michael Wimmer <flaimo@gmail.com>
* @copyright Copyright © 2002-2008, Michael Wimmer
* @license GNU General Public License v3
* @link http://code.google.com/p/flaimo-php/
* @package iCalendar
* @version 2.002
*/
class iCalAlarm extends iCalBase {

	/*-------------------*/
	/* V A R I A B L E S */
	/*-------------------*/

	/**#@+
	* @var int
	*/
	/**
	* Kind of alarm (0 = DISPLAY, 1 = EMAIL, (not supported: 2 = AUDIO, 3 = PROCEDURE))
	*/
	private $action;

	/**
	* Minutes the alarm goes off before the event/todo
	*/
	private $trigger = 0;

	/**
	* Duration between the alarms in minutes
	*/
	private $duration;

	/**
	* How often should the alarm be repeated
	*/
	private $repeat;
	/**#@-*/

	/*-----------------------*/
	/* C O N S T R U C T O R */
	/*-----------------------*/

	/**#@+
	* @return void
	*/
	/**
	* Constructor
	*
	* Only job is to set all the variablesnames
	*
	* @param int $action  0 = DISPLAY, 1 = EMAIL, (not supported: 2 = AUDIO, 3 = PROCEDURE)
	* @param int $trigger  Minutes the alarm goes off before the event/todo
	* @param string $summary  Title for the alarm
	* @param string $description  Description
	* @param array $attendees  key = attendee name, value = e-mail, second value = role of the attendee
	* [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON] (example: array('Michi' => 'flaimo@gmx.net,1'); )
	* @param int $duration  Duration between the alarms in minutes
	* @param int $repeat  How often should the alarm be repeated
	* @param string $lang  Language of the strings used in the event (iso code)
	* @uses setAction()
	* @uses setTrigger()
	* @uses iCalBase::setSummary()
	* @uses iCalBase::setDescription()
	* @uses iCalBase::setAttendees()
	* @uses setDuration()
	* @uses setRepeat()
	* @uses iCalBase::setLanguage()
	*/
	function __construct($action, $trigger, $summary, $description, $attendees,
					   $duration, $repeat, $lang) {
		parent::__construct();
		$this->setVar('action', $action);
		$this->setVar('trigger', $trigger);
		parent::setSummary($summary);
		parent::setDescription($description);
		parent::setAttendees($attendees);
		$this->setVar('duration', $duration);
		$this->setVar('repeat', $repeat);
		parent::setLanguage($lang);
	} // end constructor

	/*-------------------*/
	/* F U N C T I O N S */
	/*-------------------*/

	/**
	* Set class variable
	*
	* @param string $var class variable
	* @param mixed $value value
	* @since 2.000 - 2003-07-07
	*/
	private function setVar($var, $value) {
		$this->$var = (int) $value;
	} // end function

	/**#@+
	* @since 1.021 - 2002-12-24
	*/
	/**
	* Get $action variable
	*
	* @return string $action
	* @see setAction()
	* @see iCalAlarm::$action
	*/
	public function getAction() {
		$action_status = (array) array('DISPLAY', 'EMAIL', 'AUDIO', 'PROCEDURE');
		return (string) ((array_key_exists($this->action, $action_status)) ? $action_status[$this->action] : $action_status[0]);
	} // end function

	/**
	* Get $trigger variable
	*
	* @return int $trigger
	*/
	public function getTrigger() {
		return (int) $this->trigger;
	} // end function

	/**
	* Get $duration variable
	*
	* @return int $duration
	*/
	public function getDuration() {
		return (int) $this->duration;
	} // end function

	/**
	* Get $repeat variable
	*
	* @return int $repeat
	*/
	public function getRepeat() {
		return (int) $this->duration;
	} // end function
} // end class iCalAlarm
?>
