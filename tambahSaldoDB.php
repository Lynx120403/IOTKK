<?php
include 'database.php'; // Assuming 'database.php' contains your Database class and connection details

// Function to send message via Telegram bot
function sendMessage($chatId, $message)
{
    $botToken = '7178379398:AAHBS4llRr2oZX9UzrFOw-Risy15OYt0jCc'; // Replace with your Telegram bot token
    $apiURL = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    file_get_contents($apiURL, false, $context);
}

// Retrieving UID from GET parameter
$uid = $_GET['id'];
$add_balance = $_POST['add_balance'];

// Connecting to the database
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve user data based on UID
$sql = "SELECT * FROM siswa_wali WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($uid));
$user = $q->fetch(PDO::FETCH_ASSOC);

// Check if user exists
if ($user) {
    // Update balance by subtracting 100000
    $newBalance = $user['balance'] + $add_balance;

    // Update balance in the database
    $updateSql = "UPDATE siswa_wali SET balance = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute(array($newBalance, $uid));

    if ($updateStmt) {
        $Write = "<?php \$newBalance='$newBalance'; echo \$newBalance; ?>";
file_put_contents('sendNewBalance.php', $Write);
}

// Send notification message via Telegram bot
$Write = "<?php \$newBalance='$newBalance'; echo 'Jumlah Saldo: ' . \$newBalance; ?>";
file_put_contents('sendNewBalance.php', $Write);


// Send notification message via Telegram bot
$message = "Halo " . $user['name'] . "\nAnda melakukan setor tunai sebanyak: " . $add_balance . ",\nSaldo saat ini
adalah Rp : " . $newBalance;
sendMessage($user['chatId'], $message);

echo "
<div class='container'>
    <nav>
        <ul>
            <li><a href='home.php'>Home</a></li>
            <li><a href='user data.php'>Data User</a></li>
            <li><a href='registration.php'>Registrasi</a></li>
            <li><a href='read tag.php'>Tambah Saldo</a></li>
        </ul>
    </nav>
</div>

<br>

<h3 align='center' id='blink'>Please Scan Tag to Display ID or User Data</h3>

<p id='getUID' hidden></p>

<br>

<div class='container'>
    <div id='show_user_data'>
        <form id='balansce_form' method='post' action='read tag pembayaran.php?id={$uid}'>
            <table width='452' border='1' bordercolor='#10a0c5' align='center' cellpadding='0' cellspacing='1'
                bgcolor='#000' style='padding: 2px'>
                <tr>
                    <td height='40' align='center' bgcolor='#10a0c5'>
                        <font color='#FFFFFF'><b>User Data</b></font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor='#f9f9f9'>
                        <table width='452' border='0' align='center' cellpadding='5' cellspacing='0'>
                            <tr>
                                <td width='113' align='left' class='lf'>ID</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>{$user['id']}</td>
                            </tr>
                            <tr bgcolor='#f2f2f2'>
                                <td align='left' class='lf'>Nama</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>{$user['name']}</td>
                            </tr>
                            <tr>
                                <td align='left' class='lf'>Jenis Kelamin</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>{$user['gender']}</td>
                            </tr>
                            <tr bgcolor='#f2f2f2'>
                                <td align='left' class='lf'>Email</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>{$user['email']}</td>
                            </tr>
                            <tr>
                                <td align='left' class='lf'>No.Telp</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>{$user['mobile']}</td>
                            </tr>
                            <tr bgcolor='#f2f2f2'>
                                <td align='left' class='lf'>Saldo</td>
                                <td style='font-weight:bold'>:</td>
                                <td align='left'>$newBalance</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>";
        } else {
        // User not found, handle accordingly
        echo "User not found";
        }

        // Close the database connection
        Database::disconnect();
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <script src="js/bootstrap.min.js"></script>
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
        </head>