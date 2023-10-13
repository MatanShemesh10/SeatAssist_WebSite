<!DOCTYPE html>
<html>
<head>
    <title>Seat Assist - Report</title>
    <link rel="stylesheet" href="../css/ReportPageCSS.css">
    <meta charset="utf-8" />
    
    <script src="../pages/NightModeScript.js"></script>

    <script>
        function updateValue(val) {
            document.getElementById('rangeValue').textContent = val;
        }
    </script>

<?php
    
        echo '<script>    
        function clearAll() 
        {
            document.getElementById("InfoTextArea").value = "";
            var inputs = document.querySelectorAll("input:not([readonly]), select, textarea");

            for (var i = 0; i < inputs.length; i++) //loop in php
            {
                var input = inputs[i];
                var fieldName = input.getAttribute("name");
                if (fieldName == null) 
                {
                    continue;
                }
                if (fieldName.includes("username") || fieldName.includes("useremail") || fieldName.includes("clear") || fieldName.includes("submit")) //string function in php
                {
                    continue;
                }

                input.value = \'\';
            }
        }

        function verifyHuman() // using php without the db! 
        {
            var areYouSure = window.prompt("Are you sure all the details in the form are correct? If so, write yes","Enter your answer");
            if (areYouSure == "yes") //string function using php without the db!
            {
                var numberReportObj = document.getElementById("numberReport").value;
                var rangeReportObj = document.getElementById("rangeReport").value;
                var colorReportObj = document.getElementById("colorReport").value;
                var booleanArray = [true, true, true]; //array in php !

                numberReportObj = (numberReportObj * 1000) / 1000; //mathematical calculation using php without the db !

                if (numberReportObj != 23) //loop using php without the db!
                    booleanArray[0] = false;
                if (rangeReportObj != 97)
                    booleanArray[1] = false;
                if (colorReportObj != "#ff0000")
                    booleanArray[2] = false;

                if (!booleanArray[0] || !booleanArray[1] ||!booleanArray[2])
                {
                    alert("You failed the human verification or you are just a robot!");
                    clearAll();
                } 
                else 
                {
                    alert("The report was sent successfully!");
                    return;
                }
            }
            else
            return;


            
        }
        </script>';
 

?>



</head>
<body>
    <header>
        <img class="logo" src="../logos/row logo white.png" alt="Logo">
    </header>
    <div class="sidebar-container">

        <table class="nightModeTable">
            <tr>
                <td><p><b>Night Mode</b></p></td>
                <td> <label class="switch"> 
                    <input type="checkbox" id="NightMode" onchange="changeNightMode()">
                    <span class="slider round"></span>
                    </label>
                </td>
            </tr>
        </table>


        <div class="userblock">
            <table>
                <tr>
                    <td><img class="userimg" src="../photos/userphoto.jpg" /></td>
                    <td>
                        <?php
                        session_start();
                        if ($_SESSION['isLoggedIn'] === true)
                        {
                            $_username = $_SESSION['username'];
                            $_userid = $_SESSION['userid'];

                            echo "<p>Hello, <b>$_username</b></p>";
                        }
                        else
                        {
                            header('Location: index.php');
                        }

                        ?>
                        <p>
                            <a href="profile.php"><img class="iconsBar" src="../icons/profile_icon.png" /></a>
                            <a href="neworder.php"><img class="iconsBar" src="../icons/add_icon.png" /></a>
                            <a href="report.php"><img class="iconsBar" src="../icons/report_icon.png" /></a>
                        </p>
                        <b></b>
                        <a href="index.php"><p>Logout</p></a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="sidebar">
            <h2>Dashboard</h2>
            <a href="home.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="myorders.php">My Orders</a>
            <a href="neworder.php">New Order</a>
            <a href="report.php">Report</a>


        </div>
    </div>
    <div class="center" style="background-color:white">
        <form action="report.php" method="POST">
        <table class="reportTABLE">
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="username" name="username" readonly></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="useremail" name="useremail" readonly></td>
            </tr>
            <tr>
                <td><label for="telephone">Phone:</label></td>
                <td><input type="tel" id="tel" name="tel" required></td>
            </tr>
            <tr>
                <td><label for="SeatNumber">Floor and chair:</label></td>
                <td>

                    <input list="browsers1" name="FloorChair" id="FloorChair" required>
                    <datalist id="browsers1">
                        <option value="Floor 1 Chair 101">
                        <option value="Floor 1 Chair 102">
                        <option value="Floor 1 Chair 103">
                        <option value="Floor 1 Chair 104">
                        <option value="Floor 1 Chair 105">
                        <option value="Floor 1 Chair 106">
                        <option value="Floor 1 Chair 107">
                        <option value="Floor 1 Chair 108">
                        <option value="Floor 1 Chair 109">
                        <option value="Floor 1 Chair 110">
                        <option value="Floor 2 Chair 201">
                        <option value="Floor 2 Chair 202">
                        <option value="Floor 2 Chair 203">
                        <option value="Floor 2 Chair 204">
                        <option value="Floor 2 Chair 205">
                        <option value="Floor 2 Chair 206">
                        <option value="Floor 2 Chair 207">
                        <option value="Floor 2 Chair 208">
                        <option value="Floor 2 Chair 209">
                        <option value="Floor 2 Chair 210">
                        <option value="Floor 3 Chair 301">
                        <option value="Floor 3 Chair 302">
                        <option value="Floor 3 Chair 303">
                        <option value="Floor 3 Chair 304">
                        <option value="Floor 3 Chair 305">
                        <option value="Floor 3 Chair 306">
                        <option value="Floor 3 Chair 307">
                        <option value="Floor 3 Chair 308">
                        <option value="Floor 3 Chair 309">
                        <option value="Floor 3 Chair 310">
                    </datalist>
            </tr>
                
            <tr>
                <td><label for="date">Date of discovery:</label></td>
                <td><input type="date" id="dateReport" name="dateReport" required></td>
            </tr>
            <tr>
                <td><label for="time">Time of discovery:</label></td>
                <td><input type="time" id="timeReport" name="timeReport" required></td>
            </tr>
            <tr>
                <td><label for="Category">Category</label></td>
                <td>
                    <input list="browsers" name="browser" id="browser" required>
                    <datalist id="browsers">
                        <option value="Network problems">
                        <option value="Peripheral equipment">
                        <option value="Furniture item">
                        <option value="Other">
                    </datalist>
                </td>
            </tr>
            <tr>
                <td><label for="TheInfo">Info:</label></td>
                <td><textarea id="InfoTextArea" rows="5" cols="40" required></textarea> </td>
            </tr>
            <tr>
                <td><label for="file">Photo/file</label></td>
                <td><input type="file" id="fileReport" name="fileReport"></td>
            </tr>
            <tr>
                <td colspan="2"><label for="TheInfo">Verify you are human:</label></td>
            </tr>
            <tr>
                <td><label for="number">Write the number 23:</label></td>
                <td><input type="number" id="numberReport" name="numberReport" required></td>
            </tr
            <tr>
                <td><label for="range">Choose the number 97:</label></td>
                <td><input type="range" id="rangeReport" name="rangeReport" min="0" max="100" oninput="updateValue(this.value)" required></td>
                <td><p id="rangeValue">0</p></td>
            </tr>
            <tr>
                <td><label for="date">Choose the color red:</label></td>
                <td><input type="color" id="colorReport" name="colorReport" required></td>
            </tr
            <tr>
                <td colspan="2" class="thebuttons">
                    <input class="myBTN" type="button" id="clear" value="Clear" name="clear" onclick="clearAll()" required>
                    <input class="myBTN" type="submit" id="submit" value="Submit" name="submit" onclick="verifyHuman()" required>
                </td>
            </tr>

        </table>
        </form>

    </div>

    <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>



<?php
session_start(); // Start the session
    $userid = $_SESSION['userid'];
    
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
    
$userid = $_SESSION['userid'];
$insertQuery = "SELECT * FROM User WHERE id = '$userid'";
$result = $mysqli->query($insertQuery);

if ($result->num_rows == 1) 
{
    $user = $result->fetch_assoc();
    $_username = $user['name'];
    $_userEmail= $user['email'];

    echo 
        '<script>
            var nameInput = document.getElementById("username");
            nameInput.value = "'.$_username.'" ;

            var emailInput = document.getElementById("useremail");
            emailInput.value = "'.$_userEmail.'" ;
        </script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $companyNumber = $_POST['companynumber'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $telephone = $_POST['tel'];
  $FloorChair = $_POST['FloorChair'];
  $seatNumber = $_POST['Seat Number'];
  $date = $_POST['dateReport'];
  $time = $_POST['timeReport'];
  $category = $_POST['browser'];
  $info = $_POST['InfoTextArea'];
  
  // Email parameters
  $recipient = "smatan10@gmail.com";
  $subject = "Seat Assist: report from $userid";
  $message = "
    Company Number: $companyNumber\n
    Name: $name\n
    Email: $email\n
    Phone: $telephone\n
    Floor and chair: $FloorChair\n
    Date of Discovery: $date\n
    Time of Discovery: $time\n
    Category: $category\n
    Info: $info\n
  ";
  
  // Send the email
  if (mail($recipient, $subject, $message))
  {
      echo '<script> alert("The mail report sent successfully.");</script>';
  }

  $mysqli->close();          
  exit();
}
?>

</body>
</html>