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
        <!-- NAV導覽列 -->
        <nav class="navbar sticky-top navbar-light" style="background-color: #FF8698">
            <a class="navbar-brand" href="../">防疫實名登記系統 # 活動人員STAFF</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link active" href="../">主頁 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../about_this.html">關於本服務</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">STUST CSIE 109-1 《資料庫系統》 </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php  /* PHP連接資料庫初始化 */
            $server = "localhost";          # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";      # 使用者帳號
            $dbpassword = "i5tpsLQD8j";     # 使用者密碼
            $dbname = "u683395981_MyMainSQL";          # 資料庫名稱

            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            # 檢查連線是否成功
            if ($connection->connect_error) {
            die("連線失敗：" . $connection->connect_error);
            }
        ?>

        <div class="container">
            <div class="row align-items-center">
                <div class="col"></div>
                <div class="col-8">
                    <h2 class="text-center mt-5">註冊新帳號</h2>
                    <h5 class="text-center mb-3">成為活動人員STAFF</h5>

                    <?php
                        date_default_timezone_set('Asia/Taipei');
                        $StaffAccount = $_COOKIE["StaffAccount"];
                        $StaffPassword = $_COOKIE["StaffPassword"];
                        $StaffEmail = $_REQUEST["StaffEmail"];
                        $StaffIP = $_REQUEST["StaffIP"];
                        $NowTime = date("Y-m-d H:i:s");

                        # 檢查帳號重複 MySQL/MariaDB 指令
                        $sqlQuery = " SELECT account FROM dbFE_EventStaff WHERE BINARY account='$StaffAccount' ";
                        # 執行 MySQL/MariaDB 指令
                        if ($result = $connection->query($sqlQuery)) {
                            // 如果已存在的帳號
                            if ( mysqli_num_rows($result) > 0 ){
                                echo "<script>alert('已存在的帳號不可註冊，請重新輸入。'); location.href='./index.php';</script>";
                                exit;
                            }
                        }
                        else {
                            echo "執行失敗：" . $connection->error;
                            exit;
                        }

                        $StaffIP = $StaffIP . "@" . $NowTime;
                        # 開始新增STAFF MySQL/MariaDB 指令
                        $sqlQuery = " INSERT INTO dbFE_EventStaff(account,password,Email,Creater,Level) VALUES('$StaffAccount', '$StaffPassword', '$StaffEmail', '$StaffIP', '0'); ";
                        # 執行 MySQL/MariaDB 指令
                        if ($result = $connection->query($sqlQuery)) {

                        } 
                        else {
                            echo "執行失敗：" . $connection->error;
                            exit;
                        }
                        
                    ?>

                    <div class="card" style="width: auto">
                        <div class="card-body">
                            <h3 class="card-title text-center"><strong><ion-icon name="checkmark-circle-outline" size="large"></ion-icon></br>註冊完成</strong></h3>
                            <div class="card-text mt-3 mb-3">
                            恭喜您，您已完成註冊程序，現已可開始登入。</br>
                            <p><code class="text-danger">* 初註冊之STAFF帳號等級均為0，多項功能無法使用，請聯繫網站開發者進行驗證，取得帳號升級，始可使用功能。</code></p>
                            </div>
                            <a class='btn btn-secondary btn-block' href="../">返回登入</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>

</HTML>
