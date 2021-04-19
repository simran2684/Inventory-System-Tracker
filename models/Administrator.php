<?php
    class Administrator{
        private $connect;
        private $table = 'administrator';

        //administrator properties
        public $adminSSN;
        public $id;
        public $name;
        public $storeLocation;
        
        //DB constructor
        public function __construct($db) {
            $this -> connect = $db;
        }

        //Get Admin
        public function readAdministrator(){
            //Create query
            $query = 'SELECT
                a.adminSSN,
                a.id,
                a.storeLocation
                               
            FROM
                ' . $this->table . ' a';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }
        // Get a single administrator
        public function getSingleAdministrator() {
            $query = 'SELECT
                 a.adminSSN,
                a.id,
                a.storeLocation
            FROM
                ' . $this->table . ' a
            WHERE
                a.adminSSN = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind ssn
            $stmt->bindParam(1, $this->adminSSN);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->storeLocation = $row['storeLocation'];
        
        }


        // Create Administrator
        public function createAdministrator() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    adminSSN = :adminSSN,
                    id = :id,
                    storeLocation = :storeLocation';
                
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->adminSSN = htmlspecialchars(strip_tags($this->adminSSN));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->storeLocation = htmlspecialchars(strip_tags($this->storeLocation));
        


            // Bind data
            $stmt->bindParam(':adminSSN', $this->adminSSN);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':storeLocation', $this->storeLocation);
        
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //update Administrator
        public function updateAdministrator() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    id = :id,
                    storeLocation = :storeLocation
                
                WHERE
                    adminSSN = :adminSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind data
            $stmt->bindParam(':adminSSN', $this->adminSSN);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':storeLocation', $this->storeLocation);
     
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        // Delete an administrator 
        public function deleteAdministrator() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE adminSSN = :adminSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->adminSSN = htmlspecialchars(strip_tags($this->adminSSN));

            // Bind data
            $stmt->bindParam(':adminSSN', $this->adminSSN);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }



    }
