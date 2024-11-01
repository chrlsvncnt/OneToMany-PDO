<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertClientBtn'])) {

	$query = insertClient($pdo, $_POST['CustomerName'], $_POST['ContactNumber'], $_POST['Email'], $_POST['Address'], $_POST['City']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editClientBtn'])) {
	$query = updateClient($pdo, $_POST['ContactNumber'], $_POST['Email'], $_POST['Address'], $_POST['City'], $_GET['CustomerID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deleteClientBtn'])) {
	$query = deleteCustomer($pdo, $_GET['CustomerID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}




if (isset($_POST['insertNewShipmentBtn'])) {
	$query = insertShipment($pdo, $_POST['RiceType'], $_POST['shipmentMethod'], $_POST['WeightOfRice'], $_POST['QuantitySack'], $_POST['RicePrice'], $_GET['CustomerID']);

	if ($query) {
		header("Location: ../SeasoningShop.php?CustomerID=" .$_GET['CustomerID']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editShipmentBtn'])) {
	$query = updateShipment($pdo, $_POST['RiceType'], $_POST['shipmentMethod'], $_POST['WeightOfRice'], $_POST['QuantitySack'], $_POST['RicePrice'], $_GET['OrderID']);

	if ($query) {
		header("Location: ../SeasoningShop.php?CustomerID=" .$_GET['CustomerID']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteShipmentBtn'])) {
	$query = deleteOrder($pdo, $_GET['ProductID']);

	if ($query) {
		header("Location: ../SeasoningShop.php?CustomerID=" .$_GET['ProductID']);
	}
	else {
		echo "Deletion failed";
	}
}




?>