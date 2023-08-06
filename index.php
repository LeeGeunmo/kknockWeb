<?php
include ('topHeader.php');
session_start();
if(!isset($_SESSION['id'])){
    echo "<script>location.replace('login.html');</script>";
}
else{
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
}

$id = sanitizeInput($id);
$name = sanitizeInput($name);

function sanitizeInput($input)
{
    // Remove leading and trailing whitespace
    $trimmedInput = trim($input);
    
    // Convert special characters to HTML entities
    $sanitizedInput = htmlspecialchars($trimmedInput, ENT_QUOTES, 'UTF-8');
    
    return $sanitizedInput;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인</title>
    <style>
    </style>
</head>
<body>
    <h1><?php echo "Hi, $id($name)."; ?></h1>
    <a href="./board.php">게시판</a><br><br>
    <button type="button" onclick="location.href='logout.php'">LOGOUT</button>
</body>
</html>