<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class TermDAO{

	private $_DB;
	private $_Term;

	function TermDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Term = new Term();

	}

	// get all the Terms from the database using the database query
	public function getAllTerms(){

		$TermList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_Term");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Term = new Term();

		    $this->_Term->setID ( $row['ID']);
		    $this->_Term->setName( $row['Name'] );


		    $TermList[]=$this->_Term;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($TermList);

		return $Result;
	}

	//create Term funtion with the Term object
	public function createTerm($Term){

		$ID=$Term->getID();
		$Name=$Term->getName();


		$SQL = "INSERT INTO tbl_Term(ID,Name) VALUES('$ID','$Name')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an Term object based on its id form Term object
	public function readTerm($Term){
		
		
		$SQL = "SELECT * FROM tbl_Term WHERE ID='".$Term->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Term from the database
		$row = $this->_DB->getTopRow();

		$this->_Term = new Term();

		//preparing the Term object
	    $this->_Term->setID ( $row['ID']);
	    $this->_Term->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Term);

		return $Result;
	}

	//update an Term object based on its 
	public function updateTerm($Term){

		$SQL = "UPDATE tbl_Term SET Name='".$Term->getName()."' WHERE ID='".$Term->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Term based on its id of the database
	public function deleteTerm($Term){


		$SQL = "DELETE from tbl_Term where ID ='".$Term->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.termdao.php';

?>