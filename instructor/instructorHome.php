<!DOCTYPE html>
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$I_id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
    #viewMembers:checked~.viewMembers {
        display: block;
    }

    #viewClasses:checked~.viewClasses {
        display: block;
    }
</style>

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

        <h1>Instructor Home</h1>


        <input type="radio" name="data" id="viewMembers">View Members</button>
        <input type="radio" name="data" id="viewClasses">View Classes</button>
        <br><br>
        <form style="text-align:center" method="post" action="instructorHome.php">
            <button type="submit" name="logout">Log Out</button>
        </form>
        
        <!-- <button type="submit" onclick="window.location='memberHome.php';" name="back">Back</button> -->


        <!-- <div class="viewMembers" hidden>
            <form style="text-align:center" method="post" action="instructorHome.php">
                <br><br>
                <div> <label>Payment Method : </label>
                    <input type="text" placeholder="Enter Payment Method" name="method" required>
                </div>
                <div> <label>Transaction Id : </label>
                    <input type="text" placeholder="Enter Transaction Id" name="p_id" required>
                </div>
                <div> <label> Amount : </label>
                    <input type="number" placeholder="Enter Amount" name="amount" required>
                </div>
                <div><button type="submit" name="payment" style="height:23px; width: 55px">Pay</button> </div>
            </form>
        </div> -->


        <div class="viewMembers" hidden>
            <?php
            $sql = "select M.M_name,M.M_phone_No from member M inner join taught_by T on M.M_id=T.M_id where T.I_id = '$I_id'";
            $result = mysqli_query($conn, $sql);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>Member Name<td>Member PhoneNo<td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>



        </div>

        <div class="viewClasses" hidden>
            <?php
            $sql = "select C_name, C_duration, C_start_time, C_day, C_room from class where I_id='$I_id'";
            $result = mysqli_query($conn, $sql);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>Class Name<td>Class Duration<td>Class Start Time<td>Class Day<td>Class Room<td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";

            if (isset($_POST['logout'])) {
                session_destroy();
                
                logger("INFO","INSTRUCTOR $I_id LOGGED OUT");
                if (!empty($_SERVER['HTTPS'])&& ('on' == $_SERVER['HTTPS'])) {
                    $uri = 'https://';
                } else {
                    $uri = 'http://';
                }
                $uri .= $_SERVER['HTTP_HOST'];
                header('Location: ' . $uri . '/gym/instructor/instructorLogin.php');
                exit;
            }
            ?>



        </div>


    </section>
</body>

</html>