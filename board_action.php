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
$title = $_POST['title'];
$content = $_POST['content'];

$query = "insert into board(title,content) values('$title','$content')";


if ($conn->query($query) === TRUE){
    echo "<script>location.replace('board.php')</script>";
}
else {
    echo "데이터 저장 실패: " . $conn->error;
}

$conn->close();
?>
