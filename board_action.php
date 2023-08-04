<?php
include ('dbConnect.php');

date_default_timezone_set('Asia/Seoul');
session_start();

$title = $_POST['title'];
$content = $_POST['content'];
$userId = $_SESSION['id'];
$created_at = date('Y-m-d H:i:s');
if (empty($title) || empty($content)) {
    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] === UPLOAD_ERR_OK){
        $targetDir = "uploads/"; // Directory where you want to store the uploaded files
        $targetFile = $targetDir . basename($_FILES['upload_file']["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if the file is a valid file type (you can customize the allowed file types)
        $allowedTypes = array("pdf", "doc", "docx", "jpg", "png");
        if (!in_array($fileType, $allowedTypes)) {
            echo "Sorry, only PDF, DOC, DOCX, JPG, and PNG files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if the file was uploaded successfully
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["upload_file"]["name"]) . " has been uploaded.";
                // Here, you can save the file information and other details to your database, if required.
                // For example, you can store the file name, user ID, timestamp, etc. in the forum database.
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    
    
    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] === UPLOAD_ERR_OK){
        $fName = $_FILES['upload_file']["name"];
        $query = "insert into board(title,content,userId,created_at,file) values('$title','$content','$userId','$created_at','$fName')";
    }
    else {
        $query = "insert into board(title,content,userId,created_at) values('$title','$content','$userId','$created_at')";
    }
    
    
    
    if ($conn->query($query) === TRUE){
        echo "<script>alert('작성되었습니다.')</script>";
        echo "<script>location.replace('board.php')</script>";
    }
    else {
        echo "데이터 저장 실패: " . $conn->error;
    }
}
else {
    echo "제목과 내용을 입력해야 합니다.";
}



$conn->close();
?>
