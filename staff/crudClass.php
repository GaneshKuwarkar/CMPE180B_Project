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

        <h1>Class</h1>

        <br><br>
        <input type="radio" name="data" id="view">View</button> 
        <input type="radio" name="data" id="add">Add</button> 
        <input type="radio" name="data" id="modify">Modify</button> 
        <input type="radio" name="data" id="delete">Delete</button> 
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>

        <div class="view" hidden>
            <?php
                $sql = "select C.C_id, C.C_name, C.C_scale, C.C_enrolled, C.C_duration, C.C_start_time, C.C_day, C.C_room,I.I_id, I.I_name 
                        from class C  
                        inner join instructor I on C.I_id = I.I_id  ";
                $result = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<tr>";
                echo "<td>Class ID<td>Class Name<td>Capacity<td>Enrolled<td>Duration<td>Start Time<td>Day<td>Room<td>Instructor ID<td>Instructor Name<td>";
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
            <form style="text-align:center" method="post" action="crudClass.php">

                <br><br>
                <div > <label>Class Id : </label>
                    <input type="number" placeholder="Enter Class ID" name="C_id" required>
                </div>
                <div> <label>Class Name : </label>
                    <input type="text" placeholder="Enter Class Name" name="C_name" required>
                </div>
                <div> <label>Capacity : </label>
                    <input type="number" placeholder="Enter Capacity" name="C_scale" required>
                </div>
                <div> <label>Duration : </label>
                    <input type="number" placeholder="Enter Duration" name="C_duration" required>
                </div>
                <div> <label>Start Time : </label>
                    <input type="time" placeholder="Enter Start Time" name="C_start_time" required>
                </div>
                <div>
                    <label for="C_day">Day : </label>
                    <select name="C_day" id="C_day" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
                <div> <label>Room : </label>
                    <input type="text" placeholder="Enter Room" name="C_room" required>
                </div>
                <div>
                    <?php
                        $sql = "select I_id from instructor";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="I_id">Instructor ID:</label>
                    <select name="I_id" id="I_id">
                        <option value="" selected disabled hidden>
                                Select an Option
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($I_id);
                                $I_id = $row['I_id'];
                                echo '<option value=" '.$I_id.'"  >'.$I_id.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div><button type="submit" name="add" style="height:23px; width: 55px">Add</button> </div>
            </form>

        </div>

        <div class="modify" hidden>
            <form style="text-align:center" method="post" action="crudClass.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select C_id from class";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="C_id">Class ID :</label>
                    <select name="C_id" id="C_id" required>
                        <option value="" selected disabled hidden>
                            Select Class ID to be modified
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($C_id);
                                $C_id = $row['C_id'];
                                echo '<option value=" '.$C_id.'"  >'.$C_id.'</option>';
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
                        <option value="C_name">Class Name</option>
                        <option value="C_scale">Capacity</option>
                        <option value="C_duration">Duration</option>
                        <option value="C_start_time">Start Time</option>
                        <option value="C_day">Day</option>
                        <option value="C_room">Room</option>
                    </select>
                </div><br>
                <div> <label>Enter New Value : </label>
                    <input type="text" placeholder="Enter value" name="value" required>
                </div><br>
                <div><button type="submit" name="modify" style="height:23px; width: 55px">Modify</button> </div>
            </form>

        </div>                       

        <div class="delete" hidden>
            <form style="text-align:center" method="post" action="crudClass.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select C_id from class";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="C_id">Class ID :</label>
                    <select name="C_id" id="C_id" required>
                        <option value="" selected disabled hidden>
                            Select Class ID to be deleted
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($C_id);
                                $C_id = $row['C_id'];
                                echo '<option value=" '.$C_id.'"  >'.$C_id.'</option>';
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
            $I_id = str_replace(' ', '', $I_id);
            $sql = "INSERT INTO class (C_id, C_name, C_scale, C_enrolled, C_duration, C_start_time, C_day, C_room, I_id) 
                    VALUES ('$C_id', '$C_name', '$C_scale', '0', '$C_duration', '$C_start_time', '$C_day', '$C_room', '$I_id');";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Class Added Successfully');
                window.location.href='crudClass.php';
                </script>";
            } else {
                echo "<script>
                alert('Failed');
                window.location.href='crudClass.php';
                </script>";
            }
        }
////////////////////class
        if (isset($_POST['modify'])) {
            extract($_POST);
            $C_id = str_replace(' ', '', $C_id);
            $sql = "update class set $field = '$value' where C_id = '$C_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Class Detail Updated');
                window.location.href='crudClass.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error while Modifying');
                window.location.href='crudClass.php';
                </script>";
            }
        }

        if (isset($_POST['delete'])) {
            extract($_POST);
            $C_id = str_replace(' ', '', $C_id);
            $sql = "delete from class where C_id = '$C_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Class Deleted');
                window.location.href='crudClass.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error while Deleting');
                window.location.href='crudClass.php';
                </script>";
            }
        }

        ?>

    </section>
</body>

</html> 