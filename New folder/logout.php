<?php 
    session_start();
    //session_destroy(); // xoá toàn bộ session
    unset($_SESSION['name'], $_SESSION['pass']); // chỉ xoá session nào thì dùng đường dẫn đấy
    header("location: session.php")
?>