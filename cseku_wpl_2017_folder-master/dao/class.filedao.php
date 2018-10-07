<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class FileDAO{

	private $_DB;
	private $_File;

	function FileDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_File = new File();

	}

	// get all the Files from the database using the database query
	public function getAllFiles(){

		$FileList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_File");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_File = new File();

		    $this->_File->setID ( $row['ID']);
		    $this->_File->setCreator( $row['CreatorID'] );
		    $this->_File->setName( $row['Name'] );
		    $this->_File->setLink( $row['Link'] );
		    $this->_File->setDiscipline( $row['DisciplineID'] );
		    
		    




		    $FileList[]=$this->_File;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($FileList);

		return $Result;
	}

	//create File funtion with the File object
	public function createFile($File){

		$ID=$File->getID();
		$Creator=$File->getCreator();
		$Name=$File->getName();
		$Link=$File->getLink();
		$DisciplineID=$File->getDiscipline();




		$SQL = "INSERT INTO tbl_File(ID,CreatorID,Name,Link,DisciplineID) VALUES('$ID','$Creator', '$Name', '$Link', '$DisciplineID')";

		

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an File object based on its id form File object
	public function readFile($File){
		
		
		$SQL = "SELECT * FROM tbl_File WHERE ID='".$File->getID()."'";
		
		//echo $SQL;
		$this->_DB->doQuery($SQL);

		//reading the top row for this File from the database
		$row = $this->_DB->getTopRow();

		$this->_File = new File();

		//preparing the File object
	    $this->_File->setID ( $row['ID']);
	    $this->_File->setName( $row['Name'] );
	    $this->_File->setLink($row['Link']);


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_File);

		return $Result;
	}

	//update an File object based on its 
	public function updateFile($File){

		//$SQL = "UPDATE tbl_File SET Name='".$File->getName()."' WHERE ID='".$File->getID()."'";

		$SQL = "UPDATE tbl_File SET Name='".$File->getName()."', 
			Link='".$File->getLink()."',
			DisciplineID='".$File->getDiscipline()."' WHERE ID='".$File->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an File based on its id of the database
	public function deleteFile($File){


		$SQL = "DELETE from tbl_File where ID ='".$File->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.filedao.php';

?>