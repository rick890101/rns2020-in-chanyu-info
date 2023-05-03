<HTML>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <title>查看活動登錄 @ 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
    </head>

    <body>
        <nav class="navbar sticky-top navbar-light" style="background-color: #FF8698">
            <a class="navbar-brand" href="../">查看實名活動登錄 [活動人員STAFF 查詢中]</a>
            <button class="navbar-toggler" type="button" aria-controls="navbarTogglerDemo02" aria-expanded="false" onClick="window.close();">
                <i class="bi bi-x-square"></i>
            </button>
        </nav>

        <div class="container">
        <?php
            $server = "localhost";          # MySQL/MariaDB 伺服器
            $dbuser = "u683395981_RealNameEvent";      # 使用者帳號
            $dbpassword = "i5tpsLQD8j";     # 使用者密碼
            $dbname = "u683395981_MyMainSQL";          # 資料庫名稱

            date_default_timezone_set('Asia/Taipei');
            $StaffAccount = $_COOKIE["StaffAccount"];
            $StaffPassword = $_COOKIE["StaffPassword"];
            $EventID = $_REQUEST["eventid"];
            $NowTime = date("Y-m-d H:i:s");

            // 登入處理服務
            if( $StaffAccount=="" || $StaffPassword=="" ){
                echo '<script>alert("您的登入已逾時，請重新登入再進行查詢！")</script>'; 
                echo '<script>window.close()</script>';
                exit;
            }
            # 連接 MySQL/MariaDB 資料庫
            $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
            $connection->query("SET NAMES utf8");
            $connection->query("SET time_zone='+08:00'");
            # 檢查連線是否成功
            if ($connection->connect_error) {
                die("連線失敗：" . $connection->connect_error);
            }

            # 檢查帳號等級 MySQL/MariaDB 指令
            $sqlQuery = " SELECT Level FROM dbFE_EventStaff WHERE BINARY account='$StaffAccount' ";
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {
                while( $row = $result->fetch_row() ) {
                    if( $row[0]<10 ){
                        echo "<script>alert('帳號等級過低，此功能無法使用。請聯繫網站開發者。');</script>";
                        echo '<script>window.close()</script>';
                        exit;
                    }
                }
            }
            else {
                echo "執行失敗：" . $connection->error;
                exit;
            }

            # MySQL/MariaDB 指令
            $sqlQuery = " SELECT EventID,EventName,EnterLastTime FROM dbFE_EventCreate WHERE BINARY EventID='$EventID' " ;
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {
                while( $row = $result->fetch_row() ) {
                    echo '<h3 class="text-center mt-3 mb-5">';
                    echo "$row[1] - $EventID";
                    echo '</h3>';

        ?>

        <form class="">
            <div class="form-group row">
                <label for="EventURL" class="col-sm-3 col-form-label">活動連結網址: </label>
                <div class="col-sm-8">
                    <?php
                        # 生成活動連結網址
                        echo '<input type="text" class="form-control" id="EventURL" name="EventURL" value="';
                        $EventURL = "https://chanyu.info/real-name-submit/public/info-submit/index.php?EventID=".$EventID;
                        echo "$EventURL";
                        echo '" readonly>';
                    ?>
                </div>
                <div class="col-sm-1">
                    <?php
                        # 一鍵複製
                        echo '<button type="button" class="copy btn btn-secondary" data-clipboard-target="#EventURL" onClick="copysuccess()"><ion-icon name="clipboard-outline"></ion-icon></button>';
                    ?>
                </div>
                <label for="EventQRcord" class="col-sm-4 col-form-label">活動快速QRcord: </label>
                <div class="col-sm-8">
                    <?php
                        # 生成活動QRcord
                        echo '<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=';
                        echo $EventURL;
                        echo '&choe=UTF-8" class="img-fluid" alt="Responsive image">';
                    ?>
                </div>
            </div>
        </form>

        <?php
                    # 活動最後進場時間提示窗
                    $EventLastTime = strtotime($row[2]);
                    $NowTime = strtotime($NowTime);
                    if( $NowTime < $EventLastTime ){
                        echo '<div class="alert alert-success" role="alert">';
                        echo "活動最後入場時間：$row[2]，";
                        echo "活動進行中！";
                    }else{
                        echo '<div class="alert alert-danger " role="alert">';
                        echo "活動最後入場時間：$row[2]，";
                        echo "活動已結束，依據主管機關規定防疫資料將於儲存 28 天後刪除。";
                    }
                    echo '</div>';
                }
            }else {
                echo "執行失敗：" .$connection->error;
            }

            # MySQL/MariaDB 指令
            $sqlQuery = "  SELECT Name AS 姓名 , Phone AS 手機號碼 , PeopleIDnum AS 身分證字號 , Email , Saying AS 備註 , SubmitTime AS 提交時間 , SubmitFrom AS 提交IP FROM dbFE_PeopleInfo WHERE BINARY EventID='$EventID' ORDER BY SubmitTime ASC; " ;
            
            # 執行 MySQL/MariaDB 指令
            if ($result = $connection->query($sqlQuery)) {
                //取得欄位數
                $total_fields = mysqli_num_fields($result);
        ?>
        
            <div class="alert alert-info" role="alert">
                <?php
                    echo "共有 ".mysqli_num_rows($result)." 條登錄。";
                ?>
            </div>
            

                <table class="table">
                    <?php
                        //顯示欄位名稱
                        echo '<thead>';
                        for( $i=0 ; $i<$total_fields ; ++$i ) 
                        {
                            $field_info = mysqli_fetch_field_direct($result, $i);
                            echo "<th>" .$field_info->name. "</th>";
                        }
                        echo "</thead>";
                        //顯示記錄
                        while( $row = $result->fetch_row() )
                        {
                            echo "<tr>";
                            for( $i=0 ; $i<$total_fields ; $i++ ) {
                                echo "<td>$row[$i]</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
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






        <script>
            function copysuccess(){
                alert("活動網址已複製");
            }
        </script>


        <script src="https://rawcdn.githack.com/zenorocha/clipboard.js/v2.0.6/dist/clipboard.min.js"></script> <!-- https://clipboardjs.com/ -->
        <script type="text/javascript">new ClipboardJS('.copy');</script>

        <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</HTML>