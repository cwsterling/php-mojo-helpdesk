<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo '<pre>';
include ('autoload.php');
try{
	include('keys.php');
	
	/*
	tickets stuff 
	*/
	$tickets = new Tickets($key,$url);
	$ticketData = $tickets->ListAllTickets();
	$specificTicket = $tickets->10213090
	var_dump($ticketData);
	/*
	company stuff
	*/
	
	//$company = new Groups($key,$url);
	//$allCompanies = $company->ListAllCompanies();
	//var_dump($allCompanies);
	//$specificCompany = $company->GetCompanyInfoByName('Individuals');
	//var_dump($specificCompany);
	//$companyID = $specificCompany->id;
	/*
	user stuff
	*/
	//$users = new Users($key,$url);
	//$userAccounts = $users->ListAllUsers();
	//echo 'Accounts';
	//var_dump($userAccounts);
	//echo 'Agents';
	//$userAgents = $users->ListAllAgents();
	//var_dump($userAgents);
	//echo 'Found By Email:';
	//$userByEmail = $users->GetUserByEmail('cwsterling@georgiasouthern.edu');
	//var_dump($userByEmail);
	//echo 'create user process';
	//$newUser = array();
	//$newUser['email'] = 'cs02357@georgiasouthern.edu';
	//$newUser['first_name'] = 'Christopher';
	//$newUser['last_name'] = 'Sterling';
	//$newUser['work_phone'] = '';
	//$newUser['cell_phone'] = '';
	//$newUser['home_phone'] = '';
	//$newUser['user_notes'] = '';
	//$newUser['company_id'] = $companyID;
	//$newUser['password'] = $users->GeneratePassword();


	//$createUser = $users->CreateUser($newUser,true,true);
	//if(!$createUser){
	//	var_dump($users->GetError());
	//}else{
	//	var_dump($createUser);
	//}

}
catch(Exception $ex){
	var_dump($ex);
}
