<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include ('topHeader.php'); ?>
    <h1>글쓰기</h1>
    
    <form method="post" action="./board_action.php" enctype="multipart/form-data">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title"><br><br>
        
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>

        <label for="file">첨부파일:</label>
        <input type="file" id="file" name="upload_file" accept=".pdf, .doc, .docx, .jpg, .png"><br><br>

        <button type="submit">게시글 작성</button>
    </form>
</body>
</html>
