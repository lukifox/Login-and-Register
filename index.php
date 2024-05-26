<!--
    Code by     :   Phyo Myat Han,
    Date        :   27-5-2024,
    Nickname    :   Liz_Coder,
    Type        :   Login, Register and Edit,
    Language    :   HTML5, CSS, PHP, MySQL(Database),
    Website     :   https://www.github.com/lukifox,
    Portfolio   :   http://coder.22web.org/?i=1,
    Portfolio2  :   http://liz.totalh.net/Portfolio/    
 -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box box">

            <?php
                include("php/config.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($con,$_POST['email']);
                    $password = mysqli_real_escape_string($con,$_POST['password']);

                    $result = mysqli_query($con,"SELECT * FROM users WHERE Email = '$email' AND Password = '$password' ") or die("Select Error!");
                    $row = mysqli_fetch_assoc($result);

                    if(is_array($row) && !empty($row)){
                        $_SESSION['valid'] = $row['Email'];
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['age'] = $row['Age'];
                        $_SESSION['id'] = $row['Id'];
                    }else{
                        echo "<div class='message'>
                                <p>Wrong Username or Password.</p>
                              </div>";
                        echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
                    }
                    if(isset($_SESSION['valid'])){
                        header("Location: home.php");
                    }
                }else{
            ?>
            
            <header>Login</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up</a> Now.
                </div>
            </form>
        </div>
            <?php } ?>
    </div>
</body>
</html>