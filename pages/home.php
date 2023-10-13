<!DOCTYPE html>
<html>
<head>
    <title>Seat Assist - Home Page</title>
    <link rel="stylesheet" href="../css/HomePageCss.css">
    <meta charset="utf-8" />

    <script src="../pages/NightModeScript.js"></script>

    <script>
        function musicStop()
        {
            alert("What is life without music?");
        }
  </script>
        
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
        
        <audio class="myAudio" controls loop  onpause="musicStop()" autoplay>
            <source src="../photos/homepagemusic.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <dl>
        <dt><h2>Begin your Booking!</h2></dt>
        <dt><p>On this website you can book a seat in our new office.</p></dt>
        <dt>The process is simple, you choose a date and an available place on the map of the office and wait for approval.</dt>
        <dt><p>After that you are invited to arrive at the chosen time.</p></dt>
        </dl>

        
        <table class="nearestORDER">
            <tr>
                <td><p><b>Your nearest book:</b></p></td>
                <td><p id="nearestOrderDetails"></p></td>
            </tr>
        </table>

        <br/>
        <img id="officeIMG" src="../photos/officePhoto.jpg" />
        

        <script>
        const currentTime = new Date();
        const day = currentTime.getDate().toString().padStart(2, '0');
        const month = (currentTime.getMonth() + 1).toString().padStart(2, '0'); // Note: Months are zero-based
        const year = currentTime.getFullYear();
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');

        const formattedTime = 'Current time: '+ day + '/' + month + '/' + year + ' , ' + hours + ':' + minutes + ':' + seconds;

        document.write("<br/>" + formattedTime);
        </script>
    </div>
    <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>

  <?php


    session_start(); // Start the session
    $user_id = $_SESSION['userid'];
        // Database credentials
    $host = 'sql210.byethost32.com';
    $dbUsername = 'b32_34192970';
    $dbPassword = 'matan123'; 
    $database = 'b32_34192970_SeatAssist';

    $mysqli = new mysqli($host, $dbUsername, $dbPassword, $database); // Connect to the database

    // Check for connection errors
    if ($mysqli->connect_error) {
        die('Connection Error: ' . $mysqli->connect_error);
    } 


    //delete old booking
    $query = "SELECT orderId, date, floor, chair FROM Book WHERE userId = '$user_id' ORDER BY date ASC";
    $result = $mysqli->query($query);

    $currentDate1 = date("Y-m-d");

    foreach ($result as $data) {
        $rowDate = $data['date'];

        if ($rowDate < $currentDate1) {
            $orderId = $data['orderId'];
            // Perform the deletion query here
            $deleteQuery = "DELETE FROM Book WHERE orderId = '$orderId'";
            $deleteResult = $mysqli->query($deleteQuery);

            if ($deleteResult) {
                // Deletion successful
                echo '<script>console.log("Row with orderId '.$orderId.' deleted.") </script>';
            } else {
                // Deletion failed
                echo '<script>console.log("Failed to delete row with orderId '.$orderId.'.") </script>';
            }
        }

    }


    $query = "SELECT orderId, date, floor, chair FROM Book WHERE userId = '$user_id' ORDER BY date ASC";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) 
    {
        // Fetch the first row as an associative array
        $firstOrder = $result->fetch_assoc();

        $date = $firstOrder['date'];
        $floor = $firstOrder['floor'];
        $chair = $firstOrder['chair'];

        echo '<script> 
                        var nearestOrderDetails=document.getElementById("nearestOrderDetails")
                        nearestOrderDetails.innerText = "'.$date.' , floor '.$floor.' , chair '.$chair.'";
            </script>';
    } 
    elseif  ($result->num_rows == 0)
    {
        echo '<script> 
                        var nearestOrderDetails=document.getElementById("nearestOrderDetails")
                        nearestOrderDetails.innerText = "You have no booking yet";
            </script>';
    
    }
    else
    {
        echo '<script>console.log("error");</script>';
    
    }

        
     $mysqli->close();
    ?>   

    
</body>
</html>