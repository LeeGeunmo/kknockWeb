<?php
include ('topHeader.php');
include ('dbConnect.php');

$id = $_GET['id'];

$query = "select * from board where id = '$id';";
$res = mysqli_query($conn,$query);
$row = mysqli_fetch_array($res);

echo $_SESSION['id']; echo "<br>";
echo $row['userId']; echo "<br>";

if ($_SESSION['id'] != $row['userId']){
    echo "<script>alert('비정상적인 접근입니다.');</script>";
    //echo "<script>location.replace('board.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>내용 수정</h1>
    <form action="modify_ok.php?id=<?php echo $id ?>" method="post">
        <textarea name="modify" id="modify" cols="30" rows="10"><?php echo $row['content'] ?></textarea>
        <button type="submit">수정하기</button>
    </form>
</body>
</html>
<?php

// if ($conn->query($query1) && $conn->query($query2) && $conn->query($query3) && $conn->query($query4) === TRUE){
//   echo "<script>alert('삭제되었습니다.')</script>";
//   echo "<script>location.replace('board.php')</script>";
// }
// else {
//     echo "데이터 삭제 실패: " . $conn->error;
// }

$conn->close();
?>
