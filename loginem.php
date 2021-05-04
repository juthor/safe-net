<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./css/login_renew.css">
        <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    </style>
    </head>
    <body>
        <header>
            <h1><a href="index.php">
              <?php
              echo "<img src='./img/signal.png' alt='home' id='img1'>";
              ?>
            응급 구조 통합 플랫폼 로그인</a></h1>
        </header>
        <section>
          <?php
            if(!isset($_SESSION['id'])) { // 로그인 하지 않았다면
          ?>
            <form name="login_form" action="login_check_em.php" method="post">
                <div class="container"><br>
                    <div class="id_area">
                    <label for="id"><b>아이디</b></label><br>
                    <input type="text" placeholder="아이디를 적으세요" name="id" required>
                    </div><br>

                    <lable for="password"><b>비밀번호</b></lable><br>
                    <input type="password" placeholder="비밀번호를 적으세요" name="password" required><br>

                    <button type="submit">로그인</button><br>
                    <label>
                        <input type="checkbox" class="Largercheckbox" checked="checked" name="remember" style="size: 30px">계정 저장하기
                    </label>
                </div>

                <div class="container2">
                    <div class="psw" style="font-size: 20px">비밀번호를 잊으셨나요? <a href="https://accounts.google.com/signin/usernamerecovery?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F%3Ftab%3Dwm0%26ogbl&service=mail&scc=1&rm=false&osid=1&hl=ko" target="_blank">
                        <b>여기를 누르세요.</b></a></div>
                </div>
            </form>
            <?php
            }else{ // 로그인 했다면, 로그인 상태로 재진입
              if ($_SESSION['id']=='emworker')
              {
                echo "<script>location.href='paientInfo.php';</script>";
              }
            }
            ?>
        </section>
        <footer>
            <div id="images">
            <a href="https://mokdong.eumc.ac.kr/medical/dept/centerIntro.do?dept_cd=rr"  alt="병원페이지로 이동"  target="_blank">
              <?php
              echo "<img src='./img/ewha.JPG' alt='rescue' id='rescue'>";
              ?>
            </a>

            <a href="http://guro.kumc.or.kr/department/treatDeptDesc01.do?DP_CODE=GREMC" alt="병원페이지로 이동" target="_blank">
              <?php
               echo "<img src='./img/gurhos.JPG' alt='rescue' id='rescue'>";
              ?>
           </a>

            <a href="http://www.smpa.go.kr/home/homeIndex.do?menuCode=gr" alt="서울구로경찰서페이지로 이동" target="_blank">
              <?php
                echo "<img src='./img/guropol.JPG'>";
              ?>
            </a>

            <a href="https://fire.seoul.go.kr/guro/main/main.do" alt="구로소방서페이지로 이동" target="_blank">
              <?php
              echo "<img src='./img/gurofi.JPG' alt='rescue' id='rescue'>";
              ?>
            </a>
            </div>
        </footer>
    </body>
</html>
