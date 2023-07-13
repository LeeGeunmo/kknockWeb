<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .hide {
            display: none;
        }
        #a {
            display: flex;
        }
        #b {
            display: flex;
        }
        #commentButton {
            width: fit-content;
            height: fit-content;
            margin-left: 10px;
            margin-top: 25px;
        }
    </style>
</head>
<body>
</body>
</html>
<?php

include ('topHeader.php');
include ('dbConnect.php');

$id = $_GET['id'];

$query = "select title,content,userId,created_at from board where id = '$id'";
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
    <?php 
    $que = "select count(*) as cnt from comment;"; 
    $res1 = mysqli_query($conn,$que);
    $num = mysqli_fetch_assoc($res1);
    
    $listNum = 3;
    $pageNum = 3;
    $page = isset($_GET['page'])? ($_GET['page']) : 1;
    $totalPage = ceil($num['cnt'] / $listNum);
    $totalblock = ceil($totalPage / $pageNum);
    $now_block = ceil($page / $pageNum);
    $s_pageNum = ($now_block - 1) * $pageNum + 1;
    if ($s_pageNum <= 0){
        $s_pageNum = 1;
    }
    $e_pageNum = $now_block * $pageNum;
    if ($e_pageNum > $totalPage){
        $e_pageNum = $totalPage;
    }
    ?>
    <div id="a">
    <h1 style="width : auto">제목 : <?php echo $row[0]; ?></h1>
    <h3>글쓴이 : <?php echo $row[2] ?></h3>
    <h3>작성일 : <?php echo $row[3] ?></h3>
    </div>
    <br>
    <h2>내용 : <?php echo $row[1]; ?></h2>
    <div id="control">
    <button onclick="location.href='content_delete.php?id=<?= $id ?>'">삭제하기</button>
    <button onclick="location.href='content_modify.php?id=<?= $id ?>'">수정하기</button>
    </div>
    <?php $check = ($_SESSION['id'] == $row[2] ? 'true' : 'false');?>
    <script>
        var control = document.getElementById("control");
        if (<?php echo $check ?>){
            control.classList.remove("hide");
        }else{
            control.classList.add("hide");
        }
    </script>
    <br>
    <h3>댓글목록</h3>
    <table>
        <?php 
        $start = ($page -1) * $listNum;
        $sql = "select * from comment limit $start, $listNum;";
        $res = mysqli_query($conn,$sql);
        $cnt = $start + 1; 
        while ($row = mysqli_fetch_assoc($res)){
        ?>
            <tr>
                <td style="font-weight : bold;"><?= $row['userId']?></td>
                <td><?= $row['created_at']?></td>
            </tr>
            <tr>
                <td colspan="2"><?= $row['content']?></td>
            </tr>
        <?php } ?>
    </table>
    <div id="button">
        <div id="LRButton">
            <?php
            if ($page <= 1){
            ?>
                <button id="leftButton" type="button" onclick="location.href='board_maintext.php?id=1'"><</button>
            <?php }else{ ?>
                <button id="leftButton" type="button" onclick="location.href='board_maintext.php?page=<?php echo ($page-1); ?>'"><</button>
            <?php } 
            for ($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?>
                <button id="page" onclick="location.href='board_maintext.php?page=<?php echo $print_page; ?>'"><?php echo $print_page; ?></button>
            <?php }
            if ($page >= $totalPage) { ?>
                <button id="rightButton" type="button" onclick="location.href='board_maintext.php?page=<?php echo $totalPage; ?>'">></button>
            <?php }else{ ?>
                <button id="rightButton" type="button" onclick="location.href='board_maintext.php?page=<?php echo ($page+1); ?>'">></button>
            <?php } ?> 
            
        </div><br>
        <div id="b">
        <textarea name="commentField" id="commentField" cols="30" rows="3"></textarea>
        <button id="commentButton" type="button" onclick="location.href='comment_write.php?=<?= $id ?>'">댓글쓰기</button>
        </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
