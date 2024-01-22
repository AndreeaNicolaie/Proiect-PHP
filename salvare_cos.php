<?php
session_start();
require_once "ShoppingCart.php";
require_once "DBController.php";

$db_handle = new DBController();
$shoppingCart = new ShoppingCart();
$User_ID = $_SESSION['loggedin'];

echo "User ID: " . $User_ID . "<br>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItems = $shoppingCart->getMemberCartItems($User_ID);
    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            $query = "INSERT INTO tbl_cart (User_ID, Ticket_ID, Quantity) VALUES (?, ?, ?)";
            $stmt = $db_handle->conn->prepare($query);

            if ($stmt === false) {
                exit;
            }

            $stmt->bind_param("iii", $User_ID, $item["ID_Bilet"], $item["Quantity"]);
            $stmt->execute();

            if ($stmt->error) {
                exit;
            }

            $stmt->close();
        }

        echo "Comanda a fost trimisă!<br>"; 
        echo '<a href="style.html">Home</a>';
        exit;
    } else {
        echo "No items in the cart.<br>"; 
    }
}
?>
