<?php  
    Class setsPrice {
        private $connect;
        private $table = 'setsPrice';

        //Attributes
        public $productNum;
        public $adminSSN;
        public $price;

        // Create database
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get all setPrice data
        public function getAll() {
            // Create query
            $query = 'SELECT
                p.productNum,
                p.adminSSN,
                p.price
            FROM
                ' . $this->table . ' p';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }


        //Get one setPrice data
        public function getSingle() {
            $query = 'SELECT
                p.productNum,
                p.adminSSN,
                p.price
            FROM
                ' . $this->table . ' p
            WHERE
                p.productNum = ? AND p.adminSSN = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind info
            $stmt->bindParam(1, $this->productNum);
            $stmt->bindParam(2, $this->adminSSN);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->productNum = $row['productNum'];
            $this->adminSSN = $row['adminSSN'];
            $this->price = $row['price'];
        }


        // Create setPrice data
        public function createPrice() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    productNum = :productNum,
                    adminSSN = :adminSSN,
                    price = :price';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('productNum', $this->productNum);
            $stmt->bindParam('adminSSN', $this->adminSSN);
            $stmt->bindParam('price', $this->price);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Update price
        public function updatePrice() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    price = :price
                WHERE
                    productNum = :productNum AND
                    adminSSN = :adminSSN';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            //Bind data
            $stmt->bindParam('productNum', $this->productNum);
            $stmt->bindParam('adminSSN', $this->adminSSN);
            $stmt->bindParam('price', $this->price);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function deleteData() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE productNum = :productNum AND adminSSN = :adminSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->productNum = htmlspecialchars(strip_tags($this->productNum));

            // Bind data
            $stmt->bindParam('productNum', $this->productNum);
            $stmt->bindParam('adminSSN', $this->adminSSN);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }