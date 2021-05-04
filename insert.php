<?php

$output = '';
$connect = mysqli_connect("", "", "","");
if (mysqli_connect_errno())
{
  echo "DB 연결에 실패했습니다 " . mysqli_connect_error();
}


$age = mysqli_real_escape_string($connect, $_POST["age"]);
$gender = mysqli_real_escape_string($connect, $_POST["gender"]);
$temper = mysqli_real_escape_string($connect, $_POST["temper"]);
$coma = mysqli_real_escape_string($connect, $_POST["coma"]);
$target = mysqli_real_escape_string($connect, $_POST["target"]);

date_default_timezone_set('Asia/Seoul');//https://it77.tistory.com/281 data()함수 쓰기 전, 미리 해놓고 하기 그럼 됨
$date = date('Y-m-d H:i:s');
$query = "INSERT INTO newrescueteam(age, gender, temper, coma, target, date) VALUES(
'$age', '$gender', '$temper', '$coma', '$target', '$date')";
//php.ini파일 date.timezone = "America/Los_Angeles"을 Aisa/Seoul로 변경하면 시간대 8시간 차이 안나는데 timezone UTC 경고로 다시 UTC로 바꿈


if(mysqli_query($connect, $query)){
  $output='<label class="text-success">수정 되었습니다.</label>';
  echo $output;
  $select_query = "SELECT * FROM newrescueteam ORDER BY id DESC";
  $result = mysqli_query($connect, $select_query);


}

?>
