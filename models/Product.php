<?php
    class Post{
        private $conn;
        private $table = 'Product';

        // Post Properties
        public $product_num;
        public $name;
        public $brand;
        public $category;
        public $quantity;
        public $weight;
        public $inventory_num;
        public $location;
        public $storage_temp;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Posts
        public function read(){
            // Create query 
            $query = 'SELECT p.product_num, 
            p.name,
            p.brand,
            p.category
            FROM
            ' . $this->table . ' p';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;

        }

    }