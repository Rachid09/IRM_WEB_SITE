<?php
require_once('connect.php');

if (isset($_POST["submit"])) {

    # code...
    try {
        $f_name = $_POST["f_name"];
        $l_name = $_POST["l_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_n"];
        echo $send_updates;

        $query = 'SELECT count(email) as num  FROM clients where email=? ';

        $stmt = $db->prepare($query);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($client['num'] > 0) {
            echo '<script> alert("this email is already existed")</script>';
        } else {
            $query = "INSERT INTO clients values ('',?,?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(1, $f_name, PDO::PARAM_STR);
            $stmt->bindValue(2, $l_name, PDO::PARAM_STR);
            $stmt->bindValue(3, $email, PDO::PARAM_STR);
            $stmt->bindValue(4, $phone_number, PDO::PARAM_STR);
            $stmt->bindValue(5, $subject, PDO::PARAM_STR);
            $stmt->bindValue(6, $send_updates, PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                # code...
                echo '<script> alert("Registration successful")</script>';
            } else {
                $error = "error :" . $e->getMessage();
                echo '<script> alert("' . $error . '")</script>';
            }
            $db = null;
        }
    } catch (PDOException $e) {
        echo 'the error is :' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</head>
<style>
    body {

        margin: 40px 100px;

    }
</style>

<body>

    <form class="form" action="register.php" method="post">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="f_name" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="l_name" />
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="text" class="form-control" name="email" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Phone Number </label>
                    <input type="text" class="form-control" name="phone_n" />
                </div>

            </div>
            <div class="col-12">
                <div class="form-group flex100">
                    <label for="">Message</label><textarea name="subject" id="" rows="10" class="form-control"></textarea><br />
                </div>

            </div>
            <div class="col-12">
                <div>
                    <input type="checkbox" name="send_updates" id="" />
                    <span for="">Send me updates about Tropical Inspireproducts and
                        services.</span>
                    <br />
                    <a href="#" class="privacy-policy">Privacy policy</a>
                </div>

            </div>
            <input type="submit" name="submit" id="submit-btn" value="SEND MESSAGE" />
        </div>
    </form>

</body>

</html>