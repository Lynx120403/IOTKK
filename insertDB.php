<?php
require 'database.php';

function sendMessage($chatId, $message)
{
    $botToken = '7065768550:AAFRM5Petfr0TOhl-DLF5b3hHmK9sQBk4E8'; // Replace with your Telegram bot token
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

if (!empty($_POST)) {
    // Set the default timezone to Jakarta, Indonesia
    date_default_timezone_set('Asia/Jakarta');

    // Keep track of post values
    $name = $_POST['name'];
    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $chatId = $_POST['chatId'];
    $class = $_POST['class'];
    $date = date('Y-m-d H:i:s'); // Generate current date and time with the local timezone

    // Insert data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO siswa_wali (name, id, gender, email, mobile, chatId, date, class) values(?, ?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($name, $id, $gender, $email, $mobile, $chatId, $date, $class)); // Include $chatId in the array
    Database::disconnect();

    // Send a message to the user on Telegram
    $message = "Halo $name, berhasil melakukan registrasi. Pada $date";
    sendMessage($chatId, $message);

    $Write = "<?php echo 'Berhasil Registrasi!' ?>";
     file_put_contents('sendNewBalance.php', $Write);

    // Redirect to user data page
    header("Location: user data.php");
}
