<?php
    Class Buy {
        private $connect;
        private $table = 'buy';

        // Buy properties/attribute

        public $productNum;
        public $customerNum;

        // Create the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all buy data
        public function getBuy() {
            // Create query
            $query = 'SELECT
                b.productNum,
                b.customerNum
            FROM
                ' . $this->table . ' b';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get one buy data
        public function getSingleBuy() {
            $query = 'SELECT
                b.productNum,
                b.customerNum
            FROM
                ' . $this->table . ' b
            WHERE
                b.productNum = ? AND
                b.customerNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->productNum);
            $stmt->bindParam(2, $this->customerNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->productNum = $row['productNum'];
            $this->customerNum = $row['customerNum'];
        }


        //Create a buy tuple
        public function createBuy() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    productNum = :productNum,
                    customerNum = :customerNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('productNum', $this->productNum);
            $stmt->bindParam('customerNum', $this->customerNum);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //Delete buy data
        public function deleteBuy() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE productNum = :productNum AND customerNum = :customerNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->productNum = htmlspecialchars(strip_tags($this->productNum));

            // Bind data
            $stmt->bindParam(':productNum', $this->productNum);
            $stmt->bindParam(':customerNum', $this->customerNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }