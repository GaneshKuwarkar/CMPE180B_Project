<!DOCTYPE html>

<html lang="en" dir="ltr">
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$M_Id = $_SESSION['ID'];
?>

<style>
    #viewMemberDemographics:checked~.viewMemberDemographics {
        display: block;
    }

    #viewInstructorDemographics:checked~.viewInstructorDemographics {
        display: block;
    }

    #viewClassDemographics:checked~.viewClassDemographics {
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

        <h1>View Demographics</h1>


        <input type="radio" name="data" id="viewMemberDemographics">Member Demographics</button>
        <input type="radio" name="data" id="viewInstructorDemographics">Instructor Demographics</button>
        <input type="radio" name="data" id="viewClassDemographics">Class Demographics</button>
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>



        <!-- 
        select count(M_id) as total_members
        from member;

        select count(M_id) as total_active_members
        from member natural join membership
        where M_end_date > curdate();

        select count(M_gender) as female_members
        from member
        where M_gender = 'F' and M_end_date > curdate();

        select count(M_gender) as male_members
        from member
        where M_gender = 'M' and M_end_date > curdate();

        select count(M_id) as age_group_members
        from member
        where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425) between 20 and 50; -->



        <div class="viewMemberDemographics" hidden>
            <?php
            $sql = "select M_id,M_name,M_gender,M_DOB,M_age,M_email,M_address,M_phone_No,S_id,MP_id from member";
            $sql1 = "select count(M_id) from member";
            $sql2 = "select count(M_id) as total_active_members from member natural join membership where M_end_date > curdate()";
            $sql3 = "select count(M_gender) from member where M_gender = 'F' and M_end_date > curdate()";
            $sql4 = "select count(M_gender) as male_members from member where M_gender = 'M' and M_end_date > curdate()";
            $sql5 = "select count(M_id) as age_group_members from member where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425) between 20 and 50";
            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result4 = mysqli_query($conn, $sql4);
            $result5 = mysqli_query($conn, $sql5);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>ID<td>Member Name<td>Gender<td>DOB<td>Age<td>Email ID<td>Address<td>Phone<td>Membership offered by Staff ID<td>Membership ID<td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            while ($row1 = mysqli_fetch_assoc($result1)) {

                foreach ($row1 as $field => $value) {
                    echo  "<h3>Total Members : $value<h3>";
                }
                echo "</tr>";
            }
            //echo print_r("$result2");
            while ($row2 = mysqli_fetch_assoc($result2)) {

                foreach ($row2 as $field => $value) {
                    echo  "<h3>Total Active Members : $value<h3>";
                }
                echo "</tr>";
            }
            while ($row3 = mysqli_fetch_assoc($result3)) {

                foreach ($row3 as $field => $value) {
                    echo  "<h3>Female Members : $value<h3>";
                }
                echo "</tr>";
            }
            while ($row4 = mysqli_fetch_assoc($result4)) {

                foreach ($row4 as $field => $value) {
                    echo  "<h3>Male Members : $value<h3>";
                }
                echo "</tr>";
            }
            while ($row5 = mysqli_fetch_assoc($result5)) {

                foreach ($row5 as $field => $value) {
                    echo  "<h3>Members in Age Group 20 to 50 : $value<h3>";
                }
                echo "</tr>";
            }
            ?>
        </div>

        <!-- select count(I_id) as total_instructors
        from instructor;

        select count(I_gender) as female_instructors 
        from instructor
        where I_gender = 'F';

        select count(I_gender) as male_instructors 
        from instructor
        where I_gender = 'M';

        select count(I_id) as age_group_instructors 
        from instructor
        where (datediff(current_date, I_DOB) / 365.2425) between 20 and 50; -->


        <div class="viewInstructorDemographics" hidden>
            <?php
            $sql = "select I_id,I_name,I_gender,I_DOB,I_phone_No,I_start_date,Manager_S_id from instructor";
            $sql1 = "select count(I_id) as total_instructors from instructor ";
            $sql2 = "select count(I_gender) as female_instructors from instructor where I_gender = 'F' ";
            $sql3 = "select count(I_gender) as male_instructors from instructor where I_gender = 'M' ";
            $sql14 = "select count(I_id) as age_group_instructors from instructor where (datediff(current_date, I_DOB) / 365.2425) between 20 and 50 ";
            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);
            $result3 = mysqli_query($conn, $sql3);
            $result4 = mysqli_query($conn, $sql4);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>ID<td>Name<td>Gender<td>DOB<td>Phone ID<td>Start Date<td>Manager ID<td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            while ($row1 = mysqli_fetch_assoc($result1)) {

                foreach ($row1 as $field => $value) {
                    echo  "<h3>Total Instructors: $value<h3>";
                }
                echo "</tr>";
            }
            while ($row2 = mysqli_fetch_assoc($result2)) {

                foreach ($row2 as $field => $value) {
                    echo  "<h3>Female Instructors: $value<h3>";
                }
                echo "</tr>";
            }
            while ($row3 = mysqli_fetch_assoc($result3)) {

                foreach ($row3 as $field => $value) {
                    echo  "<h3>Male Instructors : $value<h3>";
                }
                echo "</tr>";
            }
            while ($row4 = mysqli_fetch_assoc($result4)) {

                foreach ($row4 as $field => $value) {
                    echo  "<h3>Instructors in Age Group 20 to 50 : $value<h3>";
                }
                echo "</tr>";
            }

            ?>


        </div>

        <!-- select count(C_id) as total_classes
        from class;

        select count(C_id) as num_classes_by_time
        from class
        where C_start_time between '' and '' ;

        select count(C_id) as num_classes_by_day
        from class
        where C_day = ''; -->

        <div class="viewClassDemographics" hidden>
            <?php
            $sql = "select * from class";
            $sql1 = "select count(C_id) as total_classes from class";
            // $sql2= " ";
            // $sql3= " ";
            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>ID<td>Name<td>Scale<td>Enrolled<td>Duration<td>Start time<td>Day<td>Class Room<td>Instructor ID<td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $field => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            while ($row1 = mysqli_fetch_assoc($result1)) {

                foreach ($row1 as $field => $value) {
                    echo  "<h3>Total Classes : $value<h3>";
                }
                echo "</tr>";
            }
            ?>
            <!-- <?php
                    if (isset($_POST['search'])) {
                        extract($_POST);
                        $sql6 = "select * from class where C_day='$newstatus'";
                        echo "<br>";
                        echo "<table border='1' align='center'>";
                        echo "<tr>";
                        echo "<td>ID<td>Name<td>Scale<td>Enrolled<td>Duration<td>Start time<td>Day<td>Class Room<td>Instructor ID<td>";
                        echo "</tr>";
                        $result6 = mysqli_query($conn, $sql6);

                        while ($row6 = mysqli_fetch_assoc($result6)) {
                            echo "<tr>";
                            foreach ($row6 as $field => $value) {
                                echo "<td>" . $value . "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?> -->



        </div>
        <!-- <div class="viewClassDemographics" hidden>
            <form style="text-align:center" method="post" action="viewDemographics.php">
                <br><br>
                <div>
                    <label for="newstatus">Search Classes by day:</label>
                    <select name="newstatus" id="newstatus" required>
                        <option value="" selected disabled hidden>
                            Select an Option
                        </option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div><br>
                <div><button type="submit" name="search">Search</button> </div>
            </form>
        </div> -->


    </section>
</body>

</html>