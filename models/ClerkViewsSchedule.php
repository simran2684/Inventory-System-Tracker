<?php
    Class ClerkViewsSchedule {
        private $connect;
        private $table = 'clerkViewsSchedule';

        // Buy properties/attribute

        public $ClerkID;
        public $ScheduleNum;
      

        // Create the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all cvs data
        public function getClerkViewsSchedule() {
            // Create query
            $query = 'SELECT
                v.ClerkID,
                v.ScheduleNum
            
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
                v.ClerkID,
                v.ScheduleNum

            FROM
                ' . $this->table . ' v
            WHERE
                v.ClerkID = ? AND
                v.ScheduleNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->ClerkID);
            $stmt->bindParam(2, $this->ScheduleNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->clerkId = $row['ClerkID'];
            $this->scheduleNum = $row['ScheduleNum'];
           
        }


        //Create a cvs tuple
        public function createClerkViewsSchedule() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    ClerkID = :ClerkID,
                    ScheduleNum = :ScheduleNum';
                    

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('ClerkID', $this->ClerkID);
            $stmt->bindParam('ScheduleNum', $this->ScheduleNum);
           

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete cvs data
        public function deleteClerkViewsSchedule() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE ClerkID = :ClerkID AND ScheduleNum = :ScheduleNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->ClerkID = htmlspecialchars(strip_tags($this->ClerkID));
            $this->ScheduleNum = htmlspecialchars(strip_tags($this->ScheduleNum));

            // Bind data
            $stmt->bindParam('ClerkID', $this->ClerkID);
            $stmt->bindParam('ScheduleNum', $this->ScheduleNum);
           
            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }