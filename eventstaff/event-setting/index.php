<HTML>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>查看現有活動登錄 #活動人員STAFF 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
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

        <?php
            $server = "localhost";          # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";      # 使用者帳號
            $dbpassword = "i5tpsLQD8j";     # 使用者密碼
            $dbname = "u683395981_MyMainSQL";          # 資料庫名稱

            $StaffAccount = $_REQUEST["StaffAccount"];
            $StaffPassword = $_REQUEST["StaffPassword"];

            // 登入處理服務
            if( $StaffAccount=="" || $StaffPassword=="" ){
                header("Location: ../index.php?eid=clear"); 
                exit;
            }


            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            # 檢查連線是否成功
            if ($connection->connect_error) {
            die("連線失敗：" . $connection->connect_error);
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

        <div class="container">
            <!-- NAV功能導覽列 -->
            <ul class="nav nav-pills nav-fill mt-2">
                <li class="nav-item">
                    <a class="nav-link active">查看現有活動登錄</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../create-new-event">建立新活動</a>
                </li>
            </ul>

            <div class="mt-5">

            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">活動名稱 # 活動ID</label>
                    <select class="custom-select" onChange="EventView(this.value)">
                        
                        <?php
                            # MySQL/MariaDB 指令
                            $sqlQuery = " SELECT EventName, EventID FROM dbFE_EventCreate WHERE BINARY StaffAccount='$StaffAccount' " ;
                            # 執行 MySQL/MariaDB 指令
                            if ($result = $connection->query($sqlQuery)) {
                                # 取得結果
                                echo "<option selected value="."0".">----". "共有 ".mysqli_num_rows($result)." 項活動，請選擇活動----</option>";
                                //取得欄位數
                                $total_fields = mysqli_num_fields($result);
                                //顯示欄位名稱
                                //顯示記錄
                                while( $row = $result->fetch_row() ) {
                                    echo "<option value=".$row[1].">";
                                    for( $i=0 ; $i<$total_fields ; $i++ ) {
                                        echo "$row[$i]";
                                        if( $i != ($total_fields-1) ){
                                            echo " # ";
                                        }
                                    }
                                    echo "</option>";
                                }
                                // 清空關閉
                                $result->close();
                            }
                            else {
                                echo "執行失敗：" .$connection->error;
                            }
                            # 關閉 MySQL/MariaDB 連線
                            $connection->close();
                        ?>
                    </select>
                    <small id="eventidHelp" class="form-text text-muted">選擇活動，以進行活動讀取。</small>
                </div>
            </form>
            
            <script type="text/javascript">
                function EventView(id){
                    if ( id!=0 ) {
                        id = './event-view.php?eventid='+id;
                        window.open (id, 'newwindow', 'height=800, width=1205, top=20, left=50, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no,status=no');
                    }
                }
            </script>

        </div>

        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>

</HTML>