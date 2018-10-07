<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.filebao.php';
include_once '/../../../bao/class.disciplinebao.php';
include_once '/../../../bao/class.userbao.php';
include_once '/../../../bao/class.file_assignbao.php';


session_start();

$globalUser = $_SESSION['globalUser'];



$_FileBAO = new FileBAO();
$_DB = DBUtil::getInstance();
$_File_assignBAO = new File_assignBAO();

$_DisciplineBAO = new DisciplineBAO();
$_UserBAO = new UserBAO();

//$array = array("userId1", "userId2", "userId3");
//$discipline = array("CSE","ECE","MATH");

/* saving a new File account*/
if(isset($_POST['save']))
{   
	//


	$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists
if (file_exists($target_file)) {
    echo '<br>'. "Sorry, file already exists.";
    $uploadOk = 0;
}
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo '<br>'.'<strong style=" color:red; ">'."Sorry, your file was not uploaded.".'</strong>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo '<br>'.'<strong style=" color:green; ">'."The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.".'</strong>';

        //
        $File = new File();
	 $File->setID(Util::getGUID());
	 $File->setCreator($globalUser->getID());
     $File->setName($_DB->secureInput($_POST['users']));
     //.$File->setLink($_DB->secureInput($_POST['link']));
     $File->setLink($target_file);
     $File->setDiscipline($_POST['discipline']);
     $File->setCreationDate(date("y/m/d"));
     
     $FileAssign = new File_assign();

     $FileAssign->setID(Util::getGUID());
     $FileAssign->setFile($File->getID());
     $FileAssign->setFileComment($_DB->secureInput($_POST['Comment']));
     //$FileAssign->setCreationDate(date("y/m/d"));
     $FileAssign->setIsPending(1);
     $FileAssign->setHasSeen(0);
     $FileAssign->setIsRejected(0);
     $FileAssign->setIsApproved(0);
     $FileAssign->setPreviousUser($File->getCreator());
     $FileAssign->setCurrentUser($File->getName());


     
	 $_FileBAO->createFile($File);
	 $_File_assignBAO->createFile_assign($FileAssign);

        //


    } else {
        echo '<br>'.'<strong style=" color:red; ">'."Sorry, there was an error uploading your file.".'</strong>';
    }
}


















	//
	 
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