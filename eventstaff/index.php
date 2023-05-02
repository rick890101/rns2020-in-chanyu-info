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
            <!--
            <ul class="nav nav-pills nav-fill mt-2">
                <li class="nav-item">
                    <a class="nav-link" href="./event-setting">現有活動管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./create-new-event">建立新活動</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./faq">疑難排解</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">關於此程式</a>
                </li>
            </ul>
            -->

            <h2 class="text-center mt-3 mb-3"><ion-icon name="lock-closed"></ion-icon></br>登入活動STAFF</h2>

            <?php
                $errorID = ""; $StaffAccount = ""; $StaffPassword = ""; 
                $errorID = $_GET["eid"];
                $StaffAccount = $_REQUEST["StaffAccount"];
                $StaffPassword = $_REQUEST["StaffPassword"];

                if( $errorID == "100" ){
                    echo ' <div class="alert alert-danger" role="alert"> ';
                    echo '帳號或密碼不正確，請重新檢查輸入。';
                    echo ' </div> ';
                }
                if( $errorID == "900" ){
                    echo ' <div class="alert alert-danger" role="alert"> ';
                    echo '完成登出程序，請重新登入。';
                    echo ' </div> ';
                }
                if( $errorID == "clear" ){
                    echo ' <div class="alert alert-danger" role="alert"> ';
                    echo '您的登入已逾時，請重新登入。';
                    echo ' </div> ';
                }

                if( $StaffAccount!="" || $StaffPassword!="" ){
                    header("Location: ./login_program.php"); 
                    exit;
                }


            ?>
            
            <form  class="form-signin" method="POST" action="./login_program.php">
                <div class="form-group">
                    <label for="inputAccount">管理帳號</label>
                    <input type="text" name="StaffAccount" class="form-control" id="inputAccount" placeholder="Account" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputPassword">管理密碼</label>
                    <input type="password" name="StaffPassword" class="form-control" id="inputPassword" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-5">登入</button>
                <div class="d-flex justify-content-center mt-2 mb-5">
                    <a class="badge badge-info" href="./create-new-account">還沒有帳號？註冊STAFF</a>
                </div>
            </form>

            


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