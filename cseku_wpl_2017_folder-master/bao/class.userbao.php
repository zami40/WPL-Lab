<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.userdao.php';


/*
	User Business Object 
*/
Class UserBAO{

	private $_DB;
	private $_UserDAO;

	function UserBAO(){

		$this->_UserDAO = new UserDAO();

	}

	//get all users value
	public function getAllUsers(){

		$Result = new Result();	
		$Result = $this->_UserDAO->getAllUsers();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.getAllUsers()");		

		return $Result;
	}

	//create user funtion with the user object
	public function createUser($User){

		$Result = new Result();	
		$Result = $this->_UserDAO->createUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.createUser()");		

		return $Result;

	
	}

	//read an user object based on its id form user object
	public function readUser($User){


		$Result = new Result();	
		$Result = $this->_UserDAO->readUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.readUser()");		

		return $Result;


	}

	//read an user with role information object based on its id form user object
	public function readUserRolesPositions($User){


		$Result = new Result();	
		$Result = $this->_UserDAO->readUserRolesPositions($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.readUserRolesPositions()");		

		return $Result;


	}

	//read an user with role and permission information object based on the user email address
	public function readUserRolesPermissions($User){


		$Result = new Result();	
		$Result = $this->_UserDAO->readUserRolesPermissions($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.readUserRolesPermissions()");		

		return $Result;


	}



	//update an user object based on its current information
	public function updateUser($User){

		$Result = new Result();	
		$Result = $this->_UserDAO->updateUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.updateUser()");		

		return $Result;
	}

	//delete an existing user
	public function deleteUser($User){

		$Result = new Result();	
		$Result = $this->_UserDAO->deleteUser($User);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in UserDAO.deleteUser()");		

		return $Result;

	}

}

echo '<br> log:: exit the class.userbao.php';

?>