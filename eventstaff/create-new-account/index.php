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

        <div class="container">
            <div class="row align-items-center">
                <div class="col"></div>
                <div class="col-8">
                    <h2 class="text-center mt-5">註冊新帳號</h2>
                    <h5 class="text-center mb-3">成為活動人員STAFF</h5>
                

                    <form  class="form-signin" method="POST" action="./account-create.php">
                        <div class="form-group row">
                            <label for="inputAccount" class="col-sm-3 col-form-label mt-4">設定帳號: </label>
                            <div class="col-sm-9">
                                <input type="text" name="StaffAccount" class="form-control mt-4" id="inputAccount" placeholder="Account" required autofocus>
                                <small id="inputAccountHelp" class="form-text text-muted">設定您的帳號，登入時需使用此帳號，請熟記。</small>
                            </div>
                            <label for="inputPassword" class="col-sm-3 col-form-label mt-4">設定密碼: </label>
                            <div class="col-sm-9">
                                <input type="password" name="StaffPassword" class="form-control mt-4" id="inputPassword1" placeholder="Password" minlength="8" required>
                                <small id="inputPasswordHelp" class="form-text text-muted">請設置8字元以上之密碼，登入時需使用此密碼，請熟記。</small>
                            </div>
                            <label for="inputEmail" class="col-sm-3 col-form-label mt-4">Email: </label>
                            <div class="col-sm-9">
                                <input type="email" name="StaffEmail" class="form-control mt-4" id="inputEmail" placeholder="Email" required>
                                <small id="inputEmailHelp" class="form-text text-muted">作為辨識使用者的身分使用，請使用可收發信件的電子郵件地址，如有問題請藉由此Email地址與網站開發者聯繫。</small>
                            </div>
                            <label for="inputIP" class="col-sm-3 col-form-label mt-4">註冊IP: </label>
                            <div class="col-sm-9">
                                <?php
                                    $GetIP = $_SERVER["REMOTE_ADDR"];
                                    echo '<input type="text" name="StaffIP" class="form-control mt-4" id="inputIP" placeholder="IP位址" value="';
                                    echo $GetIP;
                                    echo '" readonly required>'
                                ?>
                                
                                <small id="inputPasswordHelp" class="form-text text-muted">防止惡意註冊使用，您仍可與任何地點登入使用。</small>
                            </div>
                            <div class="col-sm-12 mt-5 mb-3">
                                <div class="row">
                                    <button type="submit" class="col-sm-8 btn btn-primary">註冊帳號</button>
                                    <button type="reset" class="col-sm-4 btn btn-secondary">重新填寫</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col"></div>
            </div>
        </div>

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
