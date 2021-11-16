<!DOCTYPE html>
<?php
    session_start();// echo $_SESSION['ID'];
    include("../connect.php");
    $S_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
#member:checked ~ .member
{
    display:block;
}
#class:checked ~ .class
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
        
        <h1>Assign Instructor</h1>

        <br><br>
        <input type="radio" name="data" id="member">Assign to Member</button> 
        <input type="radio" name="data" id="class">Assign to Class</button> 
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>

    
        <div class="member" hidden>
            <form style="text-align:center" method="post" action="assignInstructor.php">
                <br><br>
                <?php
                    $sql = "select I_id from instructor";
                    $result = mysqli_query($conn, $sql);
                ?>
                <label for="I_id">Instructor ID:</label>
                <select name="I_id" id="I_id" required>
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
                <?php
                    $sql = "select M_id from member";
                    $result = mysqli_query($conn, $sql);
                ?>
                <label for="M_id">Member ID:</label>
                    <select name="M_id" id="M_id" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($M_id);
                                $M_id = $row['M_id'];
                                echo '<option value=" '.$M_id.'"  >'.$M_id.'</option>';
                            }
                        ?>
                    </select><br><br>
                    <div><button type="submit" name="member" >Assign</button> </div>
                </div><br>
                
            </form>
        </div>
        
        <div class="class" hidden>
        <form style="text-align:center" method="post" action="assignInstructor.php">
                <br><br>
                <?php
                    $sql = "select I_id from instructor";
                    $result = mysqli_query($conn, $sql);
                ?>
                <label for="I_id">Instructor ID:</label>
                <select name="I_id" id="I_id" required>
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
                <?php
                    $sql = "select C_id from class";
                    $result = mysqli_query($conn, $sql);
                ?>
                <label for="C_id">Class ID:</label>
                    <select name="C_id" id="C_id" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                unset($C_id);
                                $C_id = $row['C_id'];
                                echo '<option value=" '.$C_id.'"  >'.$C_id.'</option>';
                            }
                        ?>
                    </select><br><br>
                    <div><button type="submit" name="class" >Assign</button> </div>
                </div><br>
                
            </form>
        </div>

        <?php
        if (isset($_POST['member'])) {
            extract($_POST);
            $M_id = str_replace(' ', '', $M_id);
            $I_id = str_replace(' ', '', $I_id);
            $sql = "insert into taught_by(M_id, I_id) values('$M_id','$I_id')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Instructor Assigned');
                window.location.href='assignInstructor.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error Assigning.. Already assigned');
                window.location.href='assignInstructor.php';
                </script>";
            }
        }
////////////////////class
        if (isset($_POST['class'])) {
            extract($_POST);
            $C_id = str_replace(' ', '', $C_id);
            $I_id = str_replace(' ', '', $I_id);
            $sql = "update class set I_id = '$I_id' where C_id = '$C_id'";
            // echo "$sql";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Instructor Assigned');
                window.location.href='assignInstructor.php';
                </script>";
            } 
            else {
                echo "<script>
                alert('Error Assigning.. Already assigned');
                window.location.href='assignInstructor.php';
                </script>";
            }
        }
        
        ?>

    </section>
</body>

</html>