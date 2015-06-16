<?php
/**
 * PHP Mojo Helpdesk Library
 * =====================
 *
 *
 * PHP Mojo Helpdesk is a PHP class designed to faciliate Mojo Helpdesk API
 *
 * @author      Current authors: Chris Sterling <chris@chrissterling.me>
 *
 *              Original author: Chris Sterling <chris@chrissterling.me>
 *
 * @license     Code and contributions have 'MIT License'
 *              More details: https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 *
 *
 * @version     0.0.1
 */

class MojoAPI
{
	//Your API Key
	private $apiKey; //found under your profile
	//Your Site URL
	private $siteURL; //yourdomain.mojohelpdesk.com
	//number custom fields
	private $numCustomFields;
	//error infio
	private $MojoAPIError;

	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->apiKey = $apiKey;
		$this->siteURL = $siteURL;
		$this->numCustomFields = $numCustomFields;
	}

	public function GetError(){
		return $this->MojoAPIError;
	}

	public function SetError($error){
		$this->MojoAPIError = $error;
	}

	public function GetSiteURL(){
		return $this->siteURL;
	}

	public function GetAPIKey(){
		return $this->apiKey;
	}

	public function decodeError($errorMessage){
		switch ($errorMessage) {
        	case JSON_ERROR_NONE:
            	return 'No errors';
        	break;
        	case JSON_ERROR_DEPTH:
            	return 'Maximum stack depth exceeded';
        	break;
        	case JSON_ERROR_STATE_MISMATCH:
            	return 'Underflow or the modes mismatch';
        	break;
        	case JSON_ERROR_CTRL_CHAR:
            	return 'Unexpected control character found';
        	break;
        	case JSON_ERROR_SYNTAX:
            	return 'Syntax error, malformed JSON';
        	break;
        	case JSON_ERROR_UTF8:
            	return 'Malformed UTF-8 characters, possibly incorrectly encoded';
        	break;
        	default:
            	return 'Unknown error';
        	break;
    	}
	}

	public function MakeGetCall($url,$timeout=30){
		echo $url.'<br />';
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $output = curl_exec($ch);
        curl_close($ch);
        if(substr($output, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
        	$output=substr($output, 3);
    	}
		return $output;

	}

	public function MakePostCall(){
		
	}

	public function MakePutCall(){

	}

	public function MakeDeleteCall(){

	}


}