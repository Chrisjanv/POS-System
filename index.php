<?php

// display error codes and messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Initialize session variables if they don't exist
if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = array();
}

if (!isset($_SESSION['orderTotal'])) {
    $_SESSION['orderTotal'] = 0;
}

if (isset($_POST['selectedItemValue'])) {
    require './data/data.php';

    $selectedBarcode = $_POST['selectedItemValue'];

    // Find the selected item by matching the barcode
    $selectedItem = null;
    foreach ($items as $item) {
        if ($item['barcode'] == $selectedBarcode) {
            $selectedItem = $item;
            break;
        }
    }

    if ($selectedItem) {
        // Add the selected item to the order array
        $_SESSION['order'][] = $selectedItem;

        // Update the order total
        $_SESSION['orderTotal'] += $selectedItem['price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&S POS</title>
    <link rel="stylesheet" href="./static/css/style.css">
</head>

<body>
    <h1>
        <span style="color:red">Select</span> and <span style="color:blue">Save</span>
    </h1>

    <hr>

    <div class="till__display">
        <div>
            <span class="till__console">
                Amount: R <span><?php echo $_SESSION['orderTotal']; ?>
                </span>
            </span>
        </div>
    </div>

    <hr>

    <section>
    <form class="items" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            require './model/MenuItem.php';

            $menuItems = MenuItem::getMenuItems();

            foreach ($menuItems as $item) {
                ?>
                <button    type="submit" name="selectedItemValue" value="<?php echo $item->getBarcode(); ?>" class="item">
                     <h3><?php echo $item->getName(); ?></h3>
                     <p>Price: R <?php echo $item->getPrice(); ?></p>
                  </button >
                  <?php
            }
            ?>
        </form>
    </section>



    <form action="./views/checkout.php" method="get" class="checkout">
        <input type="hidden" name="subTotal" value="sub total amount">
        <button type="submit">
            Proceed to payment
        </button>
    </form>


</body>

</html>