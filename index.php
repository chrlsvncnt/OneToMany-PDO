<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
    <style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			background-color: #f4f4f4;
			color: #333;
		}
		h1 {
			color: #007bff;
			margin-bottom: 20px;
		}
		form {
			background-color: #ffffff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			margin-bottom: 20px;
		}
		form p {
			margin-bottom: 15px;
		}
		form label {
			display: block;
			font-weight: bold;
		}
		form input[type="text"],
		form input[type="submit"] {
			width: 100%;
			padding: 8px;
			margin-top: 5px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		form input[type="submit"] {
			background-color: #007bff;
			color: #ffffff;
			border: none;
			cursor: pointer;
		}
		form input[type="submit"]:hover {
			background-color: #0056b3;
		}
		.container {
			background-color: #ffffff;
			padding: 15px;
			margin-bottom: 20px;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}
		.container h3 {
			margin: 5px 0;
		}
		.editAndDelete a {
			margin-right: 10px;
			text-decoration: none;
			color: #007bff;
		}
		.editAndDelete a:hover {
			text-decoration: underline;
		}
	</style>
<body>
	<h1>Welcome To Seasoning Shop!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">Customer Name</label> 
			<input type="text" name="CustomerName">
		</p>
		<p>
			<label for="firstName">Contact Number</label> 
			<input type="text" name="ContactNumber">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="Email">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="Address">
		</p>
		<p>
			<label for="firstName">City</label> 
			<input type="text" name="City">
			<input type="submit" name="insertClientBtn">
		</p>
	</form>
	<?php $getAllCustomer = getAllCustomer($pdo); ?>
	<?php foreach ($getAllCustomer as $row) { ?>
	<div class="container" style="width: 50%; height: 250px; margin-top: 20px;">
		<h3>Cutomer Name: <?php echo $row['CustomerName']; ?></h3>
		<h3>Contact number: <?php echo $row['ContactNumber']; ?></h3>
		<h3>Email: <?php echo $row['Email']; ?></h3>
		<h3>Address: <?php echo $row['Address']; ?></h3>
		<h3>City: <?php echo $row['City']; ?></h3>
		<h3>Date Registered: <?php echo $row['RegistrationDate']; ?></h3>


		<div class="editAndDelete" style="float: right;">
			<a href="SeasoningShop.php?CustomerID=<?php echo $row['CustomerID']; ?>">View Shipments</a>
			<a href="editCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Edit</a>
			<a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>
