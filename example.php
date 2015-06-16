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
	//var_dump($ticketData);
	/*
	user stuff
	*/
	$users = new Users($key,$url);
	$userAccounts = $users->ListAllUsers();
	echo 'Accounts';
	//var_dump($userAccounts);
	echo 'Agents';
	$userAgents = $users->ListAllAgents();
	//var_dump($userAgents);
	echo 'Found By Email:';
	$userByEmail = $users->GetUserByEmail('cwsterling@georgiasouthern.edu');
	//var_dump($userByEmail);

}
catch(Exception $ex){
	var_dump($ex);
}
