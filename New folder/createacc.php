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
<?php
        // define variables and set to empty values
        $emailErr = $passErr = "";
        $email = $pass = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["email"])) {
                    $emailErr = "Email không được bỏ trống";
                } else {
                    $email = test_input($_POST["email"]);
                }
                if (empty($_POST["pass"])) {
                    $passErr = "Password không được bỏ trống";
                } else {
                $pass = test_input($_POST["pass"]);
                }
            
            }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
?>

    <form action="" method="POST">
        <table border="0" align="center">
            <tr>
                <td align="center" colspan="2">Create Account</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td colspan="2"><span class="error">* <?php echo $emailErr;?></span></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="pass"></td>
            </tr>
            <tr>
                <td colspan="2"><span class="error">* <?php echo $passErr;?></span></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="them" value="Create"></td>
            </tr>
        </table>
    </form>
<?php
?> 
<?php
    if(isset($_POST["them"])){
        if(!empty($email) && !empty($pass)){
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $sql = "SELECT * FROM user WHERE email = '$email'"; 
        $db = $conn->query($sql);
        $row = mysqli_fetch_array($db);
        if($row > 0){
            echo 'email đã tồn tại';
        } else {
            $sql1 = "INSERT INTO user(email,password,status) VALUES('$email','$pass', 0)";
            $db1 = $conn->query($sql1);
            echo 'thêm dữ liệu thành công';
            header("location: index.php");
        }
    }
}
?>
</body>

</html>