<!DOCTYPE html>   
<html>   
<head>
    <meta charset="utf-8" />
    <title> Seat Assist - Login </title>
    <link rel="stylesheet" href="../css/LoginPageCSS.css">
  


</head>    
<body>
<form method="POST" action="index.php">

    <div class="container">
        <img src="../logos/whitelogo.png" class="login_img" />

        <div class="loginBox">

            <label><b>Username : </b></label>
            <input type="email" placeholder="Enter Username" name="name" required>
            <br />
            <label><b>Password : </b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br />
            <input type="submit" id="loginBTN" value="Login" name = "Login">
            <br /><input type="checkbox" checked="checked"> Remember me
            <br /><p>Don't have a user yet? <a href="register.php"><b>Register here</b></a></p>
            <br/><p id="p_msg"> </p>

        </div>
    </div>

   <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>
    
</form>

<?php
session_start(); // Start the session
$_SESSION['isLoggedIn'] = false;
unset($_SESSION['EmailNotExist']);
unset($_SESSION['WrongPassword']);
unset($_SESSION['EmailNotExist']);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Login"])) 
{
    // Retrieve user input from the form
    $useremail = $_POST['name'];
    $userPassword = $_POST['password']; 

    // Database credentials
    $host = 'sql210.byethost32.com';
    $dbUsername = 'b32_34192970';
    $dbPassword = 'matan123'; 
    $database = 'b32_34192970_SeatAssist';

    // Connect to the database
    $mysqli = new mysqli($host, $dbUsername, $dbPassword, $database);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die('Connection Error: ' . $mysqli->connect_error);
    }

    // Query the database for the user with the provided email and password
    $query = "SELECT * FROM User WHERE email = '$useremail' AND password = '$userPassword'";
    $result = $mysqli->query($query);

    // Check if a matching user was found
    try {
            if ($result->num_rows == 1) {

                // Retrieve the user's details from the database
                $user = $result->fetch_assoc();

                // Set the login state and user email in session
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['userEmail'] = $user['email'];
                $_SESSION['userid']= $user['id'];
                $_SESSION['username']= $user['name'];

                // Redirect to the home page
                header("Location: loading.php");
                exit(); 
            } 
            
            else 
            { // User is not authenticated
                $checkExistsUser = "SELECT * FROM User WHERE email = '$useremail'";
                $resultExistsUser = $mysqli->query($checkExistsUser);

                if ($resultExistsUser->num_rows > 0) 
                {
                    $_SESSION['WrongPassword'] =true;
                    $_SESSION['EmailNotExist'] == false;
                } 
                else 
                {
                    $_SESSION['WrongPassword'] =false;

                    if ($_SESSION['EmailNotExist'] == null)
                    {
                        $_SESSION['EmailNotExist'] =true;
                    }
                    
                   

                }
            }
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    // Close the database connection
    $mysqli->close();
    unset($_POST['Login']);
}

    if ($_SESSION['WrongPassword'] == true)
    {
        echo '<script>alert("Wrong password! please try again")</script>';
        $_SESSION['WrongPassword'] = false;
        unset($_SESSION['WrongPassword']);
        
    }

     if ($_SESSION['Registrationsuccessful'] == true)
    {
        echo '<script>alert("Registration successful, You can now login with your new user !")</script>';
        $_SESSION['Registrationsuccessful'] = false;
        unset($_SESSION['Registrationsuccessful']);
    }

    if ($_SESSION['EmailNotExist'] == true)
    {
        echo '<script>alert("No user found with this email! You can register a new user")</script>';
        $_SESSION['EmailNotExist'] = false;
        unset($_SESSION['EmailNotExist']);
    }

    
exit;
?>


</body>     
</html>  