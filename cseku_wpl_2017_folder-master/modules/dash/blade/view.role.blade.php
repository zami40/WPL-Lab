<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.rolebao.php';


$_RoleBAO = new RoleBAO();
$_DB = DBUtil::getInstance();

/* saving a new Role account*/
if(isset($_POST['save']))
{
	 $Role = new Role();	
	 $Role->setID(Util::getGUID());
     $Role->setName($_DB->secureInput($_POST['txtName']));
	 $_RoleBAO->createRole($Role);		 
}


/* deleting an existing Role */
if(isset($_GET['del']))
{

	$Role = new Role();	
	$Role->setID($_GET['del']);	
	$_RoleBAO->deleteRole($Role); //reading the Role object from the result object

	header("Location: view.role.php");
}


/* reading an existing Role information */
if(isset($_GET['edit']))
{
	$Role = new Role();	
	$Role->setID($_GET['edit']);	
	$getROW = $_RoleBAO->readRole($Role)->getResultObject(); //reading the Role object from the result object
}

/*updating an existing Role information*/
if(isset($_POST['update']))
{
	$Role = new Role();	

    $Role->setID ($_GET['edit']);
    $Role->setName( $_POST['txtName'] );
	
	$_RoleBAO->updateRole($Role);

	header("Location: view.role.php");
}



echo '<br> log:: exit blade.Role.php';

?>