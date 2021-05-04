<?php

session_start(); // 세션오픈
if(!isset($_SESSION['id'])){  // 로그인 하지 않았다면, index에서 로그아웃 한다면 바로 login페이지로 갈 수 있도록 설정
  echo "<script>location.href='loginem.php';</script>";
}


//if(!isset($_SESSION['id'])){  // 로그인 하지 않았다면, index에서 로그아웃 한다면 바로 login페이지로 갈 수 있도록 설정
//  echo "<script>location.href='login.php';</script>";
//}
/// Login은 확인하고 연결하기 20190926


  //db연결
//  $connect = mysqli_connect("localhost", "root", "capstoneproject","hufsproject2");

$connect = mysqli_connect("", "", "","");
$query = "SELECT * FROM newrescueteam ORDER BY id DESC";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>환자 정보 모달창 페이지</title>
    <!-- Bootstrap core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


    <!--안지가 추가한 것-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
      p { margin:20px 0px; }

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
         background-color: #4CAF50;
     }
     .split{
         margin-top: 11%;
         height: 65%;
         width: 50%;
         position:absolute;
         z-index: 1;
         top: 0;
         overflow-x: hidden;
         padding-top: 20px;
     }
     .left{
         left: 0;
         background-color: bisque;
     }
     .right{
         right: 0;
         background-color: #c5cef2;
     }
     .centered{
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
     }
     .button{
         border-radius: 4px;
         background-color: #eb6338;
         border: none;
         color: #FFFFFF;
         text-align: center;
         font-size: 22px;
         padding: 10px 10px;
         width: 240px;
         transition: all 0.5s;
         cursor: pointer;
         margin: 5px;
     }
     .button span{
         cursor: pointer;
         display: inline-block;
         position: relative;
         transition: 0.5s;
     }
     .button span:after{
         content: '\00bb';
         position: absolute;
         opacity: 0;
         top: 0;
         right: -20px;
         transition: 0.5s;
     }
     .button:hover span{
         padding-right: 25px;
     }
     .button:hover span:after{
         opacity: 1;
         right: 0;
     }
     @media screen and (max-width: 1440px){
         h1{ margin: 0 auto;}
         .split{
             margin-top: 10.5%;
             height: 60%;
             width: 50%;
             position: absolute;
             z-index: 1;
             top: 0;
             overflow-x: hidden;
             padding-top: 20px;
         }
         h2{ font-size: 170%; }

         p{ font-size: 110%; }
     }
     @media screen and (max-width: 1024px){
         h1{ margin: 0 auto; }
         p{ font-size: 88%; }
         .split{
             margin-top: 15%;
             height: 60%;
             width: 50%;
             position: absolute;
             z-index: 1;
             top: 0;
             overflow-x: hidden;
             padding-top: 20px;
         }
         h2{ font-size: 140%; }
     }
     @media screen and (max-width: 768px){
         h1{ margin: 0 auto; }
         .split{
             margin-top: 20%;
             height: 60%;
             width: 50%;
             position: absolute;
             z-index: 1;
             top: 0;
             overflow-x: hidden;
             padding-top: 20px;
         }
         h2{ font-size: 125%; }
         p{ font-size: 85%; }
         .button{
             font-size: 20px;
             padding: 10px 10px;
             width: 200px;
         }
     }
    </style>
  </head>

  <body>
    <!--navbar 설정-->
    <header>
        <h1><a href="index.php"><?php
            echo "<img src='./img/signal.png' alt='home' id='img1'>";
          ?> 환자 정보 입력</a></h1>
        <div id="menu">
            <ul>
                <li><a href="navi.php">내비게이션</a></li>
                <li><a href="paientInfo.php">환자정보입력</a></li>
                <li style="float:right"><a class="active" href="logoutem.php">로그아웃</a></li>
            </ul>
        </div>
    </header>
    <section>
        <div class="split left">
            <div class="centered">
              <?php
                echo "<img src='./img/basic_info.png' alt='basic'>";
              ?>
                <h2>환자 기본 정보 입력하기</h2>
                <p>응급 환자의 상태를 파악하고 환자의 상해 정보를 입력하여 목적지로 설정된 병원에 정보를 전달합니다.</p>
                <button class="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal_basic"><span>기본 정보 입력하기</span></button>
            </div>
        </div>

        <div class="split right">
            <div class="centered">
              <?php
                echo "<img src='./img/emergency_info.png' alt='basic'>";
              ?>
                <h2>긴급 추가 정보 입력하기</h2>
                <p>이송 중 갑작스런 응급 환자의 상해 변화를 확인하여 마이크의 음성 인식을 통해 병원에 정보를 전달합니다.</p>
                <a href="sttpaient.php"><button class="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal_extra"><span>긴급 정보 입력하기</span></button></a>
            </div>
        </div>
    </section>
  </body>


<!-- 기본정보 추가 모달 -->
<div id="add_data_Modal_basic" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- 모달 헤더 -->
      <div class="modal-header">
        <h4 class="modal-title">환자 기본정보 입력페이지</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- 모달 바디 -->
      <div class="modal-body">
        <form method="post" id="insert_form">
            <label>추정 연령</label>
            <br />

              <div class="btn-group-toggle" data-toggle="buttons" style="margin:0px 0px 0px 15px">
    						<label class="btn btn-light" style="width:80px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="00to07"  > 0세 - 7세
    						</label>
    						<label class="btn btn-light" style="width:80px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="08to13" > 8세 - 13세
    						</label>
                <label class="btn btn-light" style="width:80px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="14to19" > 14세 - 19세
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="20to29" > 20대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="30to39" > 30대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="40to49" > 40대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="50to59" > 50대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="60to69" > 60대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="70to79" > 70대
    						</label>
                <label class="btn btn-light" style="width:60px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="80to89" > 80대
    						</label>
                <label class="btn btn-light" style="width:70px; height:30px; margin:2px">
    							<input type="radio" name="age" id="age" value="90to99" > 90대 이상
    						</label>
            </div>
          <br />

          <label>성별</label>
          <br />
    			<div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin:0px 0px 0px 15px">
    				<label class="btn btn-light" style="width:60px; height:30px">
    					<input type="radio" name="gender" id="gender" value="M"  > 남성
    				</label>
    				<label class="btn btn-light" style="width:60px; height:30px">
    					<input type="radio" name="gender" id="gender" value="W" > 여성
    				</label>
    			</div>
          <br />

          <label>이송 중 체온</label>
              <br />
              <input type="text" name="temper" id="temper"  class="form-control" />

          <label>의식 여부</label> <!--응급수술 가능 여부-->
          <br/>
    			<div class="btn-group-toggle" data-toggle="buttons" style="margin:0px 0px 0px 15px">
    				<label class="btn btn-light" style="width:80px; height:40px; margin:1px">
    					<input type="radio" name="coma" id="coma" value="alert"  > 의식명료<br>(alert)
    				</label>
    				<label class="btn btn-light" style="width:80px; height:40px; margin:1px">
    					<input type="radio" name="coma" id="coma" value="drowsy" > 기면상태<br>(drowsy)
    				</label>
            <label class="btn btn-light" style="width:80px; height:40px; margin:1px">
    					<input type="radio" name="coma" id="coma" value="stupor" > 혼미상태<br>(stupor)
    				</label>
            <label class="btn btn-light" style="width:80px; height:40px; margin:1px">
    					<input type="radio" name="coma" id="coma" value="semi-coma" > 반혼수상태<br>(semi-coma)
    				</label>
            <label class="btn btn-light" style="width:80px; height:40px; margin:1px">
    					<input type="radio" name="coma" id="coma" value="coma" > 혼수상태<br>(coma)
    				</label>
          </div>
          <br>
          <br>
          <br>

          <label>병원선택</label> <!--응급수술 가능 여부-->
          <div class="btn-group-toggle" data-toggle="buttons" style="margin:0px 0px 0px 15px">
            <label class="btn btn-light" style="width:80px; height:40px; margin:1px">
              <input type="radio" name="target" id="target" value="gurohospital">구로고려대학병원<br>중증외상센터
            </label>
            <label class="btn btn-light" style="width:80px; height:40px; margin:1px">
              <input type="radio" name="target" id="target" value="ewhahospital">이화여자대학병원<br>중증외상센터
            </label>
          </div>

          <div style="text-align:right">
            <input type="submit" name ="insert" id="insert" value="추가" class="btn btn-success" style="width:80px"/>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>

$(document).ready(function(){


$('#insert_form').on('submit',function(event){

event.preventDefault();
if($('#age').val()=='')
{
alert("추정 연령을 입력해주세요");
}else if($('#gender').val()=='')
{
alert("성별을 입력해주세요");
}else if($('#temper').val()=='')
{
alert("체온을 입력해 선택해주세요");
}else if($('#coma').val()=='')
{
alert("의식여부를 입력해주세요");
}
else
{
$.ajax({
url:"insert.php",
method:"POST",
data:$('#insert_form').serialize(),
success:function(data){
if(data){
  $('#insert_form')[0].reset();

  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
  $("#add_data_Modal_basic").hide();
  alert("성공");

}
else{
  alert("실패");
}
// window.location.reload();
}
})

}

});

});


</script>
