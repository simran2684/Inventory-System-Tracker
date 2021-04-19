<?php
    Class ClerkViewsSchedule {
        private $connect;
        private $table = 'clerkViewsSchedule';

        // Buy properties/attribute

        public $clerkId;
        public $scheduleNum;
      

        // Create the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all cvs data
        public function getClerkViewsSchedule() {
            // Create query
            $query = 'SELECT
                v.clerkId,
                v.scheduleNum
            
            FROM
                ' . $this->table . ' v';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get one cvs data
        public function getSingleClerkViewsSchedule() {
            $query = 'SELECT
                v.clerkId,
                v.scheduleNum

            FROM
                ' . $this->table . ' v
            WHERE
                v.clerkId = ? AND
                v.scheduleNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->clerkId);
            $stmt->bindParam(2, $this->scheduleNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->clerkId = $row['clerkId'];
            $this->scheduleNum = $row['scheduleNum'];
           
        }


        //Create a cvs tuple
        public function createClerkViewsSchedule() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    clerkId = :clerkId,
                    scheduleNum = :scheduleNum';
                    

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('clerkId', $this->clerkId);
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
           

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete cvs data
        public function deleteClerkViewsSchedule() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE clerkId = :clerkId AND scheduleNum = :scheduleNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->clerkId = htmlspecialchars(strip_tags($this->clerkId));
            $this->scheduleNum = htmlspecialchars(strip_tags($this->scheduleNum));

            // Bind data
            $stmt->bindParam('clerkId', $this->clerkId);
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
           
            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }