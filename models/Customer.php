<?php
    class Customer{
        private $connect;
        private $table = 'customer';

        //customer properties
        public $customerNum;
        public $paymentMethod;
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Customer
        public function readCustomer(){
            //Create query
            $query = 'Select
                c.customerNum,
                c.paymentMethod
                
            FROM
                ' . $this->table . ' c';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

        // Get a single customer
        public function getSingleCustomer() {
            $query = 'Select
                c.customerNum,
                c.paymentMethod
            FROM
                ' . $this->table . ' c
            WHERE
                c.customerNum = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->customerNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->customerNum = $row['customerNum'];
            $this->paymentMethod = $row['paymentMethod'];
          
        }


        // Create Customer
        public function createCustomer() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    customerNum = :customerNum,
                    paymentMethod = :paymentMethod,
                   
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->customerNum = htmlspecialchars(strip_tags($this->customerNum));
            $this->paymentMethod = htmlspecialchars(strip_tags($this->paymentMethod));
           

            // Bind data
            $stmt->bindParam(':customerNum', $this->customerNum);
            $stmt->bindParam(':paymentMethod', $this->paymentMethod);
          

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function updateCustomer() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    
                    paymentMethod = :paymentMethod
                   
                WHERE
                    customerNum = :customerNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean Data
            $this->customerNum = htmlspecialchars(strip_tags($this->customerNum));
            $this->paymentMethod = htmlspecialchars(strip_tags($this->paymentMethod));
           

            // Bind data
            $stmt->bindParam(':customerNum', $this->customerNum);
            $stmt->bindParam(':paymentMethod', $this->paymentMethod);
           

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        // Delete an customer
        public function deleteCustomer() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE customerNum = :customerNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->customerNum = htmlspecialchars(strip_tags($this->customerNum));

            // Bind data
            $stmt->bindParam(':customerNum', $this->customerNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        
    }
