<?php

require_once('externals/htmlMimeMail5/htmlMimeMail5.php');

class mail extends Includes{
	
	public $mail;
	
	public function __construct($core, $name){
		parent::__construct($core, $name);
		
		$this->mail = new htmlMimeMail5;
		$this->core->subLog('Load Class: HtmlMimeMail');
		
	}
	
	/**
	 * Gibt TRUE zur�ck wenn die �bergebene eMail eine g�ltige Emailadresse ist
	 *
	 * @param string $email
	 * @return Bool
	 *
	 */
	public function isMail($email){
		
	  $regex = $this->isMailMuster();

	  return preg_match("/^$regex$/",$email);
	}
	/**
	* Diese Funktion liefert das Muster f�r den Regul�ren Ausdruck einer 
	* Email-Adresse zur�ck
	* @return String 
	*/
	public function isMailMuster(){
		
		// RegEx begin
		  $nonascii      = "\x80-\xff"; # Non-ASCII-Chars are not allowed

		  $nqtext        = "[^\\\\$nonascii\015\012\"]";
		  $qchar         = "\\\\[^$nonascii]";

		  $protocol      = '(?:mailto:)';

		  $normuser      = '[a-zA-Z0-9][a-zA-Z0-9_.-]*';
		  $quotedstring  = "\"(?:$nqtext|$qchar)+\"";
		  $user_part     = "(?:$normuser|$quotedstring)";

		  $dom_mainpart  = '[a-zA-Z0-9][a-zA-Z0-9._-]*\\.';
		  $dom_subpart   = '(?:[a-zA-Z0-9][a-zA-Z0-9._-]*\\.)*';
		  $dom_tldpart   = '[a-zA-Z]{2,5}';
		  $domain_part   = "$dom_subpart$dom_mainpart$dom_tldpart";

		  $regex         = "$protocol?$user_part\@$domain_part";
		  // RegEx end
	
		return $regex;
	}
}