<?php
    Class Manager{
        private $connect;
        private $table = 'manager';

        //manager properties
        public $mgrSSN;
        public $id;
        public $storeLocation;
           
        
        //DB constructor
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get Manager
        public function readManager(){
            $query = 'SELECT 
                m.mgrSSN,
                m.id,
                m.storeLocation
            FROM
                ' . $this->table . ' m';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }
    

        

// Get a single manager
        public function getSingleManager() {
            $query = 'SELECT
                m.mgrSSN,
                m.id,
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
            $this->id = $row['id'];
            $this->storeLocation = $row['storeLocation'];
           
        }


        // Create Manager
        public function createManager() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    mgrSSN = :mgrSSN,
                    id = :id,
                    storeLocation = :storeLocation';
                  
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->storeLocation = htmlspecialchars(strip_tags($this->storeLocation));
           


            // Bind data
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':id', $this->id);
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
                    id = :id,
                    storeLocation = :storeLocation,
                   
                WHERE
                    mgrSSN = :mgrSSN';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean Data
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->ID = htmlspecialchars(strip_tags($this->id));
            $this->storeLocation = htmlspecialchars(strip_tags($this->storeLocation));
           

            // Bind data
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':id', $this->id);
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
