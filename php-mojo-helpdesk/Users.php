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
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	public function ListAllAgents($perPage=25,$offset=0){
		$url = $this->MojoAPI->GetSiteURL().'/api/users/techs.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	public function ShowUser($userID){
		if(!is_numeric($emailAddress)){
			throw new Exception("You must pass a User ID to this use method.");
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/users/'.$userID.'.json?access_key='.$this->MojoAPI->GetAPIKey();
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	public function GetUserByEmail($emailAddress){
		if(!is_string($emailAddress)){
			throw new Exception("You must pass an email address to this use method.");
		}
		$url = $this->MojoAPI->GetSiteURL().'/api/users/get_by_email.json?email='.$emailAddress.'&access_key='.$this->MojoAPI->GetAPIKey();
		$agents = $this->MojoAPI->MakeGetCall($url);

		$decodedResponse = json_decode($agents);

		if(json_last_error()){
		    throw new Exception($this->MojoAPI->decodeError(json_last_error()));
	    }else{
		    return $decodedResponse;
	    }
	}

	public function CreateUser($userData, $sendWelcomeEmail = false, $override=false){
		if(!is_array($userData)){
			throw new Exception("You must pass an array to this use method.");
			
		}
		$userFields = $this->GetAllowedUserFields();
		$newUser = '<user>';
		foreach($userData as $key=>$value){
			if(!isset($userFields[$key])){
				if(!$override){
					throw new Exception("You have included fields that aren't allowed when creating a user account. See the allowed fields by calling GetAllowedUserFields()");
				}else{
					unset($userData[$key]);
				}
			}
			unset($userFields[$key]);
			$newUser .= '<'.$key.'>'.$value.'</'.$key.'>';
		}
		$newUser .= '</user>';
		if(count($userFields) > 0 && !$override){
			throw new Exception('You have not included required fields. Pass \'true\' as the 3rd parameter (second parameter is false by default) if you want to force the addition. If you have no data for the field, just include it but leave it empty. If you want to generate a password, call GeneratePassword($length=10) and it will generate a password for you. Only recommend if you are going to SSO in and don\'t care about passwords. See the allowed/required fields by calling GetAllowedUserFields(). Missing Field(s) are: '.implode($userFields,','));
		}
		$emailUser = '&send_welcome_email=';
		if($sendWelcomeEmail){
			$emailUser .= '1';
		}else{
			$emailUser .= '0';
		}
		echo $emailUser;
		$url = $this->MojoAPI->GetSiteURL().'/api/users?access_key='.$this->MojoAPI->GetAPIKey(); //.$emailUser;
		$addUserCall = $this->MojoAPI->MakePostCall($url, $newUser);
		$resultData = trim(substr($addUserCall,(strpos($addUserCall,'>')+1)));
		$p = xml_parser_create();
		xml_parse_into_struct($p, $resultData, $vals, $index);
		xml_parser_free($p);
		
		if($vals[0]['tag'] == 'ERRORS'){
			throw new Exception($vals[1]['value']);
		}

		$returnData = array();
		foreach($vals as $data){
			if(isset($data['value'])){
				$returnData[$data['tag']] = trim($data['value']);	
			}
		}


		return $returnData;

	}

	public function UpdateUser($userData){

	}

	public function DeleteUser($userData){

	}

	public function GetAllowedUserFields(){
		$userFields = array();
		$userFields['email'] = 'email';
		$userFields['first_name'] = 'first_name';
		$userFields['middle_name'] = 'middle_name';
		$userFields['last_name'] = 'last_name';
		$userFields['work_phone'] = 'work_phone';
		$userFields['cell_phone'] = 'cell_phone';
		$userFields['home_phone'] = 'home_phone';
		$userFields['user_notes'] = 'user_notes';
		$userFields['company_id'] = 'company_id';
		$userFields['password'] = 'password';
		return $userFields;		
	}
	//you should ONLY use this function if you plan on doing SSO
	//I can't be held responsible if the password generated is a weak password
	public function GeneratePassword($length=10){
		if(function_exists('password_hash')){
			$password = password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";	
		}else{
			$password = '.'.sha1(time()).sha1(time()).sha1(time());
		}
		
		return substr($password,strpos($password,'.')+1,$length);
	}

}