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

class Users extends MojoAPI
{
	//The MojoAPI
	private $MojoAPI;
	
	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->MojoAPI = new MojoAPI($apiKey,$siteURL,$numCustomFields);
	}

	public function ListAllUsers($perPage=25,$offset=0){
		$url = $this->MojoAPI->GetSiteURL().'/api/users.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$users = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($users);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	public function ListAllAgents($perPage=25,$offset=0){
		$url = $this->MojoAPI->GetSiteURL().'/api/users/techs.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	public function ShowUser($userID){
		$url = $this->MojoAPI->GetSiteURL().'/api/users/'.$userID.'.json?access_key='.$this->MojoAPI->GetAPIKey();
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	public function GetUserByEmail($emailAddress){
		$url = $this->MojoAPI->GetSiteURL().'/api/users/get_by_email.json?email='.$emailAddress.'&access_key='.$this->MojoAPI->GetAPIKey();
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	public function CreateUser($userData){

	}

	public function UpdateUser($userData){

	}

	public function DeleteUser($userData){

	}

}