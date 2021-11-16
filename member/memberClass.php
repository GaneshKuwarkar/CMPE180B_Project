<!DOCTYPE html>
<?php
    session_start();// echo $_SESSION['ID'];
    include("../connect.php");
    $M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
#viewmy:checked ~ .viewmy
{
    display:block;
}
#register:checked ~ .register
{
    display:block;
}
#drop:checked ~ .drop
{
    display:block;
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

        <h1>Classes</h1>

        <div class="viewall" >
            <?php
                $sql = "select C_id, C_name, C_scale,C_enrolled ,C_duration, C_start_time, C_day, C_room, I.I_name from class C right join instructor I on C.I_id = I.I_id";
                $result = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<caption>All Classes</caption>";
                echo "<tr>";
                echo "<td>ID<td>Name<td>Capacity<td>Enrolled<td>Duration<td>Start Time<td>Day<td>Room<td>Instructor<td>";
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
        <br><br>

        <input type="radio" name="data" id="viewmy">View My Classes</button> 
        <input type="radio" name="data" id="register">Register</button> 
        <input type="radio" name="data" id="drop">Drop</button> 
        <button type="submit" onclick="window.location='memberHome.php';" name="back">Back</button>

        <div class="viewmy" hidden>
            <?php

                $sql = "select C.C_id, C.C_name, C.C_scale, C.C_enrolled, C.C_duration, C.C_start_time, C.C_day, C.C_room, I.I_name 
                        from class C  
                        inner join instructor I on C.I_id = I.I_id 
                        inner join enroll E on E.C_id = C.C_id 
                        where M_id = '$M_Id'; ";
                // $sql = "select C_id, C_name, C_scale, C_duration, C_start_time, C_day, C_room, I.I_name from class C right join instructor I on C.I_id = I.I_id";
                $result1 = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<tr>";
                echo "<td>ID<td>Name<td>Capacity<td>Enrolled<td>Duration<td>Start Time<td>Day<td>Room<td>Instructor<td>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result1)) { 
                    echo "<tr>";
                    foreach ($row as $field => $value) { 
                        echo "<td>" . $value . "</td>"; 
                    }
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>
        <div class="register" hidden>
            <form style="text-align:center" method="post" action="memberClass.php">
                <br><br>
                <div > <label>Class Id : </label>
                    <input type="text" placeholder="Enter Class Id" name="C_id" required>
                </div><br>
                <div><button type="submit" name="register" >Register</button> </div>
            </form>
        </div>

        <div class="drop" hidden>
            <form style="text-align:center" method="post" action="memberClass.php">
                <br><br>
                <div > <label>Class Id : </label>
                    <input type="text" placeholder="Enter Class Id" name="C_id_drop" required>
                </div><br>
                <div><button type="submit" name="drop">Drop</button> </div>
            </form>
        </div>

        <?php
        if (isset($_POST['register'])) {
            extract($_POST);
            $sql = "select C_scale, C_enrolled from class where C_id='$C_id'";
            $result = mysqli_query($conn, $sql);
            $data = $result->fetch_assoc();

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if ($count == 0) {
                echo "<script>
                alert('Incorrect Class Id');
                window.location.href='memberClass.php';
                </script>";
            }
            echo $data["C_scale"];
            echo $data["C_enrolled"];
            if($data["C_scale"] == $data["C_enrolled"]) {
                echo "<script>
                alert('Class Full');
                window.location.href='memberClass.php';
                </script>";
            }

            $sql = "insert into enroll values('$M_Id', '$C_id')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Registration Successful');
                window.location.href='memberClass.php';
                </script>";
            } else {
                echo "<script>
                alert('Already Registered');
                window.location.href='memberClass.php';
                </script>";
            }
        }
////////////////////drop
        if (isset($_POST['drop'])) {
            extract($_POST);
            $sql = "select * from enroll where C_id='$C_id_drop' and M_id='$M_Id'";
            echo "$C_id_drop";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
                echo "<script>
                alert('Incorrect Class Id. Not Enrolled');
                window.location.href='memberClass.php';
                </script>";
            }

            $sql = "delete from enroll where C_id='$C_id_drop' and M_id='$M_Id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Class Dropped');
                window.location.href='memberClass.php';
                </script>";
            } else {
                echo "<script>
                alert('Error while dropping..');
                window.location.href='memberClass.php';
                </script>";
            }
        }
        ?>

    </section>
</body>

</html> 