<?php
include ('dbConnect.php');

$sortOption = $_POST['sortBox'];
$query = 'select * from board ';
$data = [];

switch ($sortOption) {
    case "sortDate":
        $query .= "order by created_at desc ";
        break;
    case "sortOldDate":
        $query .= "order by created_at asc ";
        break;
    case "sortId":
        $query .= "order by userId asc ";
        break;
    default :
        $query .= "order by id asc ";
        break;
}
return $query;
?>