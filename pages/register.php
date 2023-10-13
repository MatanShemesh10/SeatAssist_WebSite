<!DOCTYPE html>   
<html>   
<head>
    <meta charset="utf-8" />
    <title> Seat Assist - Register </title>
    <link rel="stylesheet" href="../css/RegisterPageCSS.css">

      <script src="alert.php"></script>

</head>    
<body onload="clean_my_p">
    <form method="POST" action="register.php">

    <div class="container">
        <img src="../logos/whitelogo.png" class="login_img" />

        <div class="loginBox">

            <label><b>Full Name : </b></label>
            <input type="text" placeholder="Enter Full Name" name="fullname" required>
            <br />
            <label><b>Username : </b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            <br />
            <label><b>Password : </b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            <br />
            <label><b>Re-Password: </b></label>
            <input type="password" placeholder="Re-enter Password" name="confirmPassword" id="confirmPassword" required onchange="checkPassword()">
            <br />
            <input type="submit" id="loginBTN" value="Register Now!">
            <br /><p>Return to <a href="index.php"><b>Login page</b></a></p>

        </div>
    </div>

   <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>
    
    <script>
    function checkPassword() {

    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password === confirmPassword) {
        // Passwords match, proceed with registration
        return;
    } else {
        // Passwords don't match, display an error message
        alert('Passwords do not match. Please try again.');
        document.getElementById('password').value = '';
        document.getElementById('confirmPassword').value = '';
    }
    }

    
    </script>


    
</form>

<?php
$redirectToLogin = false;
unset($_SESSION['EmailExist']);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $USERfullname = $_POST['fullname'];
    $USERemail = $_POST['email'];
    $USERpassword = $_POST['password'];

    // Database credentials
    $host = 'sql210.byethost32.com';
    $username = 'b32_34192970';
    $dbPassword = 'matan123';
    $database = 'b32_34192970_SeatAssist';

    // Connect to the database
    $mysqli = new mysqli($host, $username, $dbPassword, $database);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die('Connection Error: ' . $mysqli->connect_error);
    }

    // Check if the email already exists in the database
    $query = "SELECT * FROM User WHERE email = '$USERemail'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        // Email already exists
        $_SESSION['EmailExist'] =true;
    } 
    else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO User (email, password, name) VALUES ('$USERemail', '$USERpassword','$USERfullname')";
        if ($mysqli->query($insertQuery)) {

            session_start();
            $_SESSION['Registrationsuccessful'] = true;
            header("Location: index.php");
            exit();
        }
    }

    if ($_SESSION['EmailExist'] == true)
    {
        echo '<script>alert("This email is already exists! please choose another email")</script>';
        $_SESSION['EmailExist'] = false;
        unset($_SESSION['EmailExist']);
    }

    // Close the database connection
    $mysqli->close();
    exit();
}

?>


</body>     
</html>  