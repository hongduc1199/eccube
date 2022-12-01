<?php
    session_start();

?>
<?php
    require"conn.php"
?>

</body>
</html>

<!DOCTYPE HTML>  
<html>
<head>
<style>
    .error {color: #FF0000;}
</style>
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

    <h2>PHP Form </h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table align="center">
        <tr>
            <td>E-mail</td>
            <td><input type="email" name="email"></td>
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
            <td align="center" colspan="2">
                <input type="submit" name="submit" value="Login"> 
            </td>
        </tr>
        <tr>
            <td colspan="2"><a href="createacc.php">Tạo tài khoản</a> | quên thì kệ</td>
        </tr>
    
    </table>
    </form>

        <?php
        if(isset($_POST['submit'])){
            if(!empty($email) && !empty($pass)){
                $sql = "SELECT * FROM user WHERE email = '$email'"; 
                $usersql = array();
                $db = $conn->query($sql);
                $row = mysqli_fetch_array($db);
                $_SESSION['user'] = $row;   
                if(mysqli_num_rows($db) == 0 || $pass != $row["password"]) {
                    echo 'Email hoac mat khau khong dung !';
                } else if($email == $row["email"] && $pass == $row["password"]){
                    if($row["status"] >= 1){
                        //echo 'thanh cong';
                        $_SESSION['email'] = $email;
                        $_SESSION['pass'] = $pass;
                        header("location: index.php");
                    } else {
                        echo 'ban khong duoc cap quyen';
                    } 
                }
            } 
        }                   
    ?>

    </body>
</html>