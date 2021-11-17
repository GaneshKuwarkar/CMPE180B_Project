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

        <h1>Members</h1>

        <br><br>
        <input type="radio" name="data" id="view">View</button> 
        <input type="radio" name="data" id="add">Add</button> 
        <input type="radio" name="data" id="modify">Modify</button> 
        <input type="radio" name="data" id="delete">Delete</button> 
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>

        <div class="view" hidden>
            <?php
                $sql = "SELECT M.M_id, M.M_name, M.M_gender, M.M_DOB, M.M_email, M.M_address, M.M_phone_No, M.M_start_date, M.M_end_date, S.S_name, WP.WP_difficulty, M.MP_id, MP.MP_name 
                        FROM member M 
                        LEFT JOIN membership MP ON M.MP_id = MP.MP_id 
                        LEFT JOIN staff S ON M.S_id = S.S_id 
                        LEFT JOIN workout_plan WP ON M.WP_id = WP.WP_id";
                $result = mysqli_query($conn, $sql);
                echo "<br>";
                echo "<table border='1' align='center'>";
                echo "<tr>";
                echo "<td>Member ID<td>Name<td>Gender<td>DOB<td>Email<td>Address<td>Phone No<td>Start Date<td>End Date<td>Offered By<td>Workout Plan<td>Membership ID<td>Membership<td>";
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
            <form style="text-align:center" method="post" action="crudMember.php">

                <br><br>
                <div > <label>Member Id : </label>
                    <input type="number" placeholder="Enter Member ID" name="M_id" required>
                </div>
                <div> <label>Member Name : </label>
                    <input type="text" placeholder="Enter Member Name" name="M_name" required>
                </div>
                <div> <label>Gender : </label>
                <select name="M_gender" id="M_gender" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div> <label>Date of Birth : </label>
                    <input type="date" placeholder="Enter Birth Date" name="M_DOB" required>
                </div>
                <div> <label>Address : </label>
                    <input type="text" placeholder="Enter Address" name="M_address" required>
                </div>
                <div> <label>Phone No : </label>
                    <input type="text" placeholder="Enter Phone No" name="M_phone_No" required>
                </div>
                <div> <label>Start Date : </label>
                    <input type="date" placeholder="Enter Start Date" name="M_start_date" required>
                </div>
                <div> <label>End Date : </label>
                    <input type="date" placeholder="Enter End Date" name="M_end_date" required>
                </div>
                <div> <label>Email : </label>
                    <input type="text" placeholder="Enter Email" name="M_email" required>
                </div>
                <div> <label>Password : </label>
                    <input type="text" placeholder="Enter Password" name="M_password" required>
                </div>
                <div>
                    <label for="MP_name">Membership : </label>
                    <select name="MP_name" id="MP_name" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="Platinum">Platinum</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                    </select>
                </div>

                <div><button type="submit" name="add" style="height:23px; width: 55px">Add</button> </div>
            </form>

        </div>

        <div class="modify" hidden>
            <form style="text-align:center" method="post" action="crudMember.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select M_id from member";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="M_id">Member ID :</label>
                    <select name="M_id" id="M_id" required>
                        <option value="" selected disabled hidden>
                            Select Member ID to be modified
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($M_id);
                                $M_id = $row['M_id'];
                                echo '<option value=" '.$M_id.'"  >'.$M_id.'</option>';
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
                        <option value="M_name">Member Name</option>
                        <option value="M_gender">Gender</option>
                        <option value="M_DOB">Date of Birth</option>
                        <option value="M_email">Email</option>
                        <option value="M_address">Address</option>
                        <option value="M_phone_No">Phone No</option>
                        <option value="M_start_date">Start Date</option>
                        <option value="M_end_date">End Date</option>
                        <option value="S_id">Offered by staff</option>
                        <option value="WP_id">Workout Plan ID</option>
                        <option value="MP_id">Membership ID</option>
                    </select>
                </div><br>
                <div> <label>Enter New Value : </label>
                    <input type="text" placeholder="Enter value" name="value" required>
                </div><br>
                <div><button type="submit" name="modify" style="height:23px; width: 55px">Modify</button> </div>
            </form>

        </div>                       

        <div class="delete" hidden>
            <form style="text-align:center" method="post" action="crudMember.php">

                <br><br>
                <div > 
                    </select>
                    <?php
                        $sql = "select M_id from member";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <label for="M_id">Member ID :</label>
                    <select name="M_id" id="M_id" required>
                        <option value="" selected disabled hidden>
                            Select Member ID to be deleted
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($M_id);
                                $M_id = $row['M_id'];
                                echo '<option value=" '.$M_id.'"  >'.$M_id.'</option>';
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
            $sql1 = "SELECT MP_id FROM membership where MP_name = '$MP_name'";
            $result = mysqli_query($conn, $sql1);
            $data = $result->fetch_assoc();
            $MP_id = $data["MP_id"];
            $sql = "INSERT INTO member (M_id, M_name, M_gender, M_DOB, M_email, M_address, M_phone_No, M_start_date, M_end_date, M_password, S_id, MP_id) 
                    VALUES ('$M_id', '$M_name', '$M_gender', '$M_DOB', '$M_email', '$M_address', '$M_phone_No', '$M_start_date', '$M_end_date','$M_password', '$S_Id', '$MP_id');";
            //  echo "$sql";
            // echo "$sql1";
            if (mysqli_query($conn, $sql)) {
                logger("INFO","STAFF $S_Id ADDED MEMBER $M_id");
                echo "<script>
                alert('Member Added Successfully');
                window.location.href='crudMember.php';
                </script>";
            } else {
                logger("ERROR","STAFF $S_Id ADD MEMBER FAILED");
                echo "<script>
                alert('Failed');
                window.location.href='crudMember.php';
                </script>";
            }
        }
////////////////////
        if (isset($_POST['modify'])) {
            extract($_POST);
            $M_id = str_replace(' ', '', $M_id);
            $sql = "update member set $field = '$value' where M_id = '$M_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                logger("INFO","STAFF $S_Id MODIFIED MEMBER $M_id");
                echo "<script>
                alert('Member Detail Updated');
                window.location.href='crudMember.php';
                </script>";
            } 
            else {
                logger("ERROR","STAFF $S_Id MODIFY MEMBER FAILED");
                echo "<script>
                alert('Error while Modifying');
                window.location.href='crudMember.php';
                </script>";
            }
        }

        if (isset($_POST['delete'])) {
            extract($_POST);
            $M_id = str_replace(' ', '', $M_id);
            $sql = "delete from member where M_id = '$M_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                logger("INFO","STAFF $S_Id DELETED MEMBER $M_id");
                echo "<script>
                alert('Member Deleted');
                window.location.href='crudMember.php';
                </script>";
            } 
            else {
                logger("ERROR","STAFF $S_Id DELETE MEMBER FAILED");
                echo "<script>
                alert('Error while Deleting');
                window.location.href='crudMember.php';
                </script>";
            }
        }

        ?>

    </section>
</body>

</html> 