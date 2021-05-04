<?php
session_start(); // 세션오픈

//db연결
$connect = mysqli_connect("", "", "","");
$query = "SELECT * FROM hospital ORDER BY id DESC";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="./css/finalmain.css">
    <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    </style>
</head>
<body>
    <header>
        <h1><a href="index.php">
          <?php
            echo "<img src='./img/signal.png' alt='home' id='img1'>";
          ?>
          응급 구조 통합 플랫폼</a></h1>
        <div id="menu">
                <ul>
                    <li><a href="#top">병원</a></li>
                    <li><a href="#top">구급대</a></li>
                    <li><a href="#hospitalinfo">병원 정보</a></li>
                    <li><a href="#Data1">교통</a></li>
                    <li><a href="#Data2">화재</a></li>
                </ul>
            </div>
    </header>
    <section>
        <div class="split left" id="hospital">
            <div class="centered">
              <?php
                echo "<img src='./img/iconfinder_126-man-doctor.png' alt='hospital' id='hospital'>";
              ?>
                <h2>병원 전용</h2>
                <p>병원의 총 병상 수,잔여 병상 수, 진료 가능 과목을 입력하고 환자 발생 시 상해 정보를 확인할 수 있습니다.</p>
                <a href="hospitalinfo.php"><button class="button"><span>병원 정보 입력 </span></button></a>
                <a href="loginpai.php"><button class="button"><span>환자 상해 확인 </span></button></a>
            </div>
        </div>

        <div class="split right" id="rescue">
            <div class="centered">
              <?php
                echo "<img src='./img/iconfinder_156-woman.png' alt='rescue' id='rescue'>";
              ?>
                <h2>구급대 전용</h2>
                <p>환자 발생 시 상해 정보를 입력하고 내비게이션을 통해 환자에게 적합한 최단거리의 병원을 선택할 수 있습니다.</p>
                <a href="navi.php"><button class="button"><span>Navigation </span></button></a>
                <a href="paientInfo.php" id="hospitalinfo"><button class="button"><span>환자 정보 입력 </span></button></a>
            </div>
        </div>

    </section>

    <div class="section2"><br>
      <h2 style="text-align: center; font-family: 나눔고딕 Extra Bold;"><병원 정보 확인></h2><br>
      <table id="info">
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
            <tr><a id="Data1"></a>
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
      </table>

    </div>


    <footer>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart1);
            function drawChart1() {
                var data = google.visualization.arrayToDataTable([
                    ['week', 'percent per week'],
                    ['Mon', 5],
                    ['Tue', 8],
                    ['Wed', 6],
                    ['Thu', 5],
                    ['Fri', 4],
                    ['Sat', 3],
                    ['Sun', 3]
                  ]);

                  var options = {
                    title: '요일별',
                    pieHole: 0.3,

                  };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
                  chart.draw(data, options);
                }

                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart2);
                function drawChart2(){
                  var data = google.visualization.arrayToDataTable([
                      ['Dong', 'percent per Dong'],
                      ['가리봉', 2],
                      ['고척', 2],
                      ['구로', 9],
                      ['개봉', 9],
                      ['궁', 1],
                      ['신도림', 1],
                      ['오류', 9],
                      ['천왕', 1]
                  ]);
                  var options = {
                      title: '구로시 동별',
                      pieHole: 0.3,
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
                  chart.draw(data, options);
                }
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart3);
                function drawChart3(){
                var data = google.visualization.arrayToDataTable([
                    ['Time', 'percent per time period'],
                    ['0~3AM', 6],
                    ['3~6AM', 4],
                    ['6~9AM', 4],
                    ['9~12AM', 3],
                    ['12~15PM', 1],
                    ['15~18PM', 6],
                    ['18~21PM', 6],
                    ['21~24PM', 4]
                ]);

                var options = {
                    title: '시간',
                    pieHole: 0.3,
                };
                var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
                chart.draw(data, options);
                }
                $(window).resize(function(){
                drawChart1();
                drawChart2();
                drawChart3()
                });


    </script>
    <h2 style="text-align:center;">교통 사고 통계 chart (2016~2018)</h2>
        <div class="row" >
            <div class="column">
                <div id="donutchart1" class="chart"></div>
            </div>
            <div class="column">
                <div id="donutchart2" class="chart"></div>
            </div>
            <div class="column">
                <div id="donutchart3" class="chart"></div>
            </div>
        </div>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart4);
            function drawChart4() {
              var data = google.visualization.arrayToDataTable([
                ['day','number'],
                ['Mon', 114],
                ['Tue', 118],
                ['Wed', 121],
                ['Thu', 97],
                ['Fri', 103],
                ['Sat', 103],
                ['Sun', 114]
              ]);

              var options = {
                title: '요일별',
                pieHole: 0.3,
              };

              var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
              chart.draw(data, options);
            }

            google.charts.setOnLoadCallback(drawChart5);
      function drawChart5() {
        var data = google.visualization.arrayToDataTable([
          ['Dong','number'],
          ['GaRiBong', 54],
          ['Gae-Bong', 112],
          ['Go-Chuck', 90],
          ['Gu-Ro', 331],
          ['Gung', 35],
          ['SinDoRim', 49],
          ['Oh-Ryu', 63],
          ['On-Su', 16],
          ['Chun-Wang', 11],
          ['Hang', 8]
        ]);

        var options = {
          title: '구로시 동별',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart5'));
        chart.draw(data, options);
      }
      google.charts.setOnLoadCallback(drawChart6);
      function drawChart6() {
        var data = google.visualization.arrayToDataTable([
          ['Time','percent per time period'],
          ['0~3AM', 87],
          ['3~6AM', 48],
          ['6~9AM', 54],
          ['9~12AM', 118],
          ['12~15PM', 125],
          ['15~18PM', 120],
          ['18~21PM', 134],
          ['21~24PM', 95]
        ]);

        var options = {
          title: '시간',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart6'));
        chart.draw(data, options);
      }
      $(window).resize(function(){
        drawChart4();
        drawChart5();
        drawChart6();
        });
          </script>

    <h2 style="text-align: center; margin-top: 3%;">화재 사고 통계 chart (2016~2018)</h2>
    <div class="row" id="Data2">
        <div class="column">
            <div id="donutchart4" class="chart"></div>
        </div>
        <div class="column">
            <div id="donutchart5" class="chart"></div>
        </div>
        <div class="column">
            <div id="donutchart6" class="chart"></div>
        </div>
    </div>


    </footer>

</body>
</html>
