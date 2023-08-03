<?php
include ('dbConnect.php');

$id = $_GET['id'];
$cid = $_GET['cid'];

$deleteQuery = "delete from comments where id = $id";

if ($conn->query($deleteQuery) === TRUE) {
    echo "<script>location.replace('board_maintext.php?id=$cid')</script>";
}
else {
  echo "댓글 삭제 실패: ". $conn->error;
}



$conn->close();
?>
