<?php
include ('topHeader.php');
include ('dbConnect.php');

$id = $_GET['id'];
$cid = $_GET['cid'];

$query = "select * from comments where id = '$id';";
$res = mysqli_query($conn,$query);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>댓글 수정</h1>
    <form action="comment_modify_ok.php?id=<?=$id ?>&cid=<?=$cid?>" method="post">
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
