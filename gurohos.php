<?php
session_start(); // 세션오픈
if(!isset($_SESSION['id'])){  // 로그인 하지 않았다면, index에서 로그아웃 한다면 바로 login페이지로 갈 수 있도록 설정
  echo "<script>location.href='login.php';</script>";
}

//db연결
$connect = mysqli_connect("", "", "","");
$query = "SELECT * FROM newrescueteam ORDER BY id DESC";
$result = mysqli_query($connect, $query);


//page 번호 설정
$pageNum = 5;
$pageTotal = mysqli_num_rows($result);
$start = isset($_GET['start']) && $_GET['start'] ? $_GET['start']:0; //1인데 0으로 수정 페이지 1개씩 빠져서
$query = "SELECT * FROM newrescueteam ORDER BY id DESC limit $start, $pageNum";
$result = mysqli_query($connect, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구로병원전용 환자 상해 확인 페이지</title>
    <link rel="stylesheet" type="text/css" href="./css/logoandmenustyle.css">
    <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    <script type="text/javascript">
  <!--
      var today = new Date();
      var strTime = "<H4>현재 시간은 ";
      strTime += today.getHours()+"시 ";
      strTime += today.getMinutes()+"분 "
      strTime += today.getSeconds()+"초. "
      setTimeout("location.reload()",30000)
  //-->
  </script>
</head>
<body>
    <header>
        <h1><a href="index.php">
          <?php
            echo "<img src='./img/signal.png' alt='home' id='img1'>";
          ?>응급 구조 통합 플랫폼 - 구로병원 전용</a></h1>
          <div style="text-align:right; font-size:24px;">
            <script>document.write(strTime);</script>
          </div>
        <div id="menu">
                <ul>
                    <li><a href="hospitalinfo.php">병원정보입력</a></li>
                    <li><a href="gurohos.php">구로고려대학병원 전용</a></li>
                    <li style="float:right"><a class="active" href="logout.php">로그아웃</a></li>
                </ul>
            </div>
    </header>
    <section style="background-color: #66b07a; margin-top: -1%;"><br>
        <p style="text-align: center; font-size: 28px; font-weight:bold; color: #222;"><환자 상해 확인></p><br>

        <div class="talbe-responsive">
        <!-- 추가 버튼-->
        <br>
        <table id="info" align="center">
            <tr>
                <th>번호</th>
                <th>추정 연령</th>
                <th>성별</th>
                <th>체온</th>
                <th>의식여부</th>
                <th>환자정보</th>
                <th>출발 시간</th>
                <th>Vital<br>sign</th>
            </tr>
            <?php
            while($row=mysqli_fetch_array($result))
            {
            ?>
            <?php
              if($row["target"]=="gurohospital")
              {
              ?>
              <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["age"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
                <td><?php echo $row["temper"]; ?></td>
                <td><?php echo $row["coma"]; ?></td>
                <td>
                  <details>
                    <summary>확인하기(클릭)</summary>
                    <p>
                      <?php echo $row["info"];?>
                    </p>
                  </details>
                </td>
                <td><?php echo $row["date"]; ?></td>
                <td><a href="https://thingspeak.com/channels/895827/private_show"><button class="button"><span>산소포화도<br>심박수확인</span></button></a></td>
              </tr>
              <?php
              }
              ?>
            <?php
            }
            ?>
        </table>
        </div>
        <center>
                <?php
                $pages = ceil($pageTotal / $pageNum);
                for($i=0; $i<$pages; $i++){
                  $nextPage = $pageNum * $i;
                  $i=$i+1;
                  echo "<a href=$_SERVER[PHP_SELF]?start=$nextPage>[$i]</a>";
                  $i=$i-1;
                }
                ?>
            </center>

    </section>
</body>
</html>
