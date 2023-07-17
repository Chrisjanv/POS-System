<?php

class MenuItem
{
    // Fields
    private $name;
    private $price;
    private $barcode;

    // Constructor
    public function __construct($name, $price, $barcode)
    {
        $this->name = $name;
        $this->price = $price;
        $this->barcode = $barcode;
    }

    // Getter methods
    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    // Static method to retrieve menu items
    // I am aware there are simpler ways, this is a very structured approach for my learning purposes, testing functions and the communication between my files.
    public static function getMenuItems()
    {
        require './data/data.php'; // Include the file with the $items array
        
        $menuItems = [];
        
        foreach ($items as $item) {
            $menuItems[] = new MenuItem($item['name'], $item['price'], $item['barcode']);
        }
        
        return $menuItems;
    }
}
?>