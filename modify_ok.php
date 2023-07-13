<?php
include ('dbConnect.php');

$id = $_GET['id'];
$content = $_POST['modify'];

$query = "update board set content = '$content' where id = $id";


if ($conn->query($query) === TRUE){
  echo "<script>alert('수정되었습니다.')</script>";
  echo "<script>location.replace('board_maintext.php?id=$id')</script>";
}
else {
    echo "데이터 삭제 실패: " . $conn->error;
}

$conn->close();
?>
