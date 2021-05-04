<?php

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
        <title>환자상해확인페이지</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        <link rel="stylesheet" type="text/css" href="./css/sttpaient.css">
        <script type="text/javascript">
            var today = new Date();
            var strTime = "<H4>현재 시간은 ";
            strTime += today.getHours()+"시 ";
                strTime += today.getMinutes()+"분 "
                strTime += today.getSeconds()+"초. "
                setTimeout("location.reload()",60000)
        </script>
    </head>
    <body>
        <header>
            <h1  style="text-align:left;"><a href="index.php">
              <?php
                echo "<img src='./img/signal.png' alt='home' id='img1'>";
              ?>
              응급 구조 통합 플랫폼</a></h1>
            <div style="text-align:right; font-size:24px;">
                    <script>document.write(strTime);</script>
                  </div>
            <div id="menu">
                <ul>
                  <li><a href="navi.php">내비게이션</a></li>
                  <li><a href="paientInfo.php">환자정보입력</a></li>
                    <li style="float:right"><a class="active" href="logout.php">로그아웃</a></li>
                </ul>
            </div>

        </header>
        <section><br>
            <p><환자 상해 확인></p><br>
            <table id="info">
                <tr>
                    <th>번호</th>
                    <th>추정 연령</th>
                    <th>성별</th>
                    <th>체온</th>
                    <th>의식 여부</th>
                    <th>환자 정보</th>
                    <th>출발 시간</th>
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
                      <td><input type="button" name ="stt_data" value="stt입력" id="<?php echo $row["id"]; ?>" class="stt_data btn btn-warning" />
                    <details>
                      <summary>확인하기(클릭)</summary>
                      <p>
                        <?php echo $row["info"];?>
                      </p>
                    </details></td>
                    <td><?php echo $row["date"]; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
            </table>
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
    <div id="add_data_Modal_Stt" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">긴급 추가정보 전송페이지</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">

                  <p id="message">'음성녹음 시작' 버튼을 누르고<br>긴급 전달사항을 말하세요.</p>
                  <div class="textWrapper">
                    <div name="content" id="korea" class="textbox"></div>
                  </div>
                  <button type="button" class="btn btn-info" id="speech" onclick="speech_to_text()" style="width:170px; height:40px">음성녹음 시작</button>
                  <button type="button" class="btn btn-outline-info" id="stop" onclick="stop()" style="width:60px; height:40px; margin:1px">멈춤</button>
                  <button type="button" class="btn btn-outline-info" name="reset" id="reset" onclick="restart()" style="width:100px; height:40px">다시 녹음</button>

                  <form method="post" id="insert_form">
                    <input type="submit" id="insert_stt" name="insert_stt" value="추가" class="btn btn-success" style="width:338px; margin:1px"/>
                  </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
              </div>
            </div>
          </div>
        </div>




      <script src="annyang.js"></script>

      <script type="text/javascript">
      var message = document.querySelector("#message");
      var button = document.querySelector("#speech");
      var korea = document.querySelector("#korea");
      var isRecognizing = false;
      var newresText = new String("newresText");


      try{
        var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition || window.mozSpeechRecognition || window.msSpeechRecognition)();
      } catch(e){
        console.error(e);
      }

      recognition.lang = 'ko-KR'; //선택하게 해줘야 할듯 .
      recognition.interimResults = false;
      recognition.maxAlternatives = 5;
      //recognition.continuous = true;


      function speech_to_text(){
        recognition.start({autoRestart: true, continuous: true})
        isRecognizing = true;

        recognition.onstart = function(){
          message.innerHTML = "음성인식 시작...";
          console.log("음성인식이 시작 되었습니다. 이제 마이크에 말 하세요.")
          korea.innerHTML = " ";
          button.innerHTML = "Listening...";
          button.disabled = true;
        }

        recognition.onspeechend = function(){
          message.innerHTML = " '내용 전송' 버튼을 누르세요.";
          button.disabled = false;
          button.innerHTML = "음성녹음 시작";
        }

        recognition.onresult = function(event) {
          console.log('You said: ', event.results[0][0].transcript);
          // 결과를 출력
          var resText = event.results[0][0].transcript;
          korea.innerHTML = resText;
          newresText=resText;
        };

        recognition.onend = function(){
          message.innerHTML = "이송 중인 병원을 선택하고 '내용 전송' 버튼을 누르세요.";
          button.disabled = false;
          button.innerHTML = "음성녹음 시작";
          isRecognizing = false;
        }
      }

      function stop(){
        recognition.abort();
        message.innerHTML = "버튼을 누르고 전달사항을 말하세요.";
        button.disabled = false;
        button.innerHTML = "음성녹음 시작";
        isRecognizing = false;
      }

      function restart(){
        speech_to_text();
      }


      var secondid;
      $(document).ready(function(){
        $(document).on('click', '.stt_data', function(){
        //id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
        var id = $(this).attr("id");
        secondid=id;
        $.ajax(
        {
        url:"sttfetch.php",
        method:"POST",
        data:{id:id},
        dataType:"json",
        success:function(data)
        {
        $('#id').val(data.id);

        $('#add_data_Modal_Stt').modal('show');
        }
        });
        });


      ////////////////////////

      $('#insert_form').on('submit',function(event){
      event.preventDefault();
      //id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
      {
      $.ajax({
      url:"sttcheck.php",
      method:"POST",
      data:{"newresText":newresText, "secondid":secondid},
      //data:$('#insert_form').serialize(), 이것도 써야함.... id안되면 이걸해야하는데 이거랑 newresText 동시에 못보내는게 문제..ㅠㅠ
      success:function(data){
      $('#insert_form')[0].reset();
      $("#add_data_Modal_Stt").modal('hide');
      alert("입력되었습니다.");

      // window.location.reload();
      }
      })

      }

      });

      });


      </script>
</html>
