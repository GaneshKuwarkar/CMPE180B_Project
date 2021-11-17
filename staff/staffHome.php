<html lang="en" dir="ltr">
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$S_Id = $_SESSION['ID'];
$sql = "SELECT * FROM staff WHERE S_id = '$S_Id' AND S_type = 'FD'";
$result1 = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$count = mysqli_num_rows($result1);
if ($count != 0) {
?>
    <style type="text/css">
        #class {
            display: none;
        }

        #staff {
            display: none;
        }

        #instruct {
            display: none;
        }
    </style>
<?php
}
?>

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
            <?php
            if ($count == 1) {
                echo "<h1>Staff Home</h1>";
            } else {
                echo "<h1>Manager Home</h1>";
            }
            ?>


        </div>
        <form style="text-align:center" method="post" action="staffHome.php">
            <div class="bottom-one"><button type="submit" name="payment">Member Payment Records</button> </div>
            <div class="bottom-one"><button type="submit" name="viewDemographics">View Demographics</button> </div>
            <div class="bottom-one"><button type="submit" name="assignInstructor">Assign Instructor</button> </div>
            <div class="bottom-one" id="class"><button type="submit" name="crudClass">Add/Remove/Modify Class</button> </div>
            <div class="bottom-one" id="member"><button type="submit" name="crudMember">Add/Remove/Modify Members</button> </div>
            <div class="bottom-one" id="staff"><button type="submit" name="crudStaff">Add/Remove/Modify Staff Members</button> </div>
            <div class="bottom-one" id="instruct"><button type="submit" name="modifyInstructors">Add/Remove/Modify Instructors</button> </div>
            <div class="bottom-one"><button type="submit" name="staffChangePassword">Change Password</button></div>
            <div class="bottom-one"><button type="submit" name="logout">Log Out</button></div>
            
        </form>
        <?php

        if (isset($_POST['payment'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/paymentRecords.php');
            exit;
        }
        if (isset($_POST['viewDemographics'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/viewDemographics.php');
            exit;
        }
        if (isset($_POST['assignInstructor'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/assignInstructor.php');
            exit;
        }
        if (isset($_POST['crudClass'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/crudClass.php');
            exit;
        }
        if (isset($_POST['crudMember'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/crudMember.php');
            exit;
        }
        if (isset($_POST['crudStaff'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/crudStaff.php');
            exit;
        }
        if (isset($_POST['modifyInstructors'])) {
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/modifyInstructors.php');
            exit;
        }
        if (isset($_POST['logout'])) {
            logger("INFO","STAFF $S_Id LOGGED OUT");
            session_destroy();
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/staffLogin.php');
            exit;
        }
        if (isset($_POST['staffChangePassword'])) {

            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                $uri = 'https://';
            } else {
                $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: ' . $uri . '/gym/staff/staffChangePassword.php');
            exit;
        }
        ?>
    </section>
</body>

</html>