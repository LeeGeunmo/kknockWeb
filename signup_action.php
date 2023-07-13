<?php
include ('dbConnect.php');
$id = $_POST['id'];
$pwd = $_POST['pwd'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$tel = $_POST['tel'];



$query = "insert into users(id,pwd,name,gender,tel) values('$id','$pwd','$name','$gender','$tel')";


if ($conn->query($query) === TRUE){
    echo "<script>alert('회원가입이 완료되었습니다.');</script>";
    echo "<script>location.replace('login.html');</script>";
}
else {
    echo "데이터 저장 실패: " . $conn->error;
}

$conn->close();
?>