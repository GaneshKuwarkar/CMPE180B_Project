<html lang="en" dir="ltr">
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$M_Id = $_SESSION['ID'];
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
            <h1>Staff Home</h1>

        </div>
        <form style="text-align:center" method="post" action="staffHome.php">
            <div class="bottom-one"><button type="submit" name="payment">Member Payment Records</button> </div>
            <div class="bottom-one"><button type="submit" name="viewDemographics">View Demographics</button> </div>
            <div class="bottom-one"><button type="submit" name="assignInstructor">Assign Instructor</button> </div>
            <div class="bottom-one"><button type="submit" name="modifyClass">Add/Remove/Modify Class</button> </div>
            <div class="bottom-one"><button type="submit" name="modifyMembers">Add/Remove/Modify Members</button> </div>
            <div class="bottom-one"><button type="submit" name="modifyStaffMembers">Add/Remove/Modify Staff Members</button> </div>
            <div class="bottom-one"><button type="submit" name="modifyInstructors">Add/Remove/Modify Instrucors</button> </div>
            <div><button type="submit" name="workoutPlan">Log Out</button></div>
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
        ?>
    </section>
</body>

</html>