<?php
if(!empty($_POST)){
$output = '';
$connect = mysqli_connect("", "", "","");
if (mysqli_connect_errno())
{
  echo "DB 연결에 실패했습니다 " . mysqli_connect_error();
}


$hospital_name = mysqli_real_escape_string($connect, $_POST["hospital_name"]);
$total_bed = mysqli_real_escape_string($connect, $_POST["total_bed"]);
$remaining_bed = mysqli_real_escape_string($connect, $_POST["remaining_bed"]);
$department = mysqli_real_escape_string($connect, $_POST["department"]);
date_default_timezone_set('Asia/Seoul');//https://it77.tistory.com/281 data()함수 쓰기 전, 미리 해놓고 하기 그럼 됨

$date = date('Y-m-d H:i:s');


/*
$query = "INSERT INTO hospital(hospital_name, total_bed, remaining_bed, department, date) VALUES(
'$hospital_name', '$total_bed', '$remaining_bed', '$department', '$date')";
//php.ini파일 date.timezone = "America/Los_Angeles"을 Aisa/Seoul로 변경하면 시간대 8시간 차이 안나는데 timezone UTC 경고로 다시 UTC로 바꿈


if(mysqli_query($connect, $query)){
  $output='<label class="text-success">추가 되었습니다.</label>';
  echo $output;
  $select_query = "SELECT * FROM hospital ORDER BY id DESC";
  $result = mysqli_query($connect, $select_query);


}*/


if($_POST["hospital_name"]!='')
{
$query = "
UPDATE hospital SET
total_bed='$total_bed',
remaining_bed='$remaining_bed',
department = '$department',
date = '$date'
WHERE hospital_name = '".$_POST["hospital_name"]."'";
}else
{
  $query = "INSERT INTO hospital(hospital_name, total_bed, remaining_bed, department, date) VALUES(
  '$hospital_name', '$total_bed', '$remaining_bed', '$department', '$date')";
}

if(mysqli_query($connect, $query)){
  $output='<label class="text-success">추가 되었습니다.</label>';
  echo $output;
  $select_query = "SELECT * FROM hospital ORDER BY id DESC";
  $result = mysqli_query($connect, $select_query);


}
}
//지금 문제는 DB에서 수정이 안된다는 것

?>
