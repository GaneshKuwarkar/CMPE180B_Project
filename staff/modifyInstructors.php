<!DOCTYPE html>
<?php
    session_start();// echo $_SESSION['ID'];
    include("../connect.php");
    $M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
    #add:checked ~ .add{
        display:block;
    }
    #modify:checked ~ .modify{
        display:block;
    }
    #remove:checked ~ .remove{
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
        
        <h1>Instructors</h1>

        <div class="viewall" >
            <?php
                $sql = "select I_id, I_name, I_gender, I_phone_No, I_start_date, I_DOB, Manager_S_id from instructor";
                $result = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<caption>All Instructors</caption>";
                echo "<tr>";
                echo "<td>ID<td>Name<td>Gender<td>Phone Number<td>Start date<td>DOB<td>ID of manager<td>";
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

        <input type="radio" name="data" id="add">Add Instructor</button> 
        <input type="radio" name="data" id="modify">Modify Instructor</button> 
        <input type="radio" name="data" id="remove">Remove Instructor</button> 
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>

        <div class="add" hidden>
            <form style="text-align:center" method="post" action="modifyInstructors.php">
                <br><br>
                <div > <label>Instructor Id : </label>
                    <input type="text" placeholder="Enter Instructor Id" name="i_id" required>
                </div>
                <div> <label>Instructor name : </label>
                    <input type="text" placeholder="Enter Instructor name" name="i_name" required>
                </div>
                <div > <label>Instructor email :  </label>
                    <input type="text" placeholder="Enter Instructor email " name="i_email" required>
                </div>
                <div > <label>Instructor gender : </label>
                    <input type="text" placeholder="Enter Instructor gender" name="i_gender" required>
                </div>
                <div > <label>Instructor DOB : </label>
                    <input type="text" placeholder="Enter Instructor DOB" name="i_dob" required>
                </div>
                <div > <label>Instructor phone number : </label>
                    <input type="text" placeholder="Enter Instructor phone No" name="i_phone_no" required>
                </div>
                <div > <label>Instructor start date : </label>
                    <input type="text" placeholder="Enter Instructor start date" name="i_start_date" required>
                </div>
                <div > <label>Instructor password : </label>
                    <input type="text" placeholder="Enter Instructor password" name="i_password" required>
                </div>
                <div > <label>Instructor's manager : </label>
                    <input type="text" placeholder="Enter Instructor's manager" name="manager_s_id" required>
                </div>
                <div><button type="submit" name="add" style="height:23px; width: 55px">Add</button> </div>
            </form>
        </div>

        <div class="modify" hidden>
            <form style="text-align:center" method="post" action="modifyInstructors.php">
                <br><br>
                <div > <label>Instructor Id : </label>
                    <input type="text" placeholder="Enter Instructor Id" name="I_id" required>
                </div><br>

                <div > 
                    <label for="category">Select Category:</label>
                    <select name="category" id="category" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="I_id">Id</option>
                        <option value="I_name">Name</option>
                        <option value="I_email">Email</option>
                        <option value="I_gender">Gender</option>
                        <option value="I_DOB">DOB</option>
                        <option value="I_phone_No">Phone number</option>
                    </select>
                </div><br>

                <div > <label>Entry : </label>
                    <input type="text" placeholder="Entry" name="entry" required>
                </div><br>

                <div><button type="submit" name="modify">Modify</button> </div>
            </form>
        </div>
        
        <div class="remove" hidden>
            <form style="text-align:center" method="post" action="modifyInstructors.php">
                <br><br>
                <div > <label>Instructor Id : </label>
                    <input type="text" placeholder="Enter Instructor Id" name="I_id_drop" required>
                </div><br>
                <div><button type="submit" name="remove">Remove</button> </div>
            </form>
        </div>

        <?php

        if (isset($_POST['add'])) {
            extract($_POST);
            $sql = "insert into instructor values('$i_id', '$i_name', '$i_email', '$i_gender', '$i_dob', '$i_phone_no', '$i_start_date', '$i_password', '$manager_s_id')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Instructor added successfully');
                window.location.href='modifyInstructors.php';
                </script>";
            } else {
                echo "<script>
                alert('Failed to add instructor');
                window.location.href='modifyInstructors.php';
                </script>";
            }
        }

        if (isset($_POST['modify'])) {
            extract($_POST);
            $sql = "update instructor set $category = '$entry' where I_id = '$I_id'";
            echo $sql;
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Instructor details Changed Successful');
                window.location.href='modifyInstructors.php';
                </script>";
            } else {
                echo "<script>
                alert('Instructor details Change Failed');
                window.location.href='modifyInstructors.php';
                </script>";
            }
        }

        if (isset($_POST['remove'])) {
            extract($_POST);
            $sql = "select * from instructor where I_id='$I_id_drop'";
            echo "$I_id_drop";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
                echo "<script>
                alert('Incorrect Instructor Id');
                window.location.href='modifyInstructors.php';
                </script>";
            }

            $sql = "delete from instructor where I_id='$I_id_drop'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Instructor Dropped');
                window.location.href='modifyInstructors.php';
                </script>";
            } else {
                echo "<script>
                alert('Error while dropping');
                window.location.href='modifyInstructors.php';
                </script>";
            }
        }
        ?>

    </section>
</body>

</html>