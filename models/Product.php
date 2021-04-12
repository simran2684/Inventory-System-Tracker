<?php
    class Post{
        private $conn;
        private $table = 'product';

        // Post Properties
        public $productNum;
        public $name;
        public $brand;
        public $category;
        public $quantity;
        public $weight;
        public $inventoryNum;
        public $location;
        public $storageTemp;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Posts
        public function read(){
            // Create query 
            $query = 'SELECT p.productNum, 
            p.name,
            p.brand,
            p.category, 
            p.quantity,
            p.weight,
            p.inventoryNum,
            p.location,
            p.storageTemp
            FROM
            ' . $this->table . ' p';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;

        }

    }