<?php

session_start(); // 세션

if($_SESSION['id']!=null){
   session_destroy();
}
echo "<script> alert('로그아웃 되었습니다'); </script>";
echo "<script>location.href='loginpai.php';</script>";

?>
