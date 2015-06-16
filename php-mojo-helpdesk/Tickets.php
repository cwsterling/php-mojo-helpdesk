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

class Tickets extends MojoAPI
{
	//The MojoAPI
	private $MojoAPI;

	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->MojoAPI = new MojoAPI($apiKey,$siteURL,$numCustomFields);
	}

	//by default, this will return 25 tickets per page
	public function ListAllTickets($perPage=25,$offset=0){
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$tickets = $this->MojoAPI->MakeGetCall($url);


		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	public function GetTicketStatusOptions(){
		$ticketStatus = array();
		$ticketStatus['StatusID'][10] = 'new';
		$ticketStatus['StatusID'][20] = 'in progress';
		$ticketStatus['StatusID'][30] = 'on hold';
		$ticketStatus['StatusID'][40] = 'information requested';
		$ticketStatus['StatusID'][50] = 'solved';
		$ticketStatus['StatusID'][60] = 'closed';
		
	}

	public function ListTicketsByStatus($ticketStatus){
		if(!is_array($ticketStatus)){
			$this->MojoAPI->SetError("Array must be passed. For valid list of ticket options, call GetTicketStatusOptions()");
		}

	}

	public function GetTicketByID($ticketID){

	}

	public function GetTicketComments($ticketID){

	}

	public function GetTicketQueues($perPage=25,$offset=0){

	}

	public function GetAllTicketsInQueue($queueID){

	}

	public function GetTicketsInQueueByStatus($queueID){

	}

}