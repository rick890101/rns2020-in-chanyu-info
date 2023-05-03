<HTML>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>#活動人員STAFF 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
    </head>

    <body>
        <?php
            $server = "localhost";                       # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";        # 使用者帳號
            $dbpassword = "i5tpsLQD8j";                  # 使用者密碼
            $dbname = "u683395981_MyMainSQL";            # 資料庫名稱

            if(!empty(@$_POST["StaffAccount"])){
                $StaffAccount = $_POST["StaffAccount"];
            }else{
                $StaffAccount = $_COOKIE["StaffAccount"];
            }

            if(!empty(@$_POST["StaffPassword"])){
                $StaffPassword = $_POST["StaffPassword"];
            }else{
                $StaffPassword = $_COOKIE["StaffPassword"];
            }

            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            # 檢查連線是否成功
            if ($connection->connect_error) {
            die("連線失敗：" . $connection->connect_error);
            }
        ?>

        <!-- NAV導覽列 -->
        <nav class="navbar sticky-top navbar-light" style="background-color: #FF8698">
            <a class="navbar-brand" href="../">防疫實名登記系統 # 活動人員STAFF</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="../">主頁 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"><strong>登入帳號資訊</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about_this.html">關於本服務</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">STUST CSIE 109-1 《資料庫系統》 </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <!-- NAV功能導覽列 -->
            <ul class="nav nav-pills nav-fill mt-2">
                <li class="nav-item">
                    <a class="nav-link" href="./event-setting">查看現有活動登錄</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-new-event">建立新活動</a>
                </li>
            </ul>
            
        <?php
            # MySQL/MariaDB 指令
            $sqlQuery = " SELECT Email, Creater, account, password FROM dbFE_EventStaff WHERE BINARY account='$StaffAccount' AND BINARY password='$StaffPassword' ";
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {

                //echo "共取得 " .mysqli_num_rows($result). " 筆";

                // 帳號密碼錯誤重導向
                if ( mysqli_num_rows($result) == 0 ){
                    header("Location: ./index.php?eid=100"); 
                    exit;
                }elseif( mysqli_num_rows($result) == 1 ){
                    while ($row = mysqli_fetch_row($result)) {
                    }
                    setcookie( "StaffAccount", $StaffAccount, time()+3600, "/"); 
                    setcookie( "StaffPassword", $StaffPassword, time()+3600, "/");
                }

                echo ' <div class="card text-center mt-5" style="width: auto;"><div class="card-body"> ';
                echo ' <h3 class="card-title"><strong>您現已登入</strong></h3> ';
                echo ' <p class="card-text">';
                echo "帳號： $StaffAccount 您好</p>請您務必記得登出，以維護民眾個資防止外洩！";
                echo ' </p> ';
                echo ' <a href="./logout_program.php" class="btn btn-primary">登出</a></div></div> ';
                
                

                # 釋放資源
                $result->close();
            } else {
            echo "執行失敗：" . $connection->error;
            }
            # 關閉 MySQL/MariaDB 連線
            $connection->close();

        ?>

            
        </div>
        <footer class="text-muted py-5">
            <div class="container">
                <p class="mb-1 text-center">當您使用本網站，即視同您以瞭解本網站之<a href="" onclick="window.open ('../user-policies.html', 'newwindow', 'height=600, width=480, top=20, left=800, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no,status=no')">《使用條款》、《Cookie使用告知》</a>。</p>
            </div>
        </footer>

<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</HTML>