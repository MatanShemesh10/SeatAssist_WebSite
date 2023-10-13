<!DOCTYPE html>
<html>
<head>
    <title>Seat Assist - New Order</title>
    <link rel="stylesheet" href="../css/MyOrdersPageCSS.css">
    <link rel="stylesheet" href="../css/NewOrderPageCSS.css">
    <meta charset="utf-8" />
    <script src="../pages/NightModeScript.js"></script>

</head>
<body>
<form method="POST" action="neworder.php" id = "myForm">

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

        <form action="neworder.php" method="POST">
        <div class="center" id = "center" style="background-color:white">

        </div>
        </form>


    <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>




</form>
</body>
  <?php

    function editScript($orderDate = "", $orderFloor = "", $orderChair = "", $seats= "")
    {
        echo '<script>
                var center = document.getElementById("center");
                center.innerHTML = "";
                var thisTables = document.createElement("div");
                thisTables.classList.add("thisTables");

                var h2 = document.createElement("h2");
                h2.innerHTML = "New Booking:";
                center.appendChild(h2);
                var p_book= document.createElement("p");
                p_book.innerHTML = "Please select a date, floor and seat.";
                p_book.style.fontWeight = "bold";
                center.appendChild(p_book);
                var p2_book= document.createElement("p");
                p2_book.innerHTML = "*Please note that occupied seats in spesipic date will not be shown in the list.";
                center.appendChild(p2_book);

                var table = document.createElement("table");
                table.setAttribute("class", "reportTABLE");
                var inputType = document.createElement("input");
                inputType.type = "hidden";
                inputType.name = "type";

                var tr = document.createElement("tr");
                var td = document.createElement("td");
                var input = document.createElement("input");
                input.type = "date";
                input.id = "selectDate";
                input.name = "date";
                input.addEventListener("change", function() {
                        inputType.value = "date";
                        document.getElementById("myForm").submit();
                    });
                input.value = "'.$orderDate.'";
                var currentDate = new Date();
                var formattedDate = currentDate.toISOString().split(\'T\')[0];
                input.min = formattedDate;                
                td.appendChild(input);
                tr.appendChild(td);
                table.appendChild(tr);

                var trFloor = document.createElement("tr");
                var tdFloor = document.createElement("td");
                var selectFloor = document.createElement("select");
                selectFloor.id = "selectFloor";
                selectFloor.name = "floor";
                selectFloor.required = true;
                selectFloor.addEventListener("change", function() {
                        inputType.value = "floor";
                        document.getElementById("myForm").submit();
                    });
                var option = document.createElement("option");
                option.hidden = true;
                option.value = "'.$orderFloor.'";
                option.innerHTML = "'.$orderFloor.'";
                selectFloor.appendChild(option);

                var trChair = document.createElement("tr");
                var tdChair = document.createElement("td");
                var selectChair = document.createElement("select");
                selectChair.id = "selectChair";
                selectChair.name = "chair";
                selectChair.required = true;
                var option = document.createElement("option");
                option.hidden = true;
                option.value = "'.$orderChair.'";
                option.innerHTML = "'.$orderChair.'";
                selectChair.appendChild(option);

                var seats = ' . json_encode($seats) . ';
                var selectedFloor = parseInt("'.$orderFloor.'");
                for (var i = 0; i < seats.length; i++)
                {
                    var option = document.createElement("option");
                    option.value = i + 1;
                    option.innerHTML = "" + (i + 1);
                    selectFloor.appendChild(option);
                    if(selectedFloor == 1 || selectedFloor == 2 || selectedFloor == 3){
                        for (var j = 0; j < seats[selectedFloor - 1].length; j++)
                        {
                            var option = document.createElement("option");
                            option.value = "" + seats[selectedFloor - 1][j];
                            option.innerHTML = "" + seats[selectedFloor - 1][j];
                            selectChair.appendChild(option);                        
                        }
                        selectedFloor = 0;    
                    }
                }

                tdFloor.appendChild(selectFloor);
                trFloor.appendChild(tdFloor);
                table.appendChild(trFloor);

                tdChair.appendChild(selectChair);
                trChair.appendChild(tdChair);
                table.appendChild(trChair);                                                

                var tr = document.createElement("tr");
                var td = document.createElement("td");
                var input = document.createElement("input");
                input.type = "submit";
                input.value = "Order Seat!";
                input.name = "newSubmit";
                td.appendChild(input);
                tr.appendChild(td);
                table.appendChild(tr);
                table.appendChild(inputType);            
                thisTables.appendChild(table);

                var mapView = document.createElement("div");
                mapView.classList.add("mapView");
                var table = document.createElement("table");
                var tr = document.createElement("tr");
                var td = document.createElement("td");
                td.id = "info";
                td.colSpan = "3";
                var b = document.createElement("b");
                b.innerHTML = " The map of each floor: ";
                td.appendChild(b);
                tr.appendChild(td);
                table.appendChild(tr);

                for(var i = 1 ; i < 11 ; i++)
                {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td");                    
                    var img = document.createElement("img");
                    img.src = "../photos/table_MAP_IMG.png";
                    img.alt = "Chair Icon";
                    img.classList.add("chair-icon");
                    img.id = "mirror-image";
                    td.appendChild(img);
                    td.innerHTML += "Chair " + i;
                    tr.appendChild(td);

                    var td = document.createElement("td");
                    td.classList.add("pedestrian-crossing");
                    tr.appendChild(td);

                    i++;
                    var td = document.createElement("td");
                    var img = document.createElement("img");
                    img.src = "../photos/table_MAP_IMG.png";
                    img.alt = "Chair Icon";
                    img.classList.add("chair-icon");
                    img.id = "mirror-image";
                    td.innerHTML = "Chair " + i;
                    td.appendChild(img);
                    tr.appendChild(td);
                    table.appendChild(tr);
                }

                mapView.appendChild(table);
                thisTables.appendChild(mapView);
                center.appendChild(thisTables);
            </script>';
    }

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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

       if ($_POST["type"] == "date")
        {
            $orderDate = $_POST["date"];     
            $seats = array(
                array(101,102,103,104,105,106,107,108,109,110), //1
                array(201,202,203,204,205,206,207,208,209,210), //2
                array(301,302,303,304,305,306,307,308,309,310) //3
            );
            $query = "SELECT * FROM Book WHERE userId = '$user_id' AND date = '$orderDate' ";
            $result = $mysqli->query($query);
            foreach ($result as $data) {
                $floor = $data['floor']- 1;
                $chair = $data['chair']- (100 * $data['floor']) - 1;
                unset($seats[$floor][$chair]);
            }
            $seats = array_map('array_values', $seats);;
            editScript($orderDate, "", "", $seats);
            unset($_POST['date']);
            $mysqli->close();
            exit();
        }
        elseif($_POST["type"] == "floor")
        {
            $orderFloor = $_POST["floor"];      
            $orderDate = $_POST["date"];                    
            $seats = array(
                array(101,102,103,104,105,106,107,108,109,110), //1
                array(201,202,203,204,205,206,207,208,209,210), //2
                array(301,302,303,304,305,306,307,308,309,310) //3
            );
            $query = "SELECT * FROM Book WHERE userId = '$user_id' AND date = '$orderDate'";
            $result = $mysqli->query($query);
            foreach ($result as $data) {
                $floor = $data['floor']- 1;
                $chair = $data['chair']- (100 * $data['floor']) - 1;            
                unset($seats[$floor][$chair]);
            }
            $seats = array_map('array_values', $seats);
            editScript($orderDate, $orderFloor, "", $seats);
            unset($_POST['floor']);
            $mysqli->close();
            exit();
        }
        elseif(isset($_POST["newSubmit"]))
        {
            $orderDate = $_POST["date"];
            $orderFloor = $_POST["floor"];      
            $orderChair = $_POST["chair"];

            $query = "INSERT INTO Book (userId, date, floor, chair) VALUES ('$user_id', '$orderDate', '$orderFloor', '$orderChair')";            
            $result = $mysqli->query($query);

            if($result == true)
            {
                echo '<script>alert("Booking successful!") </script>';
            } else {
                // Update failed

                echo '<script>alert("Insert error!" , '. $mysqli->error . ') </script>';
            }
        }
    }
       editScript();

    $mysqli->close();


        
    ?>
</html>