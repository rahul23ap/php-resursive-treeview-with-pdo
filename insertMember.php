<?php
include("memberClass.php");
$objMember = new Member;

$inputParamArray = array();
$inputParamArray['name'] = $_REQUEST['name'];
$inputParamArray['parentId'] = $_REQUEST['parentId'];
$objMember->insertMember($inputParamArray);

echo "Insert Member Successfully";
?>