<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        header {
            background: lightgray;
            background-image: url('kknock_logo_white.png');
            background-size: contain;
            height: 130px;
            color: white;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
        #loginButton {
            float: right;
            padding-right: 20px;
        }
        li {
            font-size: 20px;
            list-style-type: none;
            float: left;
            margin-left: 40px;
            position: relative;
            left: 40%;
        }
        menu {
        }
    </style>
</head>
<body>
    <header>
        <h1>K.knock 게시판</h1>
        <nav>
            <div id="menu">
            <li><h3 onclick="window.location.href='index.php'" style="cursor:pointer;">메인</h3></li>
            <li><h3 onclick="window.location.href='board.php'" style="cursor:pointer;">게시판</h3></li>
            </div>
            <li id="loginButton"><h3 onclick="window.location.href='login.html'" style="cursor:pointer;">로그인</h3></li>
        </nav>
    </header>
</body>
</html>