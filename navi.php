<?php
session_start(); // 세션오픈

//db연결
$connect = mysqli_connect("", "", "","");
$query = "SELECT * FROM hospital ORDER BY id DESC";
$result = mysqli_query($connect, $query);


//page 번호 설정
$pageNum = 5;
$pageTotal = mysqli_num_rows($result);
$start = isset($_GET['start']) && $_GET['start'] ? $_GET['start']:0; //1인데 0으로 수정 페이지 1개씩 빠져서
$query = "SELECT * FROM hospital ORDER BY id DESC limit $start, $pageNum";
$result = mysqli_query($connect, $query);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>병원정보확인페이지</title>
        <link rel="stylesheet" type="text/css" href="./css/navi.css">
        <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
        </style>
    </head>
    <body>
        <header>
            <h1><a href="index.php">
              <?php
                echo "<img src='./img/signal.png' alt='home' id='img1'>";
              ?>응급 구조 통합 플랫폼</a></h1>
            <div id="menu">
                <ul>
                    <li><a href="navi.php">내비게이션</a></li>
                    <li><a href="paientInfo.php">환자정보입력</a></li>
                    <li style="float:right"><a class="active" href="logoutem.php">로그아웃</a></li>
                </ul>
            </div>
        </header>

          <section class="page" id="first" style="background-color: #66b07a; margin-top: -1%; height: 400px;"><br>
              <p id="tit"><병원 정보 확인></p><br>
              <table id="info" text-align="center">
                  <tr>
                      <th>번호</th>
                      <th>병원 이름</th>
                      <th>남은 병상 수</th>
                      <th>총 병상 수</th>
                      <th>진료 가능 목록</th>
                      <th>출발 시간</th>
                  </tr>
                  <?php
                  while($row=mysqli_fetch_array($result))
                  {
                  ?>
                    <tr>
                      <td><?php echo $row["id"]; ?></td>
                      <td><?php echo $row["hospital_name"]; ?></td>
                      <td><?php echo $row["remaining_bed"]; ?></td>
                      <td><?php echo $row["total_bed"]; ?></td>
                      <td><?php echo $row["department"]; ?></td>
                      <td><?php echo $row["date"]; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
          </section><br>
          <center>
              <section class="page" id="second" style="background-color: #ffffff;  position:absolute; bottom:0; width:100%; height:150px; margin-bottom:0px;">
                  <div class="row">
                      <div class="column">
                          <a href="https://apis.openapi.sk.com/tmap/app/routes?appKey=4dda6d6d-8659-4ec3-a1ea-4c0e5d2e97e7&name=고려대학교구로병원&lon=126.884841&lat=37.492356">
                          <button class="butoon"><span>고려대구로병원 내비 길 안내</span></button></a>
                          <p></p>
                      </div>

                      <div class="column">
                          <a href="https://apis.openapi.sk.com/tmap/app/routes?appKey=4dda6d6d-8659-4ec3-a1ea-4c0e5d2e97e7&name=이대목동병원&lon=126.886221&lat=37.536560">
                          <button class="button"><span>이화여대병원&nbsp;&nbsp; 내비 길 안내</span></button></a>
                          <p></p>
                      </div>
                  </div>
              </section>
          </center>
    </body>
</html>
