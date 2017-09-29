<?php
include("db.php");
/**
* 
*/
class Member 
{
	public function getAllMembers(){
		global $connection ;
		$statement = $connection->prepare("SELECT * FROM members");
		$statement->execute();
		$result = $statement->fetchAll();
		//return $statement->rowCount();
		return $result;

	}
	public function getParentMembers(){
		global $connection ;
		$statement = $connection->prepare("SELECT * FROM members where parentId=0");
		$statement->execute();
		$result = $statement->fetchAll();
		//return $statement->rowCount();
		return $result;

	}
	public function insertMember($inputParamArray){
		global $connection ;
		$sqlInsert = "INSERT INTO members(name, createdOn, parentId)
		    VALUES(:name, :createdOn, :parentId)";		
		$statement = $connection->prepare($sqlInsert);
		$statement->execute(array(
		    "name" => $inputParamArray['name'],
		    "createdOn" => date("Y-m-d H:i:s"),
		    "parentId" => $inputParamArray['parentId']
		));
	}
}