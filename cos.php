<?php
require_once "ShoppingCart.php";
session_start();

// Redirect if not logged in or if the session variable is not a valid integer
if (!isset($_SESSION['loggedin'])) {
    header('Location: style.html');
    exit;
}

$member_id = filter_var($_SESSION['loggedin'], FILTER_VALIDATE_INT);
if ($member_id === false) {
    // If it's not, redirect to login page or handle the error as needed
    header('Location: login.php'); // Replace with your actual login page
    exit;
}

$shoppingCart = new ShoppingCart();

// Processing cart actions
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["Quantity"]) && isset($_GET["ticket_id"])) {
                $ticketResult = $shoppingCart->getTicketById($_GET["ticket_id"]);
                if (!empty($ticketResult)) {
                    $cartItems = $shoppingCart->getMemberCartItems($member_id);

                    $cartItemFound = false;
                    if (is_array($cartItems)) {
                        foreach ($cartItems as $cartItem) {
                            if ($cartItem["ID_Bilet"] == $ticketResult[0]["ID_Bilet"]) {
                                $newQuantity = $cartItem["Quantity"] + $_POST["Quantity"];
                                $shoppingCart->updateCartQuantity($newQuantity, $cartItem["Cart_ID"]);
                                $cartItemFound = true;
                                break;
                            }
                        }
                    }

                    if (!$cartItemFound) {
                        $shoppingCart->addToCart($ticketResult[0]["ID_Bilet"], $_POST["Quantity"], $member_id);
                    }
                }
            }
            break;

        case "remove":
            if (!empty($_GET["id"])) {
                $shoppingCart->deleteCartItem($_GET["id"]);
            }
            break;

        case "empty":
            $shoppingCart->emptyCart($member_id);
            break;
    }
}

// Initialize $cartItems to an empty array to avoid undefined variable warning
$cartItems = $shoppingCart->getMemberCartItems($member_id) ?: [];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Creare cos permanent in PHP</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="shopping-cart">
    <div class="txt-heading">
        <div class="txt-heading-label">Cos Cumparaturi</div>
        <a id="btnEmpty" href="cos.php?action=empty">Golește Coșul</a>
    </div>
    <?php if (!empty($cartItems)) { ?>
        <form action="salvare_cos.php" method="post">
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align: left;"><strong>Bilet</strong></th>
                        <th style="text-align: right;"><strong>Cantitate</strong></th>
                        <th style="text-align: right;"><strong>Pret pe bucata</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                    <?php
                    $item_total = 0;
                    foreach ($cartItems as $item) { ?>
                        <tr>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;">
                                <strong><?php echo $item["Tip_Bilet"]; ?></strong>
                            </td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                                <?php echo $item["Quantity"]; ?>
                            </td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                                <?php echo "$".$item["Pret"]; ?>
                            </td>
                            <td style="text-align: center; border-bottom: #F0F0F0 1px solid;">
                                <a href="cos.php?action=remove&id=<?php echo $item["Cart_ID"]; ?>">Șterge</a>
                            </td>
                        </tr>
                        <?php $item_total += ($item["Pret"] * $item["Quantity"]); ?>
                    <?php } ?>
                    <tr>
                        <td colspan="2" align="right"><strong>Total:</strong></td>
                        <td align="right"><?php echo "$".$item_total; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- Butonul de trimitere -->
            <input type="submit" value="Trimite Comanda" />
        </form>
    <?php } else { ?>
        <p>Coșul tău este gol!</p>
    <?php } ?>
</div>
<div><
