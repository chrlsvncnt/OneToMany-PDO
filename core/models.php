<?php  

function insertClient($pdo, $CustomerName, $ContactNumber, $Email, 
	$Address, $City) {

	$sql = "INSERT INTO Customer (CustomerName, ContactNumber, Email, 
		Address, City) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerName, $ContactNumber, $Email, 
	$Address, $City]);

	if ($executeQuery) {
		return true;
	}
}



function updateClient($pdo, $ContactNumber, $Email, 
	$Address, $City, $CustomerID) {

	$sql = "UPDATE Customer
				SET ContactNumber = ?,
					Email = ?,
					Address = ?, 
					City = ?
				WHERE CustomerID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ContactNumber, $Email, 
	$Address, $City, $CustomerID]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteCustomer($pdo, $CustomerID) {
	$deleteOder = "DELETE FROM SeasoningShop WHERE CustomerID = ?";
	$deleteStmt = $pdo->prepare($deleteOder);
	$executeDeleteQuery = $deleteStmt->execute([$CustomerID]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM Customer WHERE CustomerID = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$CustomerID]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCustomer($pdo) {
	$sql = "SELECT * FROM Customer";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getClientByID($pdo, $CustomerID) {
	$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getShipmentByClient($pdo, $CustomerID) {
	
	$sql = "SELECT 
				SeasoningShop.ProductID AS ProductID,
				SeasoningShop.ProductName AS ProductName,
				SeasoningShop.Category AS Category,
				SeasoningShop.Price AS Price,
				SeasoningShop.StockQuantity AS StockQuantity,
				SeasoningShop.Supplier AS Supplier,
				SeasoningShop.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM SeasoningShop
			JOIN Customer ON SeasoningShop.CustomerID = Customer.CustomerID
			WHERE SeasoningShop.CustomerID = ? 
			GROUP BY SeasoningShop.ProductName;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertShipment($pdo, $ProductName, $Category, $Price, $StockQuantity, $Supplier, $CustomerID) {
	$sql = "INSERT INTO SeasoningShop (ProductName, Category, Price, StockQuantity, Supplier, CustomerID) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductName, $Category, $Price, $StockQuantity, $Supplier, $CustomerID]);
	if ($executeQuery) {
		return true;
	}

}

function getShipmentByID($pdo, $ProductID) {
	$sql = "SELECT 
				SeasoningShop.ProductID AS ProductID,
				SeasoningShop.ProductName AS ProductName,
				SeasoningShop.Category AS Category,
				SeasoningShop.Price AS Price,
				SeasoningShop.StockQuantity AS StockQuantity,
				SeasoningShop.Supplier AS Supplier,
				SeasoningShop.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM SeasoningShop
			JOIN Customer ON SeasoningShop.CustomerID = Customer.CustomerID
			WHERE SeasoningShop.ProductID  = ? 
			GROUP BY SeasoningShop.ProductName";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductID]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateShipment($pdo, $ProductName, $Category, $Price, $StockQuantity, $Supplier, $ProductID) {
	$sql = "UPDATE SeasoningShop
			SET ProductName = ?,
				Category = ?,
				Price = ?,
				StockQuantity = ?,
				Supplier = ?
			WHERE ProductID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductName, $Category, $Price, $StockQuantity, $Supplier, $ProductID]);

	if ($executeQuery) {
		return true;
	}
}

function deleteOrder($pdo, $ProductID) {
	$sql = "DELETE FROM SeasoningShop WHERE ProductID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductID]);
	if ($executeQuery) {
		return true;
	}
}


function getAllOrderByCustomerID($CustomerID) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE CustomerID = :CustomerID");
    $stmt->execute(['CustomerID' => $CustomerID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>