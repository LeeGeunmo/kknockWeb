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
            table-layout: fixed;
            border-left: none;
            border-right: none;
        }
        table td, th{
            border-left: none;
            border-right: none;
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
        #sort {
            float : right;
            position: absolute;
            top: 30%;
            right : 11%;
        }
        #sortBox{
            width: 60px;
            height: 30px;
        }
        #writeButton {
            float : right;
            position : absolute;
            right : 11%;

        }
    </style>
</head>
<body>
<?php
include ('topHeader.php');
include ('dbConnect.php');
$listNum = 5;
$page = isset($_GET['page'])? ($_GET['page']) : 1;
$start = ($page -1) * $listNum;
$sql = "";
$sql1 = "";

if (isset($_POST['searchOption'])){
    $_SESSION['searchOption'] = $_POST['searchOption'];
}
if (isset($_POST['searchData'])){
    $_SESSION['searchData'] = $_POST['searchData'];
}
if (isset($_POST['sortBox'])){
    $_SESSION['option'] = $_POST['sortBox'];
}
$searchOption = isset($_SESSION['searchOption']) ? $_SESSION['searchOption'] : '';
$searchData = isset($_SESSION['searchData']) ? $_SESSION['searchData'] : '';
$option = isset($_SESSION['option']) ? $_SESSION['option'] : 'a';


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    make_query($searchOption,$searchData,$option,$start,5,$sql,$sql1);
}


$searchOption = isset($_SESSION['searchOption']) ? $_SESSION['searchOption'] : '';
$searchData = isset($_SESSION['searchData']) ? $_SESSION['searchData'] : '';
// echo "\$_SESSION['searchOption']: ". $_SESSION['searchOption']; echo "<br>";
// echo "\$_SESSION['searchData']: ". $_SESSION['searchData'];echo "<br>";
// echo "\$searchOption: ". $searchOption;echo "<br>";
// echo "\$searchData: ". $searchData;echo "<br>";

?>

<div align = "center"><h1>게시글 목록</h1></div>
<br><br><br><br>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" id="searchForm">
    <div id="sort"><select name="sortBox" id="sortBox" onchange="sortF();">
        <option value="">정렬</option>
        <option value="sortDate">최신순</option>
        <option value="sortOldDate">오래된순</option>
        <option value="sortId">작성자</option>
    </select></div>
</form>
<script>
    const sortF = () =>{
        document.forms[0].submit();
    }
</script>
<?php
$que = isset($_SESSION['sql'])? $_SESSION['sql'] : "select count(*) as cnt from board;";
$que2 = isset($_SESSION['sql2'])? $_SESSION['sql2'] : "select count(*) as cnt from board;";
// echo $que; echo "<br>";
// echo $_SESSION['sql']; echo "<br>";

$res1 = mysqli_query($conn,$que);
$res2 = mysqli_query($conn,$que2); 
$num = mysqli_fetch_assoc($res2);
// echo $num['cnt']; echo "<br>";

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

$start = ($page -1) * $listNum;


// echo "\$_SESSION['searchOption']: ". $_SESSION['searchOption']; echo "<br>";
// echo "\$_SESSION['searchData']: ". $_SESSION['searchData'];echo "<br>";
// echo "\$searchOption: ". $searchOption;echo "<br>";
// echo "\$searchData: ". $searchData;echo "<br>";
switch ($searchOption){
    case 's.title':
        $sql .= "select * from board where title like '%$searchData%' ";
        $sql1 .= "select count(*) as cnt from board where title like '%$searchData%' ";
        break;
    case 's.writer':
        $sql .= "select * from board where userId like '%$searchData%' ";
        $sql1 .= "select count(*) as cnt from board where userId like '%$searchData%' ";
        break;
    default :
        $sql .= "select * from board ";
        $sql1 .= "select count(*) as cnt from board ";
        break;
}

$option = isset($_POST['sortBox']) ? $_POST['sortBox'] : 'a';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['sortBox'])){
        $_SESSION['option'] = $_POST['sortBox'];
    }
}
else {
    if (isset($_SESSION['option'])){
        $option = $_SESSION['option'];
    }
}
$sql2 = $sql1;
switch ($option) {
    case "sortDate":
        $sql .= " order by created_at desc limit $start, $listNum;";
        $sql1 .= " order by created_at desc limit $start, $listNum;";
        $sql2 .= " order by created_at desc;";
        break;
    case "sortOldDate":
        $sql .= " order by created_at asc limit $start, $listNum;";
        $sql1 .= " order by created_at asc limit $start, $listNum;";
        $sql2 .= " order by created_at asc;";
        break;
    case "sortId":
        $sql .= " order by userId asc limit $start, $listNum;";
        $sql1 .= " order by userId asc limit $start, $listNum;";
        $sql2 .= " order by userId asc;";
        break;
    default :
        $sql .= " order by id asc limit $start, $listNum;";
        $sql1 .= " order by id asc limit $start, $listNum;";
        $sql2 .= " order by id asc;";
        break;
}
$_SESSION['sql'] = $sql1;
$_SESSION['sql2'] = $sql2;
// echo $_SESSION['sql'];

$res = mysqli_query($conn,$sql);
$cnt = $start + 1; 
?>

<table border = "1">
    <tr id="tableHead">
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일</th>
    </tr>
    <?php
    $num = isset($_GET['page'])? ($_GET['page']-1)*$listNum + 1 : 1;
    if (isset($_GET['page'])){
        if ($_GET['page'] == 1){
            $num = 1;
        }
    }
    
    while ($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }
    if (!empty($data)){
        foreach ($data as $row){ ?>
            <tr onclick="window.location.href='board_maintext.php?id=<?= $row['id'] ?>'" style="cursor:pointer;">
                    <td><?=$num?></td>
                    <td><?=$row['title']?></td>
                    <td><?=$row['userId']?></td>
                    <td><?=$row['created_at']?></td>
            </tr>
        <?php $num++; } 
    } 
    else { ?>
        <tr>
            <td colspan="4"><h2>일치하는 데이터가 없습니다.</h2></td>
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
        <?php }?> 
    </div>
    <button id="writeButton" type="button" onclick="location.href='board_write.php'">글쓰기</button>
    <div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">   
        <select name="searchOption" id="searchOption">
            <option value="">검색</option>
            <option value="s.title">제목</option>
            <option value="s.writer">작성자</option>
        </select>
        <input type="text" name="searchData" id="searchData">
        <input type="submit" value="검색">
        </form>
    </div>
    <?php
    function make_query($searchOption,$searchData,$option,$start,$listNum,$sql,$sql1){
        switch ($searchOption){
            case 's.title':
                $sql .= "select * from board where title like '%$searchData%' ";
                $sql1 .= "select count(*) as cnt from board where title like '%$searchData%' ";
                break;
            case 's.writer':
                $sql .= "select * from board where userId like '%$searchData%' ";
                $sql1 .= "select count(*) as cnt from board where userId like '%$searchData%' ";
                break;
            default :
                $sql .= "select * from board ";
                $sql1 .= "select count(*) as cnt from board ";
                break;
            }

        $option = isset($_POST['sortBox']) ? $_POST['sortBox'] : 'a';
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['sortBox'])){
                $_SESSION['option'] = $_POST['sortBox'];
            }
        }
        else {
            if (isset($_SESSION['option'])){
                $option = $_SESSION['option'];
            }
        }
        $sql2 = $sql1;
        switch ($option) {
            case "sortDate":
                $sql .= " order by created_at desc limit $start, $listNum;";
                $sql1 .= " order by created_at desc limit $start, $listNum;";
                $sql2 .= " order by created_at desc;";
                break;
            case "sortOldDate":
                $sql .= " order by created_at asc limit $start, $listNum;";
                $sql1 .= " order by created_at asc limit $start, $listNum;";
                $sql2 .= " order by created_at asc;";
                break;
            case "sortId":
                $sql .= " order by userId asc limit $start, $listNum;";
                $sql1 .= " order by userId asc limit $start, $listNum;";
                $sql2 .= " order by userId asc;";
                break;
            default :
                $sql .= " order by id asc limit $start, $listNum;";
                $sql1 .= " order by id asc limit $start, $listNum;";
                $sql2 .= " order by id asc;";
                break;
        }
        $_SESSION['sql'] = $sql1;
        $_SESSION['sql2'] = $sql2;
    }
?>
</div>
</body>
</html>
