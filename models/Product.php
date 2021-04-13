<?php
    class Product{
        private $connect;
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
            $this->connect = $db;
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
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;

        }


        // Get a single employee
        public function getSingleProduct() {
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
            ' . $this->table . ' p
            WHERE
                p.productNum = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->productNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->brand = $row['brand'];
            $this->category = $row['category'];
            $this->quantity = $row['quantity'];
            $this->weight = $row['weight'];
            $this->inventoryNum = $row['inventoryNum'];
            $this->location=$row['location'];
            $this->storageTemp=$row['storageTemp'];

        }

    }