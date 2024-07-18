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

$msg = null;
if (null == $data['name']) {
	$msg = "The ID of your Card / KeyChain is not registered !!!";
	$data['id'] = $id;
	$data['name'] = "--------";
	$data['gender'] = "--------";
	$data['email'] = "--------";
	$data['mobile'] = "--------";
	$data['balance'] = "--------";
} else {
	$msg = null;
}

$dataName = $data['name'];
$dataBalance = $data['balance'];

$Write = "<?php \$newName='$dataName'; \$newBalance='$dataBalance'; echo 'Halo: ' . \$newName . ' | Saldo anda sebanyak: ' . \$newBalance; ?>";
file_put_contents('sendNewBalance.php', $Write);
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
			margin: 0 auto;
			width: fit-content;
			padding: 10px 20px;
			background-color: #007bff;
			color: #fff;
			text-decoration: none;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.btnn:hover {
			background-color: #0056b3;
		}
	</style>
	<script>
		window.onload = function() {
			var balance = <?php echo $data['balance']; ?>;
			if (balance == 0) {
				alert("Your balance is 0. Please fill your balance first.");
			}
		}
	</script>
</head>

<body>
	<div>
		<form action="bayarDB.php?id=<?php echo $data['id']; ?>" method="post">
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
								<td align="left"><?php echo $data['id']; ?></td>
							</tr>
							<tr bgcolor="#f2f2f2">
								<td align="left" class="lf">Nama</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['name']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Jenis Jelamin</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['gender']; ?></td>
							</tr>
							<tr bgcolor="#f2f2f2">
								<td align="left" class="lf">Email</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['email']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">No.Telp</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['mobile']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Kelas</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><?php echo $data['balance']; ?></td>
							</tr>
							<tr>
								<td align="left" class="lf">Bayar</td>
								<td style="font-weight:bold">:</td>
								<td align="left"><input type="number" id="reduce_balance" name="reduce_balance" min="0"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div style="padding-top: 20px">
				<button type="submit" class="btnn">Bayar</button>
			</div>
		</form>
	</div>
	<p style="color:red;"><?php echo $msg; ?></p>
</body>

</html>