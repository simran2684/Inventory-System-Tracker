<?php  
    Class AddsProduct {
        private $connect;
        private $table = 'addProduct';

        //Attributes
        public $mgrSSN;
        public $productNum;

        // Create database
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get all setPrice data
        public function getAll() {
            // Create query
            $query = 'SELECT
                p.mgrSSN,
                p.productNum
            FROM
                ' . $this->table . ' p';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }


        //Get one updatesProduct data
        public function getSingleAdd() {
            $query = 'SELECT
                p.mgrSSN,
                p.productNum
            FROM
                ' . $this->table . ' p
            WHERE
                p.mgrSSN = ? AND p.productNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind info
            $stmt->bindParam(1, $this->mgrSSN);
            $stmt->bindParam(2, $this->productNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->mgrSSN = $row['mgrSSN'];
            $this->productNum = $row['productNum'];
        }


        // Create updateProduct data
        public function createAddProduct() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    mgrSSN = :mgrSSN,
                    productNum = :productNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('mgrSSN', $this->mgrSSN);
            $stmt->bindParam('productNum', $this->productNum);
            
            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteData() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE mgrSSN = :mgrSSN AND productNum = :productNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->productNum = htmlspecialchars(strip_tags($this->productNum));

            // Bind data
            $stmt->bindParam('mgrSSN', $this->mgrSSN);
            $stmt->bindParam('productNum', $this->productNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }