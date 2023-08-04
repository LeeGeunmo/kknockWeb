<?php
include ('dbConnect.php');
session_start();

$id = $_GET['id'];
$sesId = $_SESSION['id'];
$content = $_POST['commentField'];

$query = "insert into comments (contentId,userId,content) values ($id,'$sesId','$content')";


if ($conn->query($query)){
  echo "<script>location.replace('board_maintext.php?id=$id')</script>";
}
else {
    echo "데이터 삭제 실패: " . $conn->error;
}

$conn->close();
?>
