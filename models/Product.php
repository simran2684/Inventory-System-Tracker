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
        public function getProducts(){
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


        // Function to create product
        public function createProduct() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                productNum = :productNum,
                name = :name,
                brand = :brand,
                category = :category,
                quantity = :quantity,
                weight = :weight,
                inventoryNum = :inventoryNum,
                location = :location,
                storageTemp = :storageTemp';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam(':productNum', $this->productNum);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':brand', $this->brand);
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':weight', $this->weight);
            $stmt->bindParam(':inventoryNum', $this->inventoryNum);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':storageTemp', $this->storageTemp);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateProduct() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    productNum = :productNum,
                    name = :name,
                    brand = :brand,
                    category = :category,
                    quantity = :quantity,
                    weight = :weight,
                    inventoryNum = :inventoryNum,
                    location = :location,
                    storageTemp = :storageTemp
                WHERE
                    productNum = :productNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);
           
            // Bind data
            $stmt->bindParam(':productNum', $this->productNum);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':brand', $this->brand);
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':weight', $this->weight);
            $stmt->bindParam(':inventoryNum', $this->inventoryNum);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':storageTemp', $this->storageTemp);
            
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteProduct() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE productNum = :productNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->productNum = htmlspecialchars(strip_tags($this->productNum));

            // Bind data
            $stmt->bindParam(':productNum', $this->productNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }