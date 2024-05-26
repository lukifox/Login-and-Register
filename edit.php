<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
    <link rel="stylesheet" type="text/css" href="css/edit.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="edit.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="form-box box">

        <?php

            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con, "UPDATE users SET Username ='$username', Email = '$email', Age = '$age' WHERE Id=$id ") or die("Error!");

                if($edit_query){
                    echo "<div class='message'>
                            <p>Profile Updated!</p>
                          </div> </br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button></a>";
                }
            }else{
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                }

        ?>
            <header>Change Profile</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age ?>" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update">
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>