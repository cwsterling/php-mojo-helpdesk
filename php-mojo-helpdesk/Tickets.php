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
 *
 * @version     0.0.1
 */

class Tickets extends MojoAPI
{
	//The MojoAPI
	private $MojoAPI;
	//completed
	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->MojoAPI = new MojoAPI($apiKey,$siteURL,$numCustomFields);
	}

	//by default, this will return 25 tickets per page
	//completed
	public function ListAllTickets($perPage=25,$offset=0, $reverse=true){
		$reverseFunction = '&r=';
		if($reverse){
			$reverseFunction .= '1';
		}else{
			$reverseFunction .= '0';
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset.$reverseFunction;
		$tickets = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}
	//completed
	public function ListTicketsByStatus($ticketStatus, $sortField="created_on", $perPage=25,$offset=0,$reverse=true){
		if(!is_array($ticketStatus)){
			throw new Exception("Array must be passed. For valid list of ticket options, call GetTicketStatusOptions()");
		}
		$reverseFunction = '&r=';
		if($reverse){
			$reverseFunction .= '1';
		}else{
			$reverseFunction .= '0';
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets/search.json?query=status.id:('.urlencode(implode(' OR ', $ticketStatus)).')&access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset.'&sf='.$sortField.'&r=1';
		echo $url;
		$tickets = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}
	//completed
	public function SearchForTickets($ticketStatus, $sortField="created_on", $perPage=25,$offset=0,$reverse=true){
		if(!is_array($ticketStatus)){
			throw new Exception("Array must be passed. For valid list of ticket options, call GetSearchFields()");
		}
		$reverseFunction = '&r=';
		if($reverse){
			$reverseFunction .= '1';
		}else{
			$reverseFunction .= '0';
		}
		$searchString = '';
		foreach($ticketStatus as $key=>$value){
			$searchString .= $key.':('.$value.') AND ';
		}

		$searchString = urlencode(substr($searchString,0,-5));
		echo $searchString.'<br />';
		
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets/search.json?query='.$searchString.'&access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset.'&sf='.$sortField.'&r=1';
		echo $url.'<br />';
		$tickets = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	//completed
	public function GetTicketByID($ticketID){
		if(!is_numeric($ticketID)){
			throw new Exception('Passed Ticket ID is not numberic.');
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets/'.$ticketID.'.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$tickets = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}
	//completed
	public function GetTicketComments($ticketID){
		if(!is_numeric($ticketID)){
			throw new Exception('Passed Ticket ID is not numberic.');
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/tickets/'.$ticketID.'/comments.json?access_key='.$this->MojoAPI->GetAPIKey();
		$comments = $this->MojoAPI->MakeGetCall($url);
		$decodedResponse = json_decode($comments);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }

	}
	//completed
	public function GetTicketQueues($perPage=25,$offset=0, $reverse=true){
		$reverseFunction = '&r=';
		if($reverse){
			$reverseFunction .= '1';
		}else{
			$reverseFunction .= '0';
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/ticket_queues.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$comments = $this->MojoAPI->MakeGetCall($url);
		$decodedResponse = json_decode($comments);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }

	}

	//completed
	public function GetAllTicketsInQueue($queueID){
		if(!is_numeric($queueID)){
			throw new Exception('Passed Queue ID is not numberic.');
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/ticket_queues/'.$queueID.'.json?access_key='.$this->MojoAPI->GetAPIKey();
		$comments = $this->MojoAPI->MakeGetCall($url);
		$decodedResponse = json_decode($comments);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	public function GetTicketsInQueueByStatus($queueID, $status){
		if(!is_numeric($queueID)){
			throw new Exception('Passed Queue ID is not numberic.');
		}
		if(!is_array($status)){
			throw new Exception('Passed Status must be an array. For a list of valid ticket statuses, call GetTicketStatusOptions().');	
		}

	}

	//completed
	public function GetTicketStatusOptions(){
		$ticketStatus = array();
		$ticketStatus[10] = 'new';
		$ticketStatus[20] = 'in progress';
		$ticketStatus[30] = 'on hold';
		$ticketStatus[40] = 'information requested';
		$ticketStatus[50] = 'solved';
		$ticketStatus[60] = 'closed';
		return $ticketStatus;
	}

	//completed
	public function GetSearchFields(){
		$searchFields = array();
		$searchFields[] = 'assignee.id';
		$searchFields[] = 'assignee.name';
		$searchFields[] = 'assignee.email';
		$searchFields[] = 'comments.id';
		$searchFields[] = 'comments.body';
		$searchFields[] = 'comments.created_on';
		$searchFields[] = 'comments.time_spent';
		$searchFields[] = 'comments.user.id';
		$searchFields[] = 'comments.user.name';
		$searchFields[] = 'comments.user.email';
		$searchFields[] = 'company.id';
		$searchFields[] = 'company.name';
		$searchFields[] = 'created_by.id';
		$searchFields[] = 'created_by.name';
		$searchFields[] = 'created_by.email';
		$searchFields[] = 'created_on';
		$searchFields[] = 'custom_fields';
		$searchFields[] = 'description';
		$searchFields[] = 'due_on';
		$searchFields[] = 'priority.id';
		$searchFields[] = 'priority.name';
		$searchFields[] = 'queue.id';
		$searchFields[] = 'queue.name';
		$searchFields[] = 'rating';
		$searchFields[] = 'rated_on';
		$searchFields[] = 'scheduled_on';
		$searchFields[] = 'solved_on';
		$searchFields[] = 'status.id';
		$searchFields[] = 'status.name';
		$searchFields[] = 'status_changed_on';
		$searchFields[] = 'type.id';
		$searchFields[] = 'type.name';
		$searchFields[] = 'title';
		$searchFields[] = 'updated_on';
		return $searchFields;
	}

	public function FormatTicketTime($time){
		return date("Y-m-d\TH:i:s\Z",strtotime($time));
	}

}