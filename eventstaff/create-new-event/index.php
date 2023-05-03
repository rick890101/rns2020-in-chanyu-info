<HTML>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>建立新活動 #活動人員STAFF 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
    </head>

    <body>
        <?php
            $server = "localhost";          # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";      # 使用者帳號
            $dbpassword = "i5tpsLQD8j";     # 使用者密碼
            $dbname = "u683395981_MyMainSQL";          # 資料庫名稱

            $StaffAccount = $_COOKIE["StaffAccount"];
            $StaffPassword = $_COOKIE["StaffPassword"];
            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            # 檢查連線是否成功
            if ($connection->connect_error) {
            die("連線失敗：" . $connection->connect_error);
            }

            // 登入處理服務
            if( $StaffAccount=="" || $StaffPassword=="" ){
                header("Location: ../index.php?eid=clear"); 
                exit;
            }

            # 檢查帳號重複 MySQL/MariaDB 指令
            $sqlQuery = " SELECT Level FROM dbFE_EventStaff WHERE BINARY account='$StaffAccount' ";
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {
                while( $row = $result->fetch_row() ) {
                    if( $row[0]<10 ){
                        echo "<script>alert('帳號等級過低，此功能無法使用。請聯繫網站開發者。'); location.href='../index.php';</script>";
                        exit;
                    }
                }
            }
            else {
                echo "執行失敗：" . $connection->error;
                exit;
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
                        <a class="nav-link active" href="../../">主頁 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login_program.php">登入帳號資訊</a>
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
                    <a class="nav-link" href="../event-setting">查看現有活動登錄</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">建立新活動</a>
                </li>
            </ul>

            <div class="mt-5">

            <form method="POST" action="./create-event.php">
                <div class="form-group">
                    <label for="EventID">活動ID</label>
                    
                    <?php
                        echo ' <input type="text" name="EventID" class="form-control" id="EventID" aria-describedby="eventidHelp" placeholder="Event ID" readonly required value="';
                        function generateRandomString($length = 24) {
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        }
                        $EventID = generateRandomString();
                        echo $EventID;
                        echo '"> ';

                        echo '<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=';
                        echo "https://chanyu.info/real-name-submit/public/info-submit/index.php?EventID=". $EventID;
                        echo '&choe=UTF-8" class="img-fluid" alt="Responsive image">';
                    ?>

                    <small id="eventidHelp" class="form-text text-muted">此ID為唯一性，僅提供予該活動。</small>
                </div>
                <div class="form-group">
                    <label for="EventName">活動名稱</label>
                    <input type="text" name="EventName" class="form-control " id="EventName" aria-describedby="eventnameHelp" placeholder="Event Name" required>
                    <small id="eventnameHelp" class="form-text text-muted">參訪民眾將透過此名稱辨識活動。</small>
                </div>
                
                <div class="form-group">
                    <label for="EventLastTime">活動最後進場時間</label>
                    <div class="">
                        <input type="datetime-local" name="EventLastTime" required>
                    </div>
                    <small id="eventnameHelp" class="form-text text-muted">設定活動截止時間，民眾填表服務將阻止活動進場登記。</small>

                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Creater StaffAccount</label>
                    <?php
                        echo '<input type="text" Name="StaffAccount" class="form-control" id="StaffAccount" placeholder="Account" required readonly value="';
                        echo $StaffAccount = $_COOKIE["StaffAccount"];
                        echo '"> ';
                    ?>
                    <small id="StaffAccount" class="form-text text-muted">此為系統添加，請勿更改。</small>
                </div>
                <button type="submit" class="btn btn-primary">註冊建立活動</button>
            </form>



        </div>


        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>

</HTML>