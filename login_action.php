<?php
include ('dbConnect.php');
$id = $_POST['id'];
$pwd = $_POST['pwd'];


$query = "select * from users where id = '$id' and pwd = '$pwd'";
$res = $conn->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);

if ($res->num_rows > 0){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    echo "<script>location.replace('index.php');</script>";
}
else{
    $error = "아이디 또는 비밀번호가 잘못되었습니다.";
    echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.')</script>";
    echo "<script>location.replace('login.html');</script>";
}
?>
