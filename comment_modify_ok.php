<?php
include ('dbConnect.php');
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$id = $_GET['id'];
$cid = $_GET['cid'];
$content = $_POST['modify'];

$query = "update comments set content = '$content' where id = $id";


if ($conn->query($query) === TRUE){
    
  echo "<script>location.replace('board_maintext.php?id=$cid')</script>";
}
else {
    echo "데이터 삭제 실패: " . $conn->error;
}

$conn->close();
?>
