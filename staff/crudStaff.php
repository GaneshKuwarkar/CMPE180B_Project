<!DOCTYPE html>
<?php
    session_start();// echo $_SESSION['ID'];
    include("../connect.php");
    $S_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
#view:checked ~ .view
{
    display:block;
}
#add:checked ~ .add
{
    display:block;
}
#modify:checked ~ .modify
{
    display:block;
}
#delete:checked ~ .delete
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

        <h1>Staff</h1>

        <br><br>
        <input type="radio" name="data" id="view">View</button> 
        <input type="radio" name="data" id="add">Add</button> 
        <input type="radio" name="data" id="modify">Modify</button> 
        <input type="radio" name="data" id="delete">Delete</button> 
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>

        <div class="view" hidden>
            <?php
                $sql = "SELECT S_id, S_name, S_gender, S_DOB, S_email, S_address, S_phone_No, S_start_date, S_type, M_S_id
                        FROM staff";
                $result = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<tr>";
                echo "<td>Staff ID<td>Name<td>Gender<td>DOB<td>Email<td>Address<td>Phone No<td>Start Date<td>Type<td>Manager ID<td>";
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

        <div class="add" hidden>
            <form style="text-align:center" method="post" action="crudStaff.php">

                <br><br>
                <div > <label>Staff Id : </label>
                    <input type="number" placeholder="Enter Staff ID" name="S_id" required>
                </div>
                <div> <label>Staff Name : </label>
                    <input type="text" placeholder="Enter Staff Name" name="S_name" required>
                </div>
                <div> <label>Gender : </label>
                <select name="S_gender" id="S_gender" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div> <label>Date of Birth : </label>
                    <input type="date" placeholder="Enter Birth Date" name="S_DOB" required>
                </div>
                <div> <label>Address : </label>
                    <input type="text" placeholder="Enter Address" name="S_address" required>
                </div>
                <div> <label>Phone No : </label>
                    <input type="text" placeholder="Enter Phone No" name="S_phone_No" required>
                </div>
                <div> <label>Start Date : </label>
                    <input type="date" placeholder="Enter Start Date" name="S_start_date" required>
                </div>
                <div> <label>Type : </label>
                    <select name="S_type" id="S_type" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="MGR">Manager</option>
                        <option value="FD">Front Desk</option>
                    </select>
                </div>
                <div> <label>Email : </label>
                    <input type="text" placeholder="Enter Email" name="S_email" required>
                </div>
                <div> <label>Password : </label>
                    <input type="text" placeholder="Enter Password" name="S_password" required>
                </div>


                <div><button type="submit" name="add" style="height:23px; width: 55px">Add</button> </div>
            </form>

        </div>

        <div class="modify" hidden>
            <form style="text-align:center" method="post" action="crudStaff.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select S_id from staff";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="S_id">Staff ID :</label>
                    <select name="S_id" id="S_id" required>
                        <option value="" selected disabled hidden>
                            Select Staff ID to be modified
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($S_id);
                                $S_id = $row['S_id'];
                                echo '<option value=" '.$S_id.'"  >'.$S_id.'</option>';
                            }
                        ?>
                    </select><br><br>
                </div>
                <div>
                    <label for="field">Field : </label>
                    <select name="field" id="field" required>
                        <option value="" selected disabled hidden>
                            Select Field to be modified
                        </option>
                        <option value="S_name">Name</option>
                        <option value="S_gender">Gender</option>
                        <option value="S_DOB">Date of Birth</option>
                        <option value="S_email">Email</option>
                        <option value="S_address">Address</option>
                        <option value="S_phone_No">Phone No</option>
                        <option value="S_start_date">Start Date</option>
                        <option value="M_end_date">End Date</option>
                        <option value="S_type">Type</option>
                        <option value="M_S_id">Manager ID</option>
                    </select>
                </div><br>
                <div> <label>Enter New Value : </label>
                    <input type="text" placeholder="Enter value" name="value" required>
                </div><br>
                <div><button type="submit" name="modify" style="height:23px; width: 55px">Modify</button> </div>
            </form>

        </div>                       

        <div class="delete" hidden>
            <form style="text-align:center" method="post" action="crudStaff.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select S_id from staff where S_type='FD'";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="S_id">Staff ID :</label>
                    <select name="S_id" id="S_id" required>
                        <option value="" selected disabled hidden>
                            Select Staff ID to be deleted
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($S_id);
                                $S_id = $row['S_id'];
                                echo '<option value=" '.$S_id.'"  >'.$S_id.'</option>';
                            }
                        ?>
                    </select><br><br>
                </div>

                <div><button type="submit" name="delete" style="height:23px; width: 55px">Delete</button> </div>
            </form>

        </div>      

        <?php
        if (isset($_POST['add'])) {
            extract($_POST);
            $sql = "INSERT INTO staff (S_id, S_name, S_gender, S_DOB, S_email, S_address, S_phone_No, S_start_date, S_type, S_password, M_S_id) 
                    VALUES ('$S_id', '$S_name', '$S_gender', '$S_DOB', '$S_email', '$S_address', '$S_phone_No', '$S_start_date', '$S_type','$S_password','$S_Id');";
            //  echo "$sql";
            // echo "$sql1";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Staff Added Successfully');
                window.location.href='crudStaff.php';
                </script>";
            } else {
                echo "<script>
                alert('Failed');
                window.location.href='crudStaff.php';
                </script>";
            }
        }
////////////////////
        if (isset($_POST['modify'])) {
            extract($_POST);
            $S_id = str_replace(' ', '', $S_id);
            $sql = "update staff set $field = '$value' where S_id = '$S_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Staff Detail Updated');
                window.location.href='crudStaff.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error while Modifying');
                window.location.href='crudStaff.php';
                </script>";
            }
        }

        if (isset($_POST['delete'])) {
            extract($_POST);
            $S_id = str_replace(' ', '', $S_id);
            $sql = "delete from staff where S_id = '$S_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Staff Deleted');
                window.location.href='crudStaff.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error while Deleting');
                window.location.href='crudStaff.php';
                </script>";
            }
        }

        ?>

    </section>
</body>

</html> 