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
	
	//Create the MojoAPI Class
	public function __construct($apiKey,$siteURL,$numCustomFields=0){
		$this->MojoAPI = new MojoAPI($apiKey,$siteURL,$numCustomFields);
	}

	//List all the companys
	public function ListAllCompanies($perPage=25,$offset=0){
		$url = $this->MojoAPI->GetSiteURL().'/api/companies.json?access_key='.$this->MojoAPI->GetAPIKey().'&per_page='.$perPage.'&page='.$offset;
		$tickets = $this->MojoAPI->MakeGetCall($url);


		$decodedResponse = json_decode($tickets);

		if(json_last_error()){
		    $this->MojoAPI->SetError($this->MojoAPI->decodeError(json_last_error()));
		    return false;
	    }else{
		    return $decodedResponse;
	    }
	}

	//get company info by name
	public function GetCompanyInfoByName($companyName){
		$companies = $this->ListAllCompanies();
		if(!is_array($companies)){
			$this->MojoAPI->SetError("Companies returned wasn't an array.");
			return false;
		}
		foreach($companies as $companyInfo){
			if($companyInfo->company->name == $companyName){
				return $companyInfo->company;
			}
		}
	}

	//Add a new company
	public function CreateCompany($companyData){

	}

	//Update Company Data
	public function UpdateCompnay($companyData){

	}

	//Delete A Company
	public function DeleteCompnay($companyData){

	}

}

