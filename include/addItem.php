<?php

session_start();

function addItem($menuItem)
{
    // Add the selected menu item to the order session variable
    $_SESSION['order'][] = $menuItem;

    // Add the item's price to the orderTotal session variable
    $_SESSION['orderTotal'] += $menuItem['price'];
}

// Usage example:
// Assuming $selectedMenuItem is an array representing the selected item

// Add the selected item to the order and update the total
if (isset($selectedMenuItem)) {
    addItem($selectedMenuItem);
}
?>