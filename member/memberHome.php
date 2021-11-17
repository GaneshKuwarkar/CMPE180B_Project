<!DOCTYPE html>
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>GYM</title>
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
    <section align="center">
        <div class="bottom-one">
            <h1>Member Home</h1>
            <h3> Your ID :
                <?php echo $_SESSION['ID']; ?>
            </h3>
        </div>
        <form style="text-align:center" method="post" action="memberHome.php">
            <div class="bottom-one"><button type="submit" name="payment">Payment</button> </div>
            <div class="bottom-one"><button type="submit" name="classes">Classes</button> </div>
            <div class="bottom-one"><button type="submit" name="workoutPlan">Workout Plan</button> </div>
            <div class="bottom-one"><button type="submit" name="logout">Log Out</button></div>
            <div>
                <button type="submit" name="memberChangePassword">Change Password</button>
            </div>
        </form>
        <?php

        if (isset($_POST['payment'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/member/memberPayment.php');
            exit;
        }
        if (isset($_POST['classes'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/member/memberClass.php');
            exit;
        }
        if (isset($_POST['workoutPlan'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/member/memberWP.php');
            exit;
        }
        if (isset($_POST['logout'])) {
            session_destroy();
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/member/memberLogin.php');
            exit;
        }
        if (isset($_POST['memberChangePassword'])) {

            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/member/memberChangePassword.php');
            exit;
        }
        ?>


    </section>
</body>

</html>