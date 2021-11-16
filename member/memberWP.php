<!DOCTYPE html>
<?php
    session_start();// echo $_SESSION['ID'];
    include("../connect.php");
    $M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
#status:checked ~ .status
{
    display:block;
}
#plan:checked ~ .plan
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
        
        <h1>Workout Plan</h1>

        <div class="view" >
            <?php
                $sql = "select M.WP_status, WP.WP_difficulty 
                        from member M inner join workout_plan WP
                        on M.WP_id = WP.WP_id and M.M_id = '$M_Id'";
                $result = mysqli_query($conn, $sql);
                $data = $result->fetch_assoc();
                // echo $data["WP_status"];
                // echo $data["WP_difficulty"];
                echo "<br><br><h2>";
                echo "Your Workout Status :  ";
                echo $data["WP_status"];
                
                echo "<br><br>Your Workout Plan :  ";
                echo $data["WP_difficulty"];
                echo "</h2>";

            ?>
        </div>
        <br><br>
        <input type="radio" name="data" id="status">Change Workout Status</button> 
        <input type="radio" name="data" id="plan">Change Workout Plan</button> 
        <button type="submit" onclick="window.location='memberHome.php';" name="back">Back</button>


        <div class="status" hidden>
            <form style="text-align:center" method="post" action="memberWP.php">
                <br><br>
                <div > 
                    <label for="newstatus">Select Workout Status:</label>
                    <select name="newstatus" id="newstatus" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="InProgress">InProgress</option>
                        <option value="Complete">Complete</option>
                    </select>
                </div><br>
                <div><button type="submit" name="status" >Update</button> </div>
            </form>
        </div>

        <div class="plan" hidden>
            <form style="text-align:center" method="post" action="memberWP.php">
                <br><br>
                <div > 
                    <label for="newplan">Select Workout Plan:</label>
                    <select name="newplan" id="newplan" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div><br>
                <div><button type="submit" name="plan" >Update</button> </div>
            </form>
        </div>



        <?php
        if (isset($_POST['status'])) {
            extract($_POST);
            $sql = "update member set WP_status = '$newstatus' where M_id = '$M_Id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Status Changed Successful');
                window.location.href='memberWP.php';
                </script>";
            } else {
                echo "<script>
                alert('Status Change Failed');
                window.location.href='memberWP.php';
                </script>";
            }
        }

        if (isset($_POST['plan'])) {
            extract($_POST);
            $sql = "update member M 
                    set M.WP_id = (select WP.WP_id from workout_plan WP where WP.WP_difficulty = '$newplan') 
                    where M.M_id = '$M_Id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Plan Changed Successful');
                window.location.href='memberWP.php';
                </script>";
            } else {
                echo "<script>
                alert('Plan Change Failed');
                window.location.href='memberWP.php';
                </script>";
            }
        }
        ?>
    </section>
</body>

</html>