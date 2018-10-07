<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.file_assignbao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';

session_start();

$globalUser = $_SESSION['globalUser'];
$globalFileID = $_SESSION['globalFileID'];
$_UserBAO = new UserBAO();

$_DB = DBUtil::getInstance();

$_File_assignBAO = new File_assignBAO();



/* saving a new File account*/
if(isset($_POST['save']))
{
	 $File = new File();
	 $File->setID(Util::getGUID());
	 $File->setCreator($globalUser->getID());
     $File->setName($_DB->secureInput($_POST['users']));
     $File->setLink($_DB->secureInput($_POST['link']));
     $File->setDiscipline($_POST['discipline']);
     
     
     
	 $_FileBAO->createFile($File);
	 //echo <br>"save";
	 //print_r(school);		 
}


/* deleting an existing File */
if(isset($_GET['del']))
{

	$File = new File();	
	$File->setID($_GET['del']);	
	$_FileBAO->deleteFile($File); //reading the File object from the result object

	header("Location: view.file.php");
}


/* reading an existing File information */
if(isset($_GET['edit']))
{
	$File = new File();	
	$File->setID($_GET['edit']);	
	$getROW = $_FileBAO->readFile($File)->getResultObject(); //reading the File object from the result object
}

/*updating an existing File information*/
if(isset($_POST['update']))
{
	
	$File = new File();
	
	$File->setID ($_GET['edit']);
	$File->setCreator($globalUser->getID());
	$File->setName($_DB->secureInput($_POST['users']));
	$File->setLink($_DB->secureInput($_POST['link']));
	$File->setDiscipline($_POST['discipline']);

    
	$_FileBAO->updateFile($File);

	header("Location: view.file.php");
}



echo '<br> log:: exit blade.file.php';

?>