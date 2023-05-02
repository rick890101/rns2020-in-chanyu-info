<HTML>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <title>民眾資訊提交 #民眾端 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
    </head>

    <body>
        <!-- NAV導覽列 -->
        <nav class="navbar sticky-top navbar-light" style="background-color: #57FF54">
            <a class="navbar-brand" href="../">防疫實名登記系統 # 民眾端</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link active" href="./">主頁 <span class="sr-only">(current)</span></a>
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

        <?php
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
            <div class="mt-5">
                <div class="row align-items-center">
                <div class="col"></div>
                <div class="col-8">

                    <?php
                        date_default_timezone_set('Asia/Taipei');
                        $EventID = $_REQUEST["EventID"];
                        $EventName = $_REQUEST["EventName"];
                        $peopleName = $_REQUEST["peopleName"];
                        $peoplePhone = $_REQUEST["peoplePhone"];
                        $peopleIDnum = $_REQUEST["peopleIDnum"];
                        $peopleEmail = $_REQUEST["peopleEmail"];
                        $peopleSay = $_REQUEST["peopleSay"];
                        $SubmitFrom = $_SERVER["REMOTE_ADDR"];
                        $NowTime = date("Y-m-d H:i:s");
                        if($EventID==""){
                            header("Location: ../index.php?eid=404"); 
                            exit;
                        }
                        # MySQL/MariaDB 指令
                        $sqlQuery = " INSERT INTO dbFE_PeopleInfo(EventID,Name,Phone,PeopleIDnum,Email,Saying,SubmitFrom) VALUES('$EventID','$peopleName','$peoplePhone','$peopleIDnum','$peopleEmail','$peopleSay','$SubmitFrom'); ";
                        # 執行 MySQL/MariaDB 指令
                        if ($result = $connection->query($sqlQuery)) {
                    ?>
                    <div class="card" style="width: auto">
                        <div class="card-body">
                            <h3 class="card-title text-center"><strong><ion-icon name="checkmark-circle-outline" size="large"></ion-icon></br>您已提交完成！</strong></h3>
                            <div class="card-text mt-3 mb-3">
                            <?php
                                echo "活動： $EventName ($EventID)</p>";
                                echo "您的姓名： $peopleName</p>";
                                echo "您的電話： $peoplePhone</p>";
                                echo "您的身分證字號： $peopleIDnum</p>";
                                echo "您的Email： $peopleEmail</p>";
                                echo "您的備註： $peopleSay</p>";
                                echo "提交IP資訊： $SubmitFrom</br><small class=" . "text-info" . ">提交IP目的為防止惡意登記使用，無須擔心。</small></p>";
                                echo "提交時間： $NowTime</p>";
                            ?>
                            </div>
                            <a class="btn btn-primary btn-block" href="../" role="button">完成</a>
                        </div>
                    </div>

                    </div>
                <div class="col"></div>
            </div>
        </div>
        <?php
            } else {
            echo "執行失敗：" . $connection->error;
            }
            # 關閉 MySQL/MariaDB 連線
            $connection->close();
        ?>

        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>

</HTML>