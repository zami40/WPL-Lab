<?php

include_once '../common/class.common.php';

class PermissionXML{
    var $id;  // id of permission
    var $name;    // name of permission
    var $category;  // category of permission
    
    //map the tag, value pair with the members serially
    //used in xml to permission mapping
    function PermissionXML ($row) {

        //todo: check for the exception situation

        foreach ($row as $k=>$v)
            $this->$k = $row[$k];

    }

}

/*
 Read XML formatted permission items from the file and 
 map it with the Permission Object. 
 Todo: Make this class generic
*/
class XMLtoPermission{

    var $_filename;
    var $_parsed;
    private $_DB;

    function __construct($fileToRead){
        
        $this->_filename = $fileToRead;       
    }

    /*
    Read XML file as XML parsing and map the value with Permission object
    */

    private function readXML() {

        // read the XML database of aminoacids
        $data = implode("", file($this->_filename));
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $data, $values, $tags);
        xml_parser_free($parser);

        // loop through the structures
        foreach ($tags as $key=>$val) {
            //todo: take this value as root in the constructor to make a generic version
            if ($key == "permission") {
                $perm_ranges = $val;
                // each contiguous pair of array entries are the 
                // lower and upper range for each permission definition
                for ($i=0; $i < count($perm_ranges); $i+=2) {
                    $offset = $perm_ranges[$i] + 1;
                    $len = $perm_ranges[$i + 1] - $offset;
                    //todo: change parsePermission to generic form
                    $tdb[] = $this->parsePermission(array_slice($values, $offset, $len));
                }
            } else {
                continue;
            }
        }
        echo '<br> permission load is successful';
        return $tdb;
    }

    /*Creating the tag, value pairs */
    private function parsePermission($pvalues) 
    {
        for ($i=0; $i < count($pvalues); $i++) {
            $perm[$pvalues[$i]["tag"]] = $pvalues[$i]["value"];
        }
        //todo: change permission object to generic form
        return new PermissionXML($perm);
    }

    // loads the xml to the permission objects and return the result
    public function load(){
        
        return $this->readXML();
    }

    //stores the already loaded permission data into the database
    public function saveInDB($Permissions){
        //first time storing all the permissions into the permission database
        
        $this->_DB = DBUtil::getInstance();

            //beginning a transaction   
        $this->_DB->getConnection()->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    

        for ($i=0; $i < sizeof($Permissions); $i++) { 
            $Permission = $Permissions[$i];

            
            $SQL = "INSERT INTO tbl_Permission(ID,Name,Category) 
                                        VALUES('".$Permission->id."','".$Permission->name."','".$Permission->category."')"; 
            
        
            $SQL = $this->_DB->doQuery($SQL);
        }   

        //closing the transaction
        $this->_DB->getConnection()->commit();

        echo '<br> permission saved to database';
    }


}


?>