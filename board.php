<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <style>
        button {
            width: 65px;
            height: 45px;
        }
    </style>
</head>
<body>
    
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

$query = "select * from board";
$rs = mysqli_query($conn,$query);
$rows = [];

while ($row = mysqli_fetch_assoc($rs)){
    $rows[] = $row;
}
?>
<div><h1>게시글 목록</h1></div><br>
<div>
    <button type="button" onclick="location.href='board_write.html'">글쓰기</button>
</div><br><br><br>
    <ul>
        <?php foreach ($rows as $row) { ?>
        <li>
            <a href="board_maintext.php?id=<?= $row['id'] ?>">
                <h3><?=$row['title']?></h3>
                <p><?=$row['content']?></p>
            </a>
        </li>
        <?php } ?>
    </ul>

</body>
</html>
