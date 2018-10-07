<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class DisciplineDAO{

	private $_DB;
	private $_Discipline;

	function DisciplineDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Discipline = new Discipline();

	}

	// get all the Disciplines from the database using the database query
	public function getAllDisciplines(){

		$DisciplineList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_Discipline");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Discipline = new Discipline();

		    $this->_Discipline->setID ( $row['ID']);
		    $this->_Discipline->setName( $row['Name'] );


		    $DisciplineList[]=$this->_Discipline;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($DisciplineList);

		return $Result;
	}

	//create Discipline funtion with the Discipline object
	public function createDiscipline($Discipline){

		$ID=$Discipline->getID();
		$Name=$Discipline->getName();


		$SQL = "INSERT INTO tbl_Discipline(ID,Name) VALUES('$ID','$Name')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an Discipline object based on its id form Discipline object
	public function readDiscipline($Discipline){
		
		
		$SQL = "SELECT * FROM tbl_Discipline WHERE ID='".$Discipline->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Discipline from the database
		$row = $this->_DB->getTopRow();

		$this->_Discipline = new Discipline();

		//preparing the Discipline object
	    $this->_Discipline->setID ( $row['ID']);
	    $this->_Discipline->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Discipline);

		return $Result;
	}

	//update an Discipline object based on its 
	public function updateDiscipline($Discipline){

		$SQL = "UPDATE tbl_Discipline SET Name='".$Discipline->getName()."' WHERE ID='".$Discipline->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Discipline based on its id of the database
	public function deleteDiscipline($Discipline){


		$SQL = "DELETE from tbl_Discipline where ID ='".$Discipline->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.disciplinedao.php';

?>