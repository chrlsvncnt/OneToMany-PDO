<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        header {
            margin-bottom: 20px;
        }
        header a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
        }
        header a:hover {
            text-decoration: underline;
        }
        .client {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        form p {
            margin-bottom: 10px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: #ffffff;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        table a {
            color: #007bff;
            text-decoration: none;
        }
        table a:hover {
            text-decoration: underline;
        }
    </style>
<body>
    <header>
        <a href="index.php">Return to home</a>
        <a href="">About Us</a> 
        <a href="">Contact</a> 
    </header>
	
	<?php $getAllOrderByCustomerID = getAllOrderByCustomerID($_GET['CustomerID']); ?>
	<div class="client" style="text-align: left;">
		<h3 style="margin-bottom: 10px;">Add New Shipment</h3>
		<form action="core/handleForms.php?CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
			<p>
				<label for="RiceType">Product Name</label> 
				<input type="text" name="RiceType" required>
			</p>
			<p>
				<label for="Category">Category</label> 
				<input type="text" name="Category" required>
			</p>
			<p>
				<label for="Price">Price</label> 
				<input type="text" name="Price" required>
			</p>
			<p>
				<label for="StockQuantity">Stock Quantity</label> 
				<input type="text" name="StockQuantity" required>
			</p>
			<p>
				<label for=" Supplier">Supplier</label> 
				<input type="text" name=" Supplier" required>
			</p>
			<input type="submit" name="insertNewShipmentBtn" value="Add Shipment">
		</form>
	</div>

	<table style="width:85%; margin-top: 50px;">
	  <tr>
	    <th>Product ID</th>
	    <th>Product Name</th>
		<th>Category</th>
	    <th>Price</th>
		<th>Stock Quantity</th>
		<th>Supplier</th>
	    <th>Customer Name</th>
	    <th>Shipment Date</th>
	    <th>Action</th>
	  </tr>
	  <?php $getShipmentByClient = getShipmentByClient($pdo, $_GET['CustomerID']); ?>
	  <?php foreach ($getShipmentByClient as $row) { ?>
	  <tr>
	  	<td><?php echo $row['ProductID']; ?></td>	  	
	  	<td><?php echo $row['ProductName']; ?></td>	  
		<td><?php echo $row['Category']; ?></td>	 	
	  	<td><?php echo $row['Price']; ?></td>
		<td><?php echo $row['StockQuantity']; ?></td>	
		<td><?php echo $row['Supplier']; ?></td>	  	  	
	  	<td><?php echo $row['CustomerName']; ?></td>	  	
	  	<td><?php echo $row['dateRegistered']; ?></td>
	  	<td>
	  		<a href="editOrder.php?ProductID=<?php echo $row['ProductID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Edit</a>
	  		<a href="deleteOrder.php?ProductID=<?php echo $row['ProductID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>
</body>
</html>
