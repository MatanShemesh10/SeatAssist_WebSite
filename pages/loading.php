<!DOCTYPE html>
<html>
<head>
    <title>Seat Assist</title>
    <link rel="stylesheet" href="../css/LoadingPageCSS.css">
    <meta charset="utf-8" />

    <script>
        setTimeout(function(){

        var direction="<?php 
                            session_start();
                            if ($_SESSION['isLoggedIn'] === true)
                            {
                                $_userid = $_SESSION['userid'];
                            }
                            else
                            {
                                header('Location: index.php');
                            }

                            if ($_userid == 1)
                            {
                            echo 'adminmode.php';
                            }
                            else
                            {
                            echo 'home.php';
                            }
                        ?>";

            window.location.href = direction;
        }, 3000); // 3 seconds
    </script>
    
</head>
<body>
    <div class="msgDiv">
        <h2>You've logged in successfully, we redirect you to the site...</h2>
    </div>

    <div class="container">
            <div class="theObject">
                <img class="logo" src="../logos/blacklogo.png" />
            </div>
    </div>

 

    <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>



</body>
</html>


