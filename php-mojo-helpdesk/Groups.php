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

class Groups extends MojoAPI
{
	//The MojoAPI
	private $MojoAPI;
	
	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->MojoAPI = new MojoAPI($apiKey,$siteURL,$numCustomFields);
	}

}

