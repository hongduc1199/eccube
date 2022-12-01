<?php
    session_start();
?>
<?php
    require"conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- thêm  -->
<?php
    if (isset($_GET["view"]) && $_GET["view"] == "them") {
        require"createacc.php";
    } else {     
?>
<!-- sửa 1 hàng trong csdl -->
<?php 
        if(isset($_GET["Sua"])){
            $id = $_GET["Sua"];
        }
    ?>
    <?php 
        if(isset($_POST['edit'])) {
            $password = $_POST["password"];
            $status= $_POST["status"];
            if($password == '' || $status == ''){
                echo 'password và status không đc bỏ trống!';
            }else {
                $sql = "UPDATE user SET password = '$password', status = '$status' WHERE ID = $id";
                $db = $conn->query($sql);
                header("location: index.php");
            }       
        }
    ?>  
    <?php 
        if(isset($_GET["Sua"]) && $_GET["Sua"] = $id){
            $sql = "SELECT * FROM user WHERE ID = $id";
            $db = $conn->query($sql);
            $row = mysqli_fetch_array($db);
    ?>
        <form action="" method="POST">
            <table align="center">
                <tr>
                    <td>ID</td>
                    <td><input disabled  type="text" value="<?php echo $row["ID"] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input disabled type="text" value="<?php echo $row["email"] ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" value="<?php echo $row["password"] ?> "></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><input type="text" name="status" value="<?php echo $row["status"] ?>"></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input type="submit" name="edit" value="Cập nhật"></td>
                </tr>
            </table>
        </form>
    <?php
        } else {
    ?>
<?php
    if(isset($_SESSION['email']) && isset($_SESSION['pass'])){
        echo "Xin chào <b>{$_SESSION['email']}</b>";
        //echo $_SESSION['pass'];
    }
    else {
        echo 'khong co';
       //header("location: session.php");
    }
    
?>
    <table border="1" align="center">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Status</th>
            <th colspan="2" ><a href="?view=them">Thêm</a></th>
        </tr>
    
    <!-- xoá 1 hàng trong csdl -->
    <?php 
        if (isset($_GET["ID"])){
            $id = $_GET["ID"] ;
            $sql = "DELETE FROM user WHERE ID = $id";
            $db = $conn->query($sql);
            header("location: index.php");
        }
    ?>
    <!-- hiện csdl -->
    <?php 
        $sql = "SELECT * FROM user";
        $db = $conn->query($sql);
        if ($db->num_rows > 0) {
            while ($row = mysqli_fetch_array($db)) {
    ?>
        <tr>
            <td disabled><?php echo $row["ID"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td><?php echo $row["status"] ?></td>
            <td><a href="?Sua=<?php echo $row["ID"] ?>">Sửa</a></td>
            <td><a href="?ID=<?php echo $row["ID"] ?>">Xoá</a></td>
        </tr>
    <?php
            }
        }
    ?>
    </table>
    <br>
    <a href="logout.php">đăng xuất</a>
    <?php
        }
    ?>
    <?php
        }
    ?>
</body>
</html>