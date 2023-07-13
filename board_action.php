<?php
include ('dbConnect.php');

date_default_timezone_set('Asia/Seoul');

$title = $_POST['title'];
$content = $_POST['content'];
$userId = $_SESSION['id'];
echo $userId;
$created_at = date('Y-m-d H:i:s');

$query = "insert into board(title,content,userId,created_at) values('$title','$content','$userId','$created_at')";


if ($conn->query($query) === TRUE){
    echo "<script>alert('작성되었습니다.')</script>";
    echo "<script>location.replace('board.php')</script>";
}
else {
    echo "데이터 저장 실패: " . $conn->error;
}

$conn->close();
?>
