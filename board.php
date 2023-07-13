<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="topHeader.html">
    <title>게시판</title>
    <style>
        button {
            width: 65px;
            height: 45px;
        }
        table{
            margin: auto;
            width: 80%;
            height: auto;
            text-align : center;
            border-collapse: collapse;
            font-size: 20px;
        }
        #tableHead {
            border-bottom: solid;
        }
        #a {
            font-size: 20px;
            display: inline;
            padding: 0 10px 0 10px;
        }
        #button {
            padding-top: 20px;
        }
        #LRButton {
            display: inline;
            padding-left: 40%;
        }
        #page {
            width: auto;
            height: auto;
        }
    </style>
</head>
<body>
    
<?php
include ('topHeader.php');
include ('dbConnect.php');
$que = "select count(*) as cnt from board;"; 
$res1 = mysqli_query($conn,$que);
$num = mysqli_fetch_assoc($res1);

$listNum = 5;
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

<div align = "center"><h1>게시글 목록</h1></div>
<br><br><br><br>

<table border = "1">
    <tr id="tableHead">
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일</th>
    </tr>
    
    <?php 
    $start = ($page -1) * $listNum;
    $sql = "select * from board limit $start, $listNum;";
    $res = mysqli_query($conn,$sql);
    $cnt = $start + 1; 
    while ($row = mysqli_fetch_assoc($res)){
    ?>
        <tr onclick="window.location.href='board_maintext.php?id=<?= $row['id'] ?>'" style="cursor:pointer;">
                <td><?=$row['id']?></td>
                <td><?=$row['title']?></td>
                <td><?=$row['userId']?></td>
                <td><?=$row['created_at']?></td>
        </tr>
        <?php } ?>


</table>
<div id="button">
    <div id="LRButton">
        <?php
        if ($page <= 1){
        ?>
            <button id="leftButton" type="button" onclick="location.href='board.php?page=1'"><</button>
        <?php }else{ ?>
            <button id="leftButton" type="button" onclick="location.href='board.php?page=<?php echo ($page-1); ?>'"><</button>
        <?php } 
        for ($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?>
            <button id="page" onclick="location.href='board.php?page=<?php echo $print_page; ?>'"><?php echo $print_page; ?></button>
        <?php }
        if ($page >= $totalPage) { ?>
            <button id="rightButton" type="button" onclick="location.href='board.php?page=<?php echo $totalPage; ?>'">></button>
        <?php }else{ ?>
            <button id="rightButton" type="button" onclick="location.href='board.php?page=<?php echo ($page+1); ?>'">></button>
        <?php } ?> 
        
    </div>
    <button id="writeButton" type="button" onclick="location.href='board_write.php'" style= "float : right">글쓰기</button>
</div>
</body>
</html>
