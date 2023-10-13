<!DOCTYPE html>
<html>
<head>
    <title>Seat Assist - Admin Mode</title>
    <link rel="stylesheet" href="../css/AdminModeCss.css">
    <link rel="stylesheet" href="../css/NewOrderPageCSS.css">

    <meta charset="utf-8" />

</head>
<body>
<form method="POST" action="adminmode.php" id = "myForm">

   
    <header>
        <img class="logo" src="../logos/row logo white.png" alt="Logo">
    </header>
    <div class="sidebar-container">

<audio  id="themusic" class="myAudio" controls loop  onpause="musicStop()" autoplay>
            <source src="../photos/admin-music.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

        <div class="userblock">
            <table>
                <tr>
                    <td><img class="userimg" src="../photos/myadmin.jpg" /></td>
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
                        <a href="index.php"><p>Logout</p></a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="sidebar">
           
           <h3>You are on the site's admin page </h3>
           <p>
            This page contains all the available orders in the system.
            <br>You can edit existing orders or cancel them.
            <br>Your actions have significant consequences for the database, <span style="color: red;">act carefully</span>.
            </p>

            <img src="../logos/blacklogo.png" style="width: 250px" />
          

        </div>
    </div>


        <div class="center" id = "center" style="background-color:white">
            
            
        </div>


    <div class="footer">
        <p>Copyright © 2023 Seat Assist</p>
        <p>Need help? contact us at <a href="mailto: Help@SeatAssist.com">Help@SeatAssist.com</a></p>
        <p>Useful Links: <a href="https://www.wework.co.il/">Office Rental</a> | <a href="https://www.w3schools.com/">W3Schools</a> | <a href="https://www.ruppin.ac.il/">Ruppin Academic Center</a></p>
    </div>




</form>
</body>
  <?php

    
    function editScript($orderDate = "", $orderFloor = "", $orderChair = "", $seats= "", $orderId = "")
    {
        echo '<script>
                var music = document.getElementById("themusic");
                music.removeAttribute("autoplay");

                var center = document.getElementById("center");
                center.innerHTML = "";
                var thisTables = document.createElement("div");
                thisTables.classList.add("thisTables");

                var h2 = document.createElement("h2");
                h2.innerHTML = "Edit Booking:";
                center.appendChild(h2);
                var p_book= document.createElement("p");
                p_book.innerHTML = "Please select a date, floor and seat.";
                p_book.style.fontWeight = "bold";
                center.appendChild(p_book);
                var p2_book= document.createElement("p");
                p2_book.innerHTML = "*Please note that occupied seats in spesipic date will not be shown in the list.";
                center.appendChild(p2_book);
                var p3_book= document.createElement("p");
                p3_book.innerHTML = "**To keep the booking on the same date (change only floor or chair), choose another date and then return to this date";
                center.appendChild(p3_book);


                var table = document.createElement("table");
                table.setAttribute("class", "reportTABLE");
                var inputType = document.createElement("input");
                inputType.type = "hidden";
                inputType.name = "type";
                var inputOrderId = document.createElement("input");
                inputOrderId.type = "hidden";
                inputOrderId.name = "orderId";  
                inputOrderId.value = "'.$orderId.'";                
                table.appendChild(inputOrderId);

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
                input.value = "Change Seat!";
                input.name = "changeSubmit";
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_POST["Cancel"]))
        {
            foreach ($_POST["Cancel"] as $buttonIndex => $buttonValue) {
                // Perform specific actions based on the button index or value
                if ($buttonValue === "Cancel") {
                    $orderId = $_POST["orderId"][$buttonIndex];
                }
            }
                        
            $query = "DELETE FROM Book WHERE orderId = '$orderId'";
            $result = $mysqli->query($query);

            if($result == TRUE && $mysqli->affected_rows > 0)
            {
                echo    '<script>
                            console.log("success");
                        </script>';
            }
            else
            {
                echo    '<script>
                            console.log("error" + "' . $mysqli->error . '");
                        </script>';               
            }
            unset($_POST['Cancel']);
        }

        elseif (isset($_POST["Edit"]))
        {

            foreach ($_POST["Edit"] as $buttonIndex => $buttonValue) 
            {
                // Perform specific actions based on the button index or value
                if ($buttonValue === "Edit")
                {
                    $orderId = $_POST["orderId"][$buttonIndex];
                }
            }
            $query = "SELECT * FROM Book WHERE orderId = '$orderId'";
            $result = $mysqli->query($query);
            $book = $result->fetch_assoc();

            $orderDate = $book["date"];
            $orderFloor = $book["floor"];
            $orderChair = $book["chair"];

            editScript($orderDate, $orderFloor, $orderChair, "", $orderId);

            unset($_POST['Edit']);
            $mysqli->close();                 
            exit();
        } 
        elseif ($_POST["type"] == "date")
        {
            $orderDate = $_POST["date"];
            $orderId = $_POST["orderId"];
            $seats = array(
                array(101,102,103,104,105,106,107,108,109,110), //1
                array(201,202,203,204,205,206,207,208,209,210), //2
                array(301,302,303,304,305,306,307,308,309,310) //3
            );
            $query = "SELECT * FROM Book WHERE date = '$orderDate' ";
            $result = $mysqli->query($query);
            foreach ($result as $data) {
                $floor = $data['floor']- 1;
                $chair = $data['chair']- (100 * $data['floor']) - 1;
                unset($seats[$floor][$chair]);
            }
            $seats = array_map('array_values', $seats);
            editScript($orderDate, "", "", $seats, $orderId);
            unset($_POST['date']);
            $mysqli->close();
            exit();
        }
        elseif($_POST["type"] == "floor")
        {
            $orderId = $_POST["orderId"];
            $orderFloor = $_POST["floor"];      
            $orderDate = $_POST["date"];                       
            $seats = array(
                array(101,102,103,104,105,106,107,108,109,110), //1
                array(201,202,203,204,205,206,207,208,209,210), //2
                array(301,302,303,304,305,306,307,308,309,310) //3
            );
            $query = "SELECT * FROM Book WHERE date = '$orderDate'";
            $result = $mysqli->query($query);
            foreach ($result as $data) {
                $floor = $data['floor']- 1;
                $chair = $data['chair']- (100 * $data['floor']) - 1;
                unset($seats[$floor][$chair]);
            }
            $seats = array_map('array_values', $seats);
            editScript($orderDate, $orderFloor, "", $seats, $orderId);
            unset($_POST['floor']);
            $mysqli->close();
            exit();
        }
        elseif(isset($_POST["changeSubmit"]))
        {

            $orderId = $_POST["orderId"];
            $orderDate = $_POST["date"];
            $orderFloor = $_POST["floor"];      
            $orderChair = $_POST["chair"];

            $query = "UPDATE Book SET date = '$orderDate', floor = '$orderFloor', chair = '$orderChair' WHERE orderId = '$orderId'";            
            $result = $mysqli->query($query);

            if($result == true)
            {
                echo '<script>console.log("Update successful!") </script>';
            } else {
                // Update failed

                echo '<script>console.log("Update error!" , '. $mysqli->error . ') </script>';
            }  
        }     
    }


    // delete old booking
    $query = "SELECT orderId, date, floor, chair FROM Book ORDER BY date ASC";
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

    $query = "SELECT userId, orderId, date, floor, chair, name FROM Book join User on userId = id ORDER BY date ASC";
    $result = $mysqli->query($query);

    $index = 1;

    echo '<script>

            var center = document.getElementsByClassName("center")[0];
            var title = document.createElement("h2");
            title.innerText = "Existing Orders";
            center.appendChild(title);
        </script>';
        
    foreach ($result as $data) {
        
        $thisUserName = $data['name'];

        echo '<script>

            var center = document.getElementsByClassName("center")[0];
            var table = document.createElement("table");

            table.setAttribute("class", "orderbox");
            var row1 = document.createElement("tr")
            row1.id="ordersTR";
            var th0 = document.createElement("th");
            th0.colSpan = "3";
            th0.innerHTML = "Order #" + "' . $index . '";
            row1.appendChild(th0);

            var th1 = document.createElement("th");
            th1.colSpan = "2";
            th1.innerHTML = "User Name: " + "' . $thisUserName . '";
            row1.appendChild(th1);

            var row2 = document.createElement("tr");
            row2.id="ordersTR";

            var td = document.createElement("td"); 
            td.innerHTML = "' . $data['date'] . '";
            row2.appendChild(td);

            var td0 = document.createElement("td");
            td0.innerHTML = "Floor " +"' . $data['floor'] . '";
            row2.appendChild(td0);

            var td1 = document.createElement("td");
            td1.innerHTML = "Chair " +"' . $data['chair'] . '";
            row2.appendChild(td1);

            var td3 = document.createElement("td");
            var input = document.createElement("input");
            input.setAttribute("type", "submit");
            input.name = "Edit['.$index.']";
            input.value = "Edit";
            td3.appendChild(input);
            row2.appendChild(td3);

            var td4 = document.createElement("td");
            var input = document.createElement("input");
            input.setAttribute("type", "submit");
            input.name = "Cancel['.$index.']";
            input.value = "Cancel";
            td4.appendChild(input);
            row2.appendChild(td4);

            var input = document.createElement("input");
            input.name = "orderId['. $index .']";
            input.value = ' . $data['orderId'] . ';
            input.type = "hidden";
            row2.appendChild(input);

            table.appendChild(row1); // Append row1 to the tbody
            table.appendChild(row2); // Append row2 to the tbody

            center.appendChild(table); // Append table to the center
        </script>';
        $index = $index + 1;
    }

    $mysqli->close();

        
    ?>
</html>