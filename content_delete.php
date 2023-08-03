<?php
include ('dbConnect.php');

$id = $_GET['id'];

$deleteQuery = "delete from comments where contentId = $id";
$query1 = "delete from board where id = $id;";
// $query2 = "set @count = 0;";
// $query3 = "update board set id = @count:=@count+1;";
// $query4 = "alter table board auto_increment=1;";

if ($conn->query($deleteQuery) === TRUE) {
  if ($conn->query($query1) === TRUE){
    echo "<script>alert('삭제되었습니다.')</script>";
    echo "<script>location.replace('board.php')</script>";
  }
  else {
      echo "데이터 삭제 실패: " . $conn->error;
  }
}
else {
  echo "댓글 삭제 실패: ". $conn->error;
}

// if ($conn->query($query2) && $conn->query($query3) && $conn->query($query4) === TRUE){
//   echo "정렬완료";
// }
// else {
//   echo "정렬실패" . $conn->error;
// }


$conn->close();
?>
