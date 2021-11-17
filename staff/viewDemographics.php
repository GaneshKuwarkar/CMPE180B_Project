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



    #viewStaffDemographics:checked~.viewStaffDemographics {

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

        <input type="radio" name="data" id="viewStaffDemographics">Staff Demographics</button>

        <input type="radio" name="data" id="viewClassDemographics">Class Demographics</button>

        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>



        <div class="viewMemberDemographics" hidden>

            <?php

            $sql = "select M_id,M_name,M_gender,M_DOB,M_email,M_address,M_phone_No,S_id,MP_id from member";

            $sql1 = "select count(M_id) from member";

            $sql2 = "select count(M_id) as total_active_members from member natural join membership where M_end_date > curdate()";

            $sql3 = "select count(M_gender) from member where M_gender = 'F' and M_end_date > curdate()";

            $sql4 = "select count(M_gender) as male_members from member where M_gender = 'M' and M_end_date > curdate()";

            $sql5 = "select count(M_id) as age_group_members from member where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425) <25";

            $sql6 = "select count(M_id) as age_group_members from member where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425) between 25 and 35";

            $sql7 = "select count(M_id) as age_group_members from member where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425) between 35 and 50";

            $sql8 = "select count(M_id) as age_group_members from member where M_end_date > curdate() and (datediff(curdate(), M_DOB) / 365.2425)>50";

            $result = mysqli_query($conn, $sql);

            $result1 = mysqli_query($conn, $sql1);

            $result2 = mysqli_query($conn, $sql2);

            $result3 = mysqli_query($conn, $sql3);

            $result4 = mysqli_query($conn, $sql4);

            $result5 = mysqli_query($conn, $sql5);

            $result6 = mysqli_query($conn, $sql6);

            $result7 = mysqli_query($conn, $sql7);

            $result8 = mysqli_query($conn, $sql8);

            echo "<br>";

            echo "<table border='1' align='center'>";

            echo "<tr>";

            echo "<td>ID<td>Member Name<td>Gender<td>DOB<td>Email ID<td>Address<td>Phone<td>Membership offered by Staff ID<td>Membership ID<td>";

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

                    echo  "<h3>Active Female Members : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row4 = mysqli_fetch_assoc($result4)) {



                foreach ($row4 as $field => $value) {

                    echo  "<h3>Active Male Members : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row5 = mysqli_fetch_assoc($result5)) {



                foreach ($row5 as $field => $value) {

                    echo  "<h3>Active Members in Age Group <25 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row6 = mysqli_fetch_assoc($result6)) {



                foreach ($row6 as $field => $value) {

                    echo  "<h3>Active Members in Age Group 25 to 35 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row7 = mysqli_fetch_assoc($result7)) {



                foreach ($row7 as $field => $value) {

                    echo  "<h3>Active Members in Age Group 35 to 50 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row8 = mysqli_fetch_assoc($result8)) {



                foreach ($row8 as $field => $value) {

                    echo  "<h3>Active Members in Age Group > 50 : $value<h3>";
                }

                echo "</tr>";
            }

            ?>

        </div>



        <div class="viewInstructorDemographics" hidden>

            <?php

            $sql = "select I_id,I_name,I_gender,I_DOB,I_phone_No,I_start_date,Manager_S_id from instructor";

            $sql1 = "select count(I_id) as total_instructors from instructor";

            $sql2 = "select count(I_gender) as female_instructors from instructor where I_gender = 'F'";

            $sql3 = "select count(I_gender) as male_instructors from instructor where I_gender = 'M'";

            $sql4 = "select count(I_id) as age_group_instructors from instructor where (datediff(current_date, I_DOB) / 365.2425) between 20 and 30";

            $sql5 = "select count(I_id) as age_group_instructors from instructor where (datediff(current_date, I_DOB) / 365.2425) between 30 and 40";

            $sql6 = "select count(I_id) as age_group_instructors from instructor where (datediff(current_date, I_DOB) / 365.2425)>40";

            $result = mysqli_query($conn, $sql);

            $result1 = mysqli_query($conn, $sql1);

            $result2 = mysqli_query($conn, $sql2);

            $result3 = mysqli_query($conn, $sql3);

            $result4 = mysqli_query($conn, $sql4);

            $result5 = mysqli_query($conn, $sql5);

            $result6 = mysqli_query($conn, $sql6);

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

                    echo  "<h3>Total Instructors : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row2 = mysqli_fetch_assoc($result2)) {



                foreach ($row2 as $field => $value) {

                    echo  "<h3>Female Instructors : $value<h3>";
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

                    echo  "<h3>Instructors in Age Group 20 to 30 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row5 = mysqli_fetch_assoc($result5)) {



                foreach ($row5 as $field => $value) {

                    echo  "<h3>Instructors in Age Group 30 to 40 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row6 = mysqli_fetch_assoc($result6)) {



                foreach ($row6 as $field => $value) {

                    echo  "<h3>Instructors in Age Group >40 : $value<h3>";
                }

                echo "</tr>";
            }

            ?>

        </div>



        <div class="viewStaffDemographics" hidden>

            <?php

            $sql = "select S_id,S_name,S_gender,S_DOB,S_email,S_address,S_phone_No,S_start_date,S_type,M_S_id from staff";

            $sql1 = "select count(S_id) as total_staffs from staff";

            $sql2 = "select count(S_gender) as female_staffs from staff where S_gender = 'F'";

            $sql3 = "select count(S_gender) as male_staffs from staff where S_gender = 'M'";

            $sql4 = "select count(S_id) as age_group_staffs from staff where (datediff(current_date, S_DOB) / 365.2425) between 20 and 30";

            $sql5 = "select count(S_id) as age_group_staffs from staff where (datediff(current_date, S_DOB) / 365.2425) between 30 and 40";

            $sql6 = "select count(S_id) as age_group_staffs from staff where (datediff(current_date, S_DOB) / 365.2425)>40";

            $result = mysqli_query($conn, $sql);

            $result1 = mysqli_query($conn, $sql1);

            $result2 = mysqli_query($conn, $sql2);

            $result3 = mysqli_query($conn, $sql3);

            $result4 = mysqli_query($conn, $sql4);

            $result5 = mysqli_query($conn, $sql5);

            $result6 = mysqli_query($conn, $sql6);



            echo "<br>";

            echo "<table border='1' align='center'>";

            echo "<tr>";

            echo "<td>ID<td>Staff Name<td>Gender<td>DOB<td>Email ID<td>Address<td>Phone<td>Start Date<td>Staff Type<td>Manager ID<td>";

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

                    echo  "<h3>Total staffs : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row2 = mysqli_fetch_assoc($result2)) {



                foreach ($row2 as $field => $value) {

                    echo  "<h3>Female staffs : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row3 = mysqli_fetch_assoc($result3)) {



                foreach ($row3 as $field => $value) {

                    echo  "<h3>Male staffs : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row4 = mysqli_fetch_assoc($result4)) {



                foreach ($row4 as $field => $value) {

                    echo  "<h3>Staffs in Age Group 20 to 30 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row5 = mysqli_fetch_assoc($result5)) {



                foreach ($row5 as $field => $value) {

                    echo  "<h3>Staffs in Age Group 30 to 40 : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row6 = mysqli_fetch_assoc($result6)) {



                foreach ($row6 as $field => $value) {

                    echo  "<h3>Staffs in Age Group >40 : $value<h3>";
                }

                echo "</tr>";
            }

            ?>

        </div>

        <div class="viewClassDemographics" hidden>

            <?php

            $sql = "select C_id,C_name,C_scale,C_duration,C_start_time,C_day,C_room,c.I_id,I_name from class as c join instructor as i on c.I_id = i.I_id";

            $sql1 = "select count(C_id) as total_classes from class";

            $sql2 = "select count(C_id) as num_Morning_class from class where C_start_time >= '06:00:00' and C_start_time <= '11:59:59'";

            $sql3 = "select count(C_id) as num_Afternoon_class from class where C_start_time >= '12:00:00' and C_start_time <= '17:59:59'";

            $sql4 = "select count(C_id) as num_Evening_class from class where C_start_time >= '18:00:00' and C_start_time <= '23:59:59'";



            $sql5 = "select count(C_id) as num_Mon_class from class where C_day = 'Monday'";

            $sql6 = "select count(C_id) as num_Tue_class from class where C_day = 'Tuesday'";

            $sql7 = "select count(C_id) as num_Wed_class from class where C_day = 'Wednesday'";

            $sql8 = "select count(C_id) as num_Thu_class from class where C_day = 'Thursday'";

            $sql9 = "select count(C_id) as num_Fri_class from class where C_day = 'Friday'";

            $sql10 = "select count(C_id) as num_Sat_class from class where C_day = 'Saturday'";

            $sql11 = "select count(C_id) as num_Fri_class from class where C_day = 'Sunday'";



            $result = mysqli_query($conn, $sql);

            $result1 = mysqli_query($conn, $sql1);

            $result2 = mysqli_query($conn, $sql2);

            $result3 = mysqli_query($conn, $sql3);

            $result4 = mysqli_query($conn, $sql4);

            $result5 = mysqli_query($conn, $sql5);

            $result6 = mysqli_query($conn, $sql6);

            $result7 = mysqli_query($conn, $sql7);

            $result8 = mysqli_query($conn, $sql8);

            $result9 = mysqli_query($conn, $sql9);

            $result10 = mysqli_query($conn, $sql10);

            $result11 = mysqli_query($conn, $sql11);



            echo "<br>";

            echo "<table border='1' align='center'>";

            echo "<tr>";

            echo "<td>ID<td>Class Name<td>Scale<td>Duration<td>Start Time<td>Day<td>Room<td>Instructor ID<td>Instructor Name<td>";

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

            while ($row2 = mysqli_fetch_assoc($result2)) {



                foreach ($row2 as $field => $value) {

                    echo  "<h3>Morning Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row3 = mysqli_fetch_assoc($result3)) {



                foreach ($row3 as $field => $value) {

                    echo  "<h3>Afternoon Casses : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row4 = mysqli_fetch_assoc($result4)) {



                foreach ($row4 as $field => $value) {

                    echo  "<h3>Evening Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row5 = mysqli_fetch_assoc($result5)) {



                foreach ($row5 as $field => $value) {

                    echo  "<h3>Monday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row6 = mysqli_fetch_assoc($result6)) {



                foreach ($row6 as $field => $value) {

                    echo  "<h3>Tuesday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row7 = mysqli_fetch_assoc($result7)) {



                foreach ($row7 as $field => $value) {

                    echo  "<h3>Wednesday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row8 = mysqli_fetch_assoc($result8)) {



                foreach ($row8 as $field => $value) {

                    echo  "<h3>Thursday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row9 = mysqli_fetch_assoc($result9)) {



                foreach ($row9 as $field => $value) {

                    echo  "<h3>Friday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row10 = mysqli_fetch_assoc($result10)) {



                foreach ($row10 as $field => $value) {

                    echo  "<h3>Saturday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            while ($row11 = mysqli_fetch_assoc($result11)) {



                foreach ($row11 as $field => $value) {

                    echo  "<h3>Sunday Classes : $value<h3>";
                }

                echo "</tr>";
            }

            ?>

        </div>



    </section>

</body>



</html>