<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
// MySQL 데이터베이스 연결 설정
$servername = "localhost";   // MySQL 서버 주소
$username = "root";       // MySQL 사용자명
$password = "0000";       // MySQL 비밀번호
$dbname = "testdb";    // 사용할 데이터베이스명

// MySQL 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

$id = $_GET['id'];

$query1 = "delete from board where id = '$id';";
$query2 = "alter table board auto_increment=1;";
$query3 = "set @count = 0;";
$query4 = "update board set id = @count:=@count+1;";


if ($conn->query($query1) && $conn->query($query2) && $conn->query($query3) && $conn->query($query4) === TRUE){
  echo "<script>alert('삭제되었습니다.')</script>";
  echo "<script>location.replace('board.php')</script>";
}
else {
    echo "데이터 삭제 실패: " . $conn->error;
}

$conn->close();
?>
