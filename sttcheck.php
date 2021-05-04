<?php
if(!empty($_POST)){
$output = '';
$connect = mysqli_connect("", "", "","");
if (mysqli_connect_errno())
{
  echo "DB 연결에 실패했습니다 " . mysqli_connect_error();
}


/*
{
$query = "SELECT * FROM newrescueteam WHERE id = '".$_POST["id"]."'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_array($result);
//echo json_encode($row);
}
*/
//$id=mysqli_real_escape_string($connect, $_POST["id"]);
$info = mysqli_real_escape_string($connect, $_POST["newresText"]);
$id = mysqli_real_escape_string($connect, $_POST["secondid"]);
$query = "UPDATE newrescueteam SET info='$info' where id='$id'";
//php.ini파일 date.timezone = "America/Los_Angeles"을 Aisa/Seoul로 변경하면 시간대 8시간 차이 안나는데 timezone UTC 경고로 다시 UTC로 바꿈

//WHERE temper='".$_POST["temper"]."'";
if(mysqli_query($connect, $query)){


}
}

?>
