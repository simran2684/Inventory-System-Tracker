<?php
    Class Clerk{
        private $connect;
        private $table = 'clerk';

        //clerk properties
        public $mgrSSN;
        public $id;
        public $yearsEmployed;
        public $hourlyWage;
        
        //DB constructor
        public function __construct($db) {
            $this -> connect = $db;
        }

        //Get Clerk
        public function readClerk(){
            //Create query
            $query = 'SELECT
                k.mgrSSN,
                k.id,
                k.yearsEmployed,
                k.hourlyWage
                
            FROM
                ' . $this->table . ' k';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }
        // Get a single clerk
        public function getSingleClerk() {
            $query = 'SELECT
                k.mgrSSN,
                k.ID,
                k.yearsEmployed,
                k.hourlyWage
            FROM
                ' . $this->table . ' k
            WHERE
                k.id = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->mgrSSN = $row['mgrSSN'];
            $this->yearsEmployed = $row['yearsEmployed'];
            $this->hourlyWage = $row['hourlyWage'];
           
        }


        // Create Clerk
        public function createClerk() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    id = :id,
                    mgrSSN = :mgrSSN,
                    yearsEmployed = :yearsEmployed,
                    hourlyWage = :hourlyWage';
                  
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->yearsEmployed = htmlspecialchars(strip_tags($this->yearsEmployed));
            $this->hourlyWage = htmlspecialchars(strip_tags($this->hourlyWage));
           
            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':yearsEmployed', $this->yearsEmployed);
            $stmt->bindParam(':hourlyWage', $this->hourlyWage);
           
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function updateClerk() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    mgrSSN = :mgrSSN,
                    yearsEmployed = :yearsEmployed,
                    hourlyWage = :hourlyWage;
                   
                WHERE
                     id = :id';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->yearsEmployed = htmlspecialchars(strip_tags($this->yearsEmployed));
            $this->hourlyWage = htmlspecialchars(strip_tags($this->hourlyWage));
           
            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':mgrSSN', $this->mgrSSN);
            $stmt->bindParam(':yearsEmployed', $this->yearsEmployed);
            $stmt->bindParam(':hourlyWage', $this->hourlyWage);
           
            

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        // Delete a clerk 
        public function deleteClerk() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


    }
