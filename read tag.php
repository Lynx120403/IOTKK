<?php
$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getUID").load("UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("UIDContainer.php");
            }, 500);
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        nav {
            background: linear-gradient(to right, #ffffff 0%, #3498db 50%, #ffffff 100%);
            color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        table {
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btnn {
            display: block;
            text-align: center;
            /* Center the text */
            margin: 0 auto;
            /* Center the link horizontally */
            width: fit-content;
            /* Set width to fit the content */
            padding: 10px 20px;
            background-color: #007bff;
            /* Button color */
            color: #fff;
            /* Text color */
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btnn:hover {
            background-color: #0056b3;
            /* Hover color */
        }
    </style>

    <title>Read Tag : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="registration.php">Registrasi</a></li>
                <li><a href="read tag.php">Absen</a></li>
            </ul>
        </nav>
    </div>

    <br>

    <h3 align="center" id="blink">Please Scan Tag to Display ID or User Data</h3>

    <p id="getUID" hidden></p>

    <br>

    <div class="container">
        <div id="show_user_data">
            <form>
                <table width="452" border="1" bordercolor="#10a0c5" align="center" cellpadding="0" cellspacing="1" bgcolor="#000" style="padding: 2px">
                    <tr>
                        <td height="40" align="center" bgcolor="#10a0c5">
                            <font color="#FFFFFF">
                                <b>User Data</b>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#f9f9f9">
                            <table width="452" border="0" align="center" cellpadding="5" cellspacing="0">
                                <tr>
                                    <td width="113" align="left" class="lf">ID</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left">--------</td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td align="left" class="lf">Nama</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left">--------</td>
                                </tr>
                                <tr>
                                    <td align="left" class="lf">Jenis Kelamin</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left">--------</td>
                                </tr>
                                <tr bgcolor="#f2f2f2">
                                    <td align="left" class="lf">Email</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left">--------</td>
                                </tr>
                                <tr>
                                    <td align="left" class="lf">No.Telp</td>
                                    <td style="font-weight:bold">:</td>
                                    <td align="left">--------</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
            <button id="show_data_button" class="btn" style="display: none;">Show Data</button>
        </div>
    </div>

    <script>
        var myVar = setInterval(myTimer, 1000);
        var myVar1 = setInterval(myTimer1, 1000);
        var oldID = "";
        clearInterval(myVar1);

        function myTimer() {
            var getID = document.getElementById("getUID").innerHTML;
            oldID = getID;
            if (getID != "") {
                myVar1 = setInterval(myTimer1, 500);
                showUser(getID);
                clearInterval(myVar);
            }
        }

        function myTimer1() {
            var getID = document.getElementById("getUID").innerHTML;
            if (oldID != getID) {
                myVar = setInterval(myTimer, 500);
                clearInterval(myVar1);
            }
        }

        function showUser(str) {
            if (str == "") {
                document.getElementById("show_user_data").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("show_user_data").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "read tag user data.php?id=" + str, true); // Call bayarDB.php with UID
                xmlhttp.send();
            }
        }

        var blink = document.getElementById('blink');
        setInterval(function() {
            blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
        }, 750);
    </script>
</body>

</html>