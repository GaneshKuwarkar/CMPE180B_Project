<!DOCTYPE html>
<?php
session_start(); // echo $_SESSION['ID'];
include("../connect.php");
$M_Id = $_SESSION['ID'];
?>
<html lang="en" dir="ltr">

<style>
    #view:checked~.view {
        display: block;
    }

    #pay:checked~.pay {
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

        <h1>Payment Records</h1>



        <input type="radio" name="data" id="view">View Payment Records</button>
        <button type="submit" onclick="window.location='staffHome.php';" name="back">Back</button>


        <!-- <div class="pay" hidden>
            <form style="text-align:center" method="post" action="memberPayment.php">
                <br><br>
                <div> <label>Payment Method : </label>
                    <input type="text" placeholder="Enter Payment Method" name="method" required>
                </div>
                <div> <label>Transaction Id : </label>
                    <input type="text" placeholder="Enter Transaction Id" name="p_id" required>
                </div>
                <div> <label> Amount : </label>
                    <input type="number" placeholder="Enter Amount" name="amount" required>
                </div>
                <div><button type="submit" name="payment" style="height:23px; width: 55px">Pay</button> </div>
            </form>
        </div> -->




        <div class="view" hidden>
            <?php
            $sql = "select * from payment";
            $result = mysqli_query($conn, $sql);
            echo "<br>";
            echo "<table border='1' align='center'>";
            echo "<tr>";
            echo "<td>Payment ID<td>Payment Method<td>Amount<td>Time<td>Date<td>Member ID<td>";
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

        <?php
        if (isset($_POST['payment'])) {
            extract($_POST);

            $sql = "insert into payment values('$p_id', '$method', '$amount', curtime(), curdate(), '$M_Id')";
            //echo print($row['M_id']);
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Payment successful');
                window.location.href='memberPayment.php';
                </script>";
            } else {
                echo "<script>
                alert('Payment failed');
                window.location.href='memberPayment.php';
                </script>";
            }
        }
        ?>
    </section>
</body>

</html> 