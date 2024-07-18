<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM siswa_wali where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
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

    form {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    form label {
        display: block;
        margin-bottom: 10px;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="number"],
    form textarea,
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form input[type="submit"],
    .form-actions button {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type="submit"]:hover,
    .form-actions button:hover {
        background-color: #2980b9;
    }

    .backk {
        padding: 10px 20px;
        background-color: #6c757d;
        /* Button color */
        color: #fff;
        /* Text color */
        font-size: 15px;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .backk:hover {
        background-color: #0056b3;
        /* Hover color */
    }

    .btn {
        padding: 10px 20px;
        background-color: #3498db;
        /* Button color */
        color: #fff;
        /* Text color */
        font-size: 14px;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>

    <title>Edit : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>

</head>

<body>

    <div class="container">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="user data.php">Data User</a></li>
                <li><a href="registration.php">Registrasi</a></li>
                <li><a href="read tag.php">Tambah Saldo</a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <h2>Edit Data</h2>
        <form class="form-horizontal" action="updateDB.php" method="post">
            <div class="control-group">
                <label class="control-label">ID</label>
                <div class="controls">
                    <input name="id" type="text" placeholder="" value="<?php echo $data['id']; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Nama</label>
                <div class="controls">
                    <input id="div_refresh" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder=""
                        required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Jenis Kelamin</label>
                <div class="controls">
                    <select name="gender">
                        <option value="Male">Laki - laki</option>
                        <option value="Female">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input name="email" type="email" placeholder="" value="<?php echo $data['email']; ?>" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">No.Telp</label>
                <div class="controls">
                    <input name="mobile" type="text" placeholder="" value="<?php echo $data['mobile']; ?>" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">ChatID Telegram</label>
                <div class="controls">
                    <input name="chatId" type="text" placeholder="" value="<?php echo $data['chatId']; ?>" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Saldo</label>
                <div class="controls">
                    <input name="balance" id="balance" type="text" placeholder=""
                        value="<?php echo $data['balance']; ?>"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Update</button>
                <a class="backk" href="user data.php">Back</a>
            </div>
        </form>
    </div>

    <!-- <script>
		var g = document.getElementById("defaultGender").innerHTML;
		if (g == "Male") {
			document.getElementById("mySelect").selectedIndex = "0";
		} else {
			document.getElementById("mySelect").selectedIndex = "1";
		}
	</script> -->
    <script>
    // Get the input element
    var balanceInput = document.getElementById("balance");

    // Listen for the input event
    balanceInput.addEventListener("input", function(event) {
        // Get the input value
        var inputValue = event.target.value;

        // Validate input value using regular expression
        var validInput = /^[0-9]*\.?[0-9]*$/.test(inputValue);

        // If input is not valid, clear the input field
        if (!validInput) {
            event.target.value = "";
        }
    });
    </script>
</body>

</html>