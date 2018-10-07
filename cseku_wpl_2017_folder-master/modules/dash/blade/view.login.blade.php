<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.userbao.php';


$_UserBAO = new UserBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

/* loading the user account*/
if(isset($_POST['login']))
{
	$User = new User();	
    $User->setEmail($_DB->secureInput($_POST['txtEmail']));
    $User->setPassword($_DB->secureInput($_POST['txtPassword']));

	$Result = $_UserBAO->readUserRolesPermissions($User); //reading the user object from the result 

	if($Result->getIsSuccess()){

		//storing the user object with all the roles and related permissions available in the complete system
		$globalUser = $Result->getResultObject();
		
		//required to access session variables;		
		session_start();

		$_SESSION["globalUser"]=$globalUser;

		header("Location:view.home.php");		

	}
	else{
		echo '<br>Wrong user name or password';
		//header("Location:view.login.php");	
	}
	
}

echo '<br> log:: exit blade.login.php';
$_Log->log(LogUtil::$DEBUG,"exit blade.login.php");

?>