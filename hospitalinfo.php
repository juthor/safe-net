<!--병원정보입력페이지-->

<!--병원 누르면 데이터 보이는 페이지, 아이디-->

<?php

session_start(); // 세션오픈
if(!isset($_SESSION['id'])){  // 로그인 하지 않았다면, index에서 로그아웃 한다면 바로 login페이지로 갈 수 있도록 설정
  echo "<script>location.href='login.php';</script>";
}

  //db연결
  $connect = mysqli_connect("", "", "","");
  $query = "SELECT * FROM hospital ORDER BY id DESC";
  $result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>병원정보입력페이지</title>
        <link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            header{
                width: 100%;
                background-color: white;
            }
            h1{
                font-family: "나눔고딕 ExtraBold";
                font-size: 30px;
                color: #111;
                margin: 10px;
            }
            a{
                text-decoration: none;
                color: black;
            }
            body {
                margin:0 auto;
                font-family: "나눔고딕";
                }

            img{
                margin-right: 10px;
                width: 90px;
                height: 90px;
            }
            #menu ul {
                list-style-type: none;
                margin-top: 10px;
                padding: 0;
                overflow: hidden;
                background-color: #444;
                top: 0;
                width: 100%;
            }

            #menu li {
                float: left;
            }

            #menu li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            #menu li a:hover:not(.active) {
                background-color: #2196F3;
            }

            .active {
                background-color: #f4511e;
            }
            table{
                border-collapse: collapse;
                width: 75%;
                background-color: white;
            }
            table, td, th{
                border: 0.03px solid gray;
                text-align: center;
                height: 50px;
            }
            #info th{
                background-color: #f2f2f2;
            }
            input{
                background-color: #eb8741;
                border-radius: 5px;
                padding: 5px;
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 20px;
                margin: 4px;
                cursor: pointer;
            }
            div.btn input{
                position: absolute;
                left: 13%;
                width:8%
            }
            @media screen and (max-width: 1024px){
                div.btn input{
                    width: 12%;
                }
            }
            @media screen and (max-width: 768px){
                div.btn input{
                    width: 15%;
                }
            }
        </style>
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
              ?>응급 구조 통합 플랫폼</a></h1><br>
              <div style="text-align:right; font-size:24px;">
                <script>document.write(strTime);</script>
              </div>
            <div id="menu">
                <ul>
                    <li style="float:right"><a class="active" href="logout.php">로그아웃</a></li>
                </ul>
            </div>
        </header>
        <section style="background-color: #66b07a; margin-top: -1%;"><br>
            <p style="text-align: center; font-size: 28px; font-weight: bold; color: #222;"><병원 정보 입력></p>
            <div class="btn">
              <button type="button" name="add" id="add" data-toggle="modal"
              data-target="#add_data_Modal" class="btn btn-warning">데이터 추가</button>
            </div><br><br>
            <div id="board_table">
                <table class="table table-bordered table-hover" id="info" align="center">
                    <tr>
                        <th>번호</th>
                        <th>병원 이름</th>
                        <th>남은 병상 수</th>
                        <th>총 병상 수</th>
                        <th>진료 가능 목록</th>
                        <th>입력 시간</th>
                        <th>수정 하기</th>
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
                      <td><input type="button" name ="edit_data" value="수정" id="<?php echo $row["id"]; ?>" class="edit_data btn btn-warning" /></td>
                      </tr>
                    <?php
                    }
                    ?>
                    </table>
            </div>
        </section>
    </body>
</html>


<!-- 조회 모달 -->
<div id="dataModal" class="modal fade">
<div class="modal-dialog">
  <div class="modal-content">
  <!-- 모달 헤더 -->
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">병원내용 </h4>
    </div>
    <!-- 모달 바디 --> <!--//////////////////////////////////////////////////////////-->
    <div class="modal-body" id="employee_detail">
    </div>

    <!-- 모달 풋터 -->
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
    </div>
  </div>
</div>
</div>


<!-- 데이터 추가 모달 -->
<div id="add_data_Modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- 모달 헤더 -->
      <div class="modal-header">
        <h4 class="modal-title">병원 데이터 입력페이지</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- 모달 바디 -->
      <div class="modal-body">
        <form method="post" id="insert_form_hos">
          <label>병원이름</label> <!--보유장비수-->
          <textarea name="hospital_name" id="hospital_name" class="form-control" ></textarea>
          <br />

          <label>총 병상 수</label> <!--잔여병상수-->
          <input type="number" name="total_bed" id="total_bed" class="form-control" />
          <br />

          <label>잔여 병상 수</label> <!--잔여병상수-->
          <input type="number" name="remaining_bed" id="remaining_bed" class="form-control" />
          <br />

          <label>진료가능과목</label> <!--가능한 수술목록-->
          <select name="department" id="department">
            <option value="심근경색의 재관류중재술">심근경색의 재관류중재술</option>
            <option value="뇌경색의 재관류중재술">뇌경색의 재관류중재술"</option>
            <option value="뇌출혈수술(거미막하 출혈)">뇌출혈수술(거미막하 출혈)</option>
            <option value="뇌출혈수술(거미막하 출혈 외)">뇌출혈수술(거미막하 출혈 외)</option>
            <option value="대동맥응급(흉부)">대동맥응급(흉부)</option>
            <option value="대동맥응급(복부)">대동맥응급(복부)</option>
            <option value="담낭담관질환(담낭질환)">담낭담관질환(담낭질환)</option>
            <option value="담낭담관질환(담도포함질환)">담낭담관질환(담도포함질환)</option>
            <option value="복부응급수술(비외상)">복부응급수술(비외상)</option>
            <option value="장중첩/폐색(유아)">장중첩/폐색(유아)</option>
          </select>
          <br />
          <br />
          <div style="text-align:right">
            <input type="submit" name ="insert_form_hos" id="insert_form_hos" value="추가" class="btn btn-success" style="width:80px"/>
          </div>
        </form>
      </div>

      <!-- 모달 풋터 -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>



<script>

$(document).ready(function(){

  ///여기서부터 231까지 넣은 부분
  $(document).on('click', '.edit_data', function(){
  //id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
  var id = $(this).attr("id");

  $.ajax(
  {
  url:"fetch.php",
  method:"POST",
  data:{id:id},
  dataType:"json",
  success:function(data)
  {
  $('#id').val(data.id);
  $('#hospital_name').val(data.hospital_name);
  $('#remaining_bed').val(data.remaining_bed);
  $('#total_bed').val(data.total_bed);
  $('#department').val(data.department);
  $('#date').val(data.date);
  $('#add_data_Modal').modal('show');
  }
  });
  });

$('#insert_form_hos').on('submit',function(event){

event.preventDefault();
if($('#remainingsickbed').val()=='')
{
alert("병원이름를 입력해주세요");
}else if($('#equipment').val()=='')
{
alert("잔여병상수를 입력해주세요");
}else if($('#operation').val()=='')
{
alert("진료가능과목을 선택해주세요");
}else
{
$.ajax({
url:"hosinsert.php",
method:"POST",
data:$('#insert_form_hos').serialize(),
success:function(data){
$('#insert_form_hos')[0].reset();
$('#add_data_Modal').modal('hide');
// window.location.reload();
$('#board_table').html(data); //board_table은 위에서 테이블 id를 board_table로 뒀는데 이거 고치니까 추가되었다는 문구나옴

}
})

}

});

});

</script>
