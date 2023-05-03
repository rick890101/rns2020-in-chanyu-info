<?php error_reporting(E_ALL&~E_WARNING); ?>
<HTML>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>#民眾端 防疫實名登記系統｜蟾蜍共和國Project #STUST #csie109</title>
</head>

<body>
    <!-- NAV導覽列 -->
    <nav class="navbar sticky-top navbar-light" style="background-color: #57FF54">
        <a class="navbar-brand" href="../">防疫實名登記系統 # 民眾端</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">STUST CSIE 109-1 《資料庫系統》
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row align-items-center">
            <div class="col"></div>
            <div class="col-8">

                <?php
                    $eid = $_REQUEST["eid"];
                    $erroreventid = $_REQUEST["erroreventid"];
                    $endtime = $_REQUEST["endtime"];

                    if( $eid == "404" ){
                        echo ' <div class="alert alert-danger text-center mt-3 mb-1" role="alert"> ';
                        echo "錯誤碼: $eid ，找不到該活動ID，請重新確認。</br>[ $erroreventid ]";
                        echo ' </div> ';
                    }
                    if( $eid == "out-of-time" ){
                        echo ' <div class="alert alert-danger text-center mt-3 mb-1" role="alert"> ';
                        echo "錯誤碼: $eid ，該活動已經結束了。</br>";
                        echo ' </div> ';
                    }
                ?>

                <div class="card text-center mt-3 mb-3" style="width: auto;">
                    <div class="card-body ">
                        <ion-icon name="keypad-sharp" size="large"></ion-icon>
                        <h2 class="card-title mt-3">手動填入活動ID</h2>
                        <p class="card-text mt-3 mb-3">若您方便手動填寫，請選擇此項。</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entereventid">
                            輸入活動ID
                        </button>
                    </div>
                </div>

                <div class="card text-center mt-3 mb-3" style="width: auto;">
                    <div class="card-body ">
                        <ion-icon name="qr-code-outline" size="large"></ion-icon>
                        <h2 class="card-title mt-3">
                            <ion-icon name="warning-outline" size="small"></ion-icon>掃描活動QRcord<ion-icon
                                name="warning-outline" size="small"></ion-icon>
                        </h2>
                        <p class="card-text mt-3 mb-3">可透過活動提供之QRcord取得活動ID，快速進行填寫。</p>
                        <button type="button" class="btn btn-primary" disabled data-toggle="modal"
                            data-target="#exampleModalCenter">功能測試中，尚未開放</button>
                    </div>
                </div>

            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="modal fade" id="entereventid" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">輸入活動ID</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="./info-submit/index.php">
                        <div class="form-group row">
                            <label for="EventID" class="col-sm-4 col-form-label">活動ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="EventID" name="EventID" minlength="24"
                                    maxlength="24" placeholder="ID長為24字元" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3 mb-1">下一步</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> <!-- https://ionicons.com/ SVG圖示圖標 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</body>

</HTML>