<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.filebao.php';
include_once '/../../../bao/class.sharebao.php';
include_once '/../../../bao/class.File_assignbao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';



session_start();



//$fileVarible = $_SESSION['fileVarible'];
$globalUser = $_SESSION['globalUser'];
//$globalFileID = $_SESSION['globalFileID'];

$_FileBAO = new FileBAO();
$_DB = DBUtil::getInstance();
$_File_assignBAO = new File_assignBAO();

$_DisciplineBAO = new DisciplineBAO();
$_UserBAO = new UserBAO();

if(isset($_GET['edit']))
{
	$File = new File();	
	$File->setID($_GET['edit']);	
	$getROW = $_FileBAO->readFile($File)->getResultObject(); //reading the File object from the result object
}

if(isset($_GET['history']))
{
	$_SESSION['globalFileID'] = $_GET['history'];
	header("Location: view.log.php");

	//reading the File object from the result object
}

if(isset($_GET['send']))
{
	$File = new File_assign();	
	$File->setID($_GET['send']);	
	$getROW = $_File_assignBAO->readFile_assign($File)->getResultObject(); 

	$_SESSION['globalFileIDSend'] = $getROW;
	header("Location: view.share.php");

	//reading the File object from the result object
}

if(isset($_GET['accept']))
{
	$FileAssign = new File_assign();
	
	$FileAssign->setID($_GET['accept']);
	
	$Result = $_File_assignBAO->readFile_assign($FileAssign);
	if($Result->getIsSuccess()){

		$FileList = $Result->getResultObject();
		$FileAssign = $FileList;

	}


	$FileAssign->setIsPending(0);
	$FileAssign->setHasSeen(1);
	$FileAssign->setIsRejected(0);
	$FileAssign->setIsApproved(1);
	$FileAssign->setApproveDate(date("y/m/d"));


	$_File_assignBAO->updateFile_assign($FileAssign);

	header("Location: view.notification.php");
	
}

if(isset($_GET['reject']))
{
	$FileAssign = new File_assign();
	
	$FileAssign->setID($_GET['reject']);
	
	$Result = $_File_assignBAO->readFile_assign($FileAssign);
	if($Result->getIsSuccess()){

		$FileList = $Result->getResultObject();
		$FileAssign = $FileList;

	}


	$FileAssign->setIsPending(0);
	$FileAssign->setHasSeen(1);
	$FileAssign->setIsRejected(1);
	$FileAssign->setIsApproved(0);
	$FileAssign->setApproveDate(date("y/m/d"));


	$_File_assignBAO->updateFile_assign($FileAssign);

	header("Location: view.notification.php");
	
}




?>