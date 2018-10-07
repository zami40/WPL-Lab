<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.disciplinebao.php';


$_DisciplineBAO = new DisciplineBAO();
$_DB = DBUtil::getInstance();

/* saving a new Discipline account*/
if(isset($_POST['save']))
{
	 $Discipline = new Discipline();	
	 $Discipline->setID(Util::getGUID());
     $Discipline->setName($_DB->secureInput($_POST['txtName']));
	 $_DisciplineBAO->createDiscipline($Discipline);		 
}


/* deleting an existing Discipline */
if(isset($_GET['del']))
{

	$Discipline = new Discipline();	
	$Discipline->setID($_GET['del']);	
	$_DisciplineBAO->deleteDiscipline($Discipline); //reading the Discipline object from the result object

	header("Location: view.discipline.php");
}


/* reading an existing Discipline information */
if(isset($_GET['edit']))
{
	$Discipline = new Discipline();	
	$Discipline->setID($_GET['edit']);	
	$getROW = $_DisciplineBAO->readDiscipline($Discipline)->getResultObject(); //reading the Discipline object from the result object
}

/*updating an existing Discipline information*/
if(isset($_POST['update']))
{
	$Discipline = new Discipline();	

    $Discipline->setID ($_GET['edit']);
    $Discipline->setName( $_POST['txtName'] );
	
	$_DisciplineBAO->updateDiscipline($Discipline);

	header("Location: view.discipline.php");
}



echo '<br> log:: exit view.blade.discipline.php';

?>