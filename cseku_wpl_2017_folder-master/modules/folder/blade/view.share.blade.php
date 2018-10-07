<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.filebao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';
include_once '/../../../bao/class.file_assignbao.php';


session_start();

//$fileVarible = $_SESSION['fileVarible'];
$globalUser = $_SESSION['globalUser'];
$File = $_SESSION['globalFileIDSend'];


$_FileBAO = new FileBAO();
$_DB = DBUtil::getInstance();
$_File_assignBAO = new File_assignBAO();

$_DisciplineBAO = new DisciplineBAO();
$_UserBAO = new UserBAO();

//$array = array("userId1", "userId2", "userId3");
//$discipline = array("CSE","ECE","MATH");

/* saving a new File Assign account*/
if(isset($_POST['save']))
{
	 


	$FileAssign = new File_assign();
//
	$FileAssign->setID(Util::getGUID());
	$FileAssign->setFile($File->getFile());
	$FileAssign->setFileComment($_DB->secureInput($_POST['Comment']));
	
	$FileAssign->setIsPending(1);
	$FileAssign->setHasSeen(0);
	$FileAssign->setIsRejected(0);
	$FileAssign->setIsApproved(0);
	$FileAssign->setPreviousUser($File->getCurrentUser());
	$FileAssign->setCurrentUser(($_DB->secureInput($_POST['users'])));
	$FileAssign->setAssignDate(date("y/m/d"));




     
     
     
	 
	 $_File_assignBAO->createFile_assign($FileAssign);
//

     
    
	

	 header("Location: view.status.php");
	 //echo <br>"save";
	 //print_r(school);		 
}










echo '<br> log:: exit blade.share.php';

?>