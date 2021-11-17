<!DOCTYPE html>
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">


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



        <form style="text-align:center" method="post" action="memberChangePassword.php">
            <div> <label>Enter New password : </label>
                <input type="password" placeholder="Enter value" name="value1" required>
            </div><br>
            <div> <label>Confirm New password : </label>
                <input type="password" placeholder="Enter value" name="value2" required>
            </div><br>
            <div><button type="submit" name="modify" style="height:23px; width: 55px">Modify</button> <button type="submit" onclick="window.location='memberHome.php';" name="back">Back</button> </div>
        </form>
        <?php
        if (isset($_POST['modify'])) {
            extract($_POST);
            if ($value1 == $value2) {


                $sql = "update member set M_password = aes_encrypt('$value2','key') where M_id = '$M_Id'";
                // echo $sql;

                if (mysqli_query($conn, $sql)) {
                    logger("INFO","MEMBER $M_Id UPDATED PASSWORD");
                    echo "<script>
                    alert('Member Password Updated Successfully');
                    window.location.href='memberChangePassword.php';
                    </script>";
                    if (!empty($_SERVER['HTTPS'])&& ('on' == $_SERVER['HTTPS'])) {
                        $uri = 'https://';
                    } else {
                        $uri = 'http://';
                    }
                    $uri .= $_SERVER['HTTP_HOST'];
                    header('Location: ' . $uri . '/gym/member/memberHome.php');
                } else {
                    logger("ERROR","MEMBER $M_Id PASSWORD UPDATE FAILED");
                    echo "<script>
                alert('Error while Updating Password');
                window.location.href='memberChangePassword.php';
                </script>";
                }
            } else {
                logger("ERROR","MEMBER $M_Id PASSWORD UPDATE FAILED");
                echo "Error : The above passwords do not match";
            }
        }

        ?>



    </section>
</body>

</html>