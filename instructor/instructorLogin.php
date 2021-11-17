<!DOCTYPE html>
<?php
include("../connect.php");
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Gym Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .bottom-three {
            margin-bottom: 2cm;
        }

        .bottom-one {
            margin-bottom: 1cm;
        }
    </style>
</head>

<body>



    <form style="text-align:center" method="post" action="instructorLogin.php">
        <h1 class="bottom-one">Instructor Login</h1>
        <div class="container">
            <div class="bottom-one"> <label>Username : </label>
                <input type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div class="bottom-one"> <label> Password : </label>
                <input type="password" placeholder="Enter Password" name="password" required>
            </div>
            <div><button type="submit" name="InstructorLogin" style="height:23px; width: 55px">Login</button>
            <button type="submit" name="back" style="height:23px; width: 55px">Back</button> </div>

        </div>
    </form>
    <section align="center">
        <?php
        if (isset($_POST['InstructorLogin'])) {
            extract($_POST);
            $sql = "select I_id from instructor where I_email = '$username' and CAST(aes_decrypt(I_password,'key')as char(50)) = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            //echo print($row['M_id']);
            
            if ($count == 1) {
                echo "<h1><center> Login successful </center></h1>";
                session_start();
                $ID = $row['I_id'];
                logger("INFO","INSTRUCTOR $ID LOGGED IN");
                $_SESSION['ID'] = $row['I_id'];
                if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                    $uri = 'https://';
                } else {
                    $uri = 'http://';
                }
                $uri .= $_SERVER['HTTP_HOST'];
                header('Location: ' . $uri . '/gym/instructor/instructorHome.php');
                exit;
            } else {
                logger("ERROR","FAILED LOGIN BY INSTRUCTOR $username");
                echo "<h1> Login failed. Invalid username  or password.</h1>";
                //
            }
        }
        if (isset($_POST['back'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/home.html');
        }
        ?>




        <section></section>
</body>

</html>