<?php
session_start(); // 세션오픈

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

  <link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<div class="container">
      <h3 align="center">환자정보확인</h3>
      <br>

      <div class="talbe-responsive">
      <!-- 추가 버튼-->

        <br>
        <div id="board_table">
          <table class="table table-bordered table-hover" style="width:100%;">
            <tr>
              <th>번호</th>
              <th>추정연령</th>
              <th>성별</th>
              <th>이송중 체온</th>
              <th>의식여부</th>
              <th>입력시간</th>
              <th>병원</th>
            </tr>

            <?php
            while($row=mysqli_fetch_array($result))
            {
            ?>
              <tr>
              <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["age"]; ?></td>
              <td><?php echo $row["gender"]; ?></td>
              <td><?php echo $row["temper"]; ?></td>
              <td><?php echo $row["coma"]; ?></td>
              <td><?php echo $row["date"]; ?></td>
              </tr>
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
    </div>
  </div>
