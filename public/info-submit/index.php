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
                        <a class="nav-link" href="./">主頁</a>
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

        <?php
            $server = "localhost";          # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";      # 使用者帳號
            $dbpassword = "i5tpsLQD8j";     # 使用者密碼
            $dbname = "u683395981_MyMainSQL";          # 資料庫名稱

            $EventID = $_GET["EventID"];
            date_default_timezone_set('Asia/Taipei');
            $NowTime = strtotime(date("Y-m-d H:i:s"));

            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            # 檢查連線是否成功
            if ($connection->connect_error) {
            die("連線失敗：" . $connection->connect_error);
            }

            # MySQL/MariaDB 指令
            $sqlQuery = " SELECT EventID,EventName,EnterLastTime FROM dbFE_EventCreate WHERE BINARY EventID='$EventID' ";
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {
                if ( mysqli_num_rows($result) == 0 ){
                    header("Location: ../index.php?eid=404&erroreventid=$EventID"); 
                    exit;
                }elseif( mysqli_num_rows($result) != 1 ){
                    header("Location: ../index.php?eid=unknown"); 
                    exit;
                }elseif( mysqli_num_rows($result) == 1 ){
                    while ($row = mysqli_fetch_row($result)) {
                        $EventName = $row[1];
                        $EnterLastTime = $row[2];
                        $LastTime = strtotime($EnterLastTime);
                    }
                    if( $NowTime>$LastTime ){
                        header("Location: ../index.php?eid=out-of-time&endtime=$EnterLastTime"); 
                        exit;
                    }
                    setcookie( "EventID", $EventID, time()+600);
                    setcookie( "EventName", $EventName, time()+600);
                }
        ?>

        <div class="container">
            <div class="row align-items-center">
            <div class="col"></div>
            <div class="col-8">

                <h2 class="text-center mt-5 mb-4"><ion-icon name="keypad-sharp" size="large"></ion-icon>民眾資訊提交</h2>
                <form>
                    <div class="form-group row">
                        <label for="EventID" class="col-sm-3 col-form-label mt-2">活動ID</label>
                        <div class="col-sm-9 mt-2">
                            <input type="text" class="form-control" id="EventID" maxlength="24" placeholder="ID長為24字元"
                            <?php
                                echo 'value="';
                                echo $EventID;
                                echo '"';
                            ?> 
                            readonly required>
                        </div>
                        <label for="EventName" class="col-sm-3 col-form-label mt-2">活動名稱</label>
                        <div class="col-sm-9 mt-2">
                            <input type="text" class="form-control" id="EventName" 
                            <?php
                                echo 'value="';
                                echo $EventName;
                                echo '"';
                            ?> 
                            readonly required>
                        </div>
                    </div>
                    <a class="d-flex flex-row-reverse" href="../"><span class="badge badge-pill badge-secondary">不是這個活動？重新輸入</span></a>
                </form>
                <form method="POST" action="./submit-program.php">
                    <div class="form-group row">
                        <label for="PeopleName" class="col-sm-3 col-form-label mt-2"><code class="text-danger">* </code>您的姓名: </label>
                        <div class="col-sm-9 mt-2">
                            <input type="text" class="form-control" id="PeopleName" name="peopleName" maxlength="24" placeholder="範例：王小明" required>
                        </div>

                        <label for="Peoplephone" class="col-sm-3 col-form-label mt-2"><code class="text-danger">* </code>您的電話: </label>
                        <div class="col-sm-9 mt-2">
                            <input type="text" class="form-control" id="Peoplephone" name="peoplePhone" maxlength="10" placeholder="範例：0912345678" required>
                        </div>

                        <label for="PeopleIDnum" class="col-sm-5 col-form-label mt-2"><code class="text-danger">* </code>您的身分證字號: </label>
                        <div class="col-sm-7 mt-2">
                            <input type="text" class="form-control" id="PeopleIDnum" name="peopleIDnum" maxlength="10" placeholder="範例：A223456789" required>
                        </div>

                        <label for="PeopleEmail" class="col-sm-5 col-form-label mt-2"><code class="text-danger">* </code>您的Email: </label>
                        <div class="col-sm-7 mt-2">
                            <input type="email" class="form-control" id="PeopleEmail" name="peopleEmail" placeholder="範例：yourdomain@example.com" required>
                        </div>

                        <label for="PeopleSay" class="col-sm-5 col-form-label mt-2">您欲對主辦單位說的話: </label>
                        <div class="col-sm-12 mt-2">
                        <textarea type="text" class="form-control" row="3" id="PeopleSay" name="peopleSay" maxlength="256" placeholder="選填備註區。您可以在此輸入欲對主辦單位說的話。(上限256字)"></textarea>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">提交送出</button>
                </form>

            </div>
            <div class="col"></div>
            </div>
        </div>

        <?php
                // 清空關閉
                $result->close();
            }
            else {
                echo "執行失敗：" .$connection->error;
            }
            # 關閉 MySQL/MariaDB 連線
            $connection->close();
        ?>

        <footer class="text-muted py-5">
                <div class="container">
                    <p class="mb-1 text-center">當您使用本網站，即視同您以瞭解本網站之<a href="" onclick="window.open ('../../user-policies.html', 'newwindow', 'height=600, width=480, top=20, left=800, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no,status=no')">《使用條款》、《Cookie使用告知》</a>。</p>
                </div>
        </footer>



        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>

</HTML>