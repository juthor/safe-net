<?php

session_start(); // 세션
include ("connect.php"); // DB접속


$id = $_POST['id']; // 아이디
$password = $_POST['password']; // 패스워드
$query = "select * from account where id='$id' and password='$password'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);


if($id==$row['id'] && $password==$row['password']){ // id와 pw가 맞다면 login_navbar
  if($id=='emworker'){ // 구로병원이 보는 환자데이터!
    $_SESSION['id']=$row['id'];
    echo "<center><br><br><br>";
    echo "<script> alert('로그인 되었습니다'); </script>";
    echo "</center>";
    echo "<script>location.href='paientInfo.php';</script>";
  }
  else if($id='ewhahos'){
    echo "<script>window.alert('접근불가 아이디와 비밀번호입니다');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
    echo "<script>location.href='loginem.php';</script>";
  }
  else if($id='gurohos'){ // id 또는 pw가 다르다면 login 폼으로
     echo "<script>window.alert('접근불가 아이디와 비밀번호입니다');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
     echo "<script>location.href='loginem.php';</script>";
  }
  else{
    echo "<script>window.alert('접근불가 아이디와 비밀번호입니다');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
    echo "<script>location.href='loginem.php';</script>";
  }
}

else{ // id 또는 pw가 다르다면 login 폼으로
   echo "<script>window.alert('잘못된 아이디와 비밀번호입니다');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
   echo "<script>location.href='loginem.php';</script>";
 }
?>
