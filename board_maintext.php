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

$query = "select title,content from board where id = '$id'";
$res = mysqli_query($conn,$query);

$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> 게시글 상세 페이지<?php echo $id ?></title>
</head>
<body>
    <h1>제목 : <?php echo $row[0]; ?></h1>
    <br>
    <h2>내용 : <?php echo $row[1]; ?></h2>
    <form method="POST" action="content_delete.php?id=<?= $id ?>">
        <input type="submit" value="삭제하기">
    </form>
</body>
</html>

<?php
$conn->close();
?>
