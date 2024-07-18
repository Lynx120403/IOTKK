<?php

include 'database.php'; // Assuming 'database.php' contains your Database class and connection details

// Function to send message via Telegram bot
function sendMessage($chatId, $message)
{
    $botToken = '7178379398:AAHBS4llRr2oZX9UzrFOw-Risy15OYt0jCc';
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

// Retrieving POST data
$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$balance = $_POST['balance']; // Corrected variable name
$chatId = $_POST['chatId'];

// Connecting to the database
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Updating the record in the database
$sql = "UPDATE siswa_wali SET name = ?, gender = ?, email = ?, mobile = ?, balance = ?, chatId = ? WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($name, $gender, $email, $mobile, $balance, $chatId, $id)); // Corrected parameter order

// Sending message via Telegram bot
$message = "Your balance is: " . $balance;
sendMessage($chatId, $message);

// Closing the database connection
Database::disconnect();

// Redirecting to another page after the update
header("Location: user data.php"); // Assuming 'user_data.php' is the correct file name
