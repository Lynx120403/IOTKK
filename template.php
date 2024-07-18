<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
    </style>
</head>

<body>

    <div class="container">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="user data.php">Data User</a></li>
                <li><a href="registration.php">Registrasi</a></li>
                <li><a href="read tag.php">Read Tag</a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <h2>Edit Data</h2>
        <form class="form-horizontal" action="ser data edit tb.php?id=<?php echo $id ?>" method="post">
            <div class="control-group">
                <label class="control-label">ID</label>
                <div class="controls">
                    <input name="id" type="text" placeholder="" value="<?php echo $data['id']; ?>" readonly>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input id="div_refresh" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Gender</label>
                <div class="controls">
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email Address</label>
                <div class="controls">
                    <input name="email" type="email" placeholder="" value="<?php echo $data['email']; ?>" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Mobile Number</label>
                <div class="controls">
                    <input name="mobile" type="text" placeholder="" value="<?php echo $data['mobile']; ?>" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn" href="user data.php">Back</a>
            </div>
        </form>
    </div>

</body>

</html>