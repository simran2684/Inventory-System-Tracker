<?php
    class Manager{
        private $connect;
        private $table = 'manager';

        //manager properties
        public $mgrSSN;
        public $ID;
        public $storeLocation;
           
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Manager
        public function read(){
            //Create query
            $query = 'Select
                m.mgrSSN,
                m.ID,
                m.storeLocation
                
            FROM
                ' . $this->table . ' m';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

// Get a single manager
        public function getSingleManager() {
            $query = 'SELECT
                $query = 'Select
                m.mgrSSN,
                m.ID,
                m.storeLocation
            FROM
                ' . $this->table . ' m
            WHERE
                m.mgrSSN = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->mgrSSN);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->ID = $row['ID'];
            $this->storeLocation = $row['storeLocation'];
           
        }


        // Create Manager
        public function createManager() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    mgrSSN = :mgrSSN,
                    ID = :ID,
                    storeLocation = :storeLocation';
                  
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->storeLocation = htmlspecialchars(strip_tags($this->storeLocation));
           


            // Bind data
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':ID', $this->ID);
            $stmt->bindParam(':storeLocation', $this->storeLocation);
           
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function updateManager() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    ID = :ID,
                    storeLocation = :storeLocation,
                   
                WHERE
                    mgrSSN = :mgrSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean Data
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->ID = htmlspecialchars(strip_tags($this->ID));
            $this->storeLocation = htmlspecialchars(strip_tags($this->storeLocation));
           

            // Bind data
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':ID', $this->ID);
            $stmt->bindParam(':storeLocation', $this->storeLocation);
            

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        // Delete a manager 
        public function deleteManager() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE mgrSSN = :mgrSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));

            // Bind data
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }



    }
