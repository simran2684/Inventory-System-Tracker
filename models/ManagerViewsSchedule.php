<?php
    Class ManagerViewsSchedule {
        private $connect;
        private $table = 'mgrViewsSchedule';

        // Buy properties/attribute

        public $mgrSSN;
        public $scheduleNum;
      

        // Create the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all cvs data
        public function getManagerViewsSchedule() {
            // Create query
            $query = 'SELECT
                g.mgrSSN,
                g.scheduleNum
            
            FROM
                ' . $this->table . ' g';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get one cvs data
        public function getSingleManagerViewsSchedule() {
            $query = 'SELECT
                g.mgrSSN,
                g.scheduleNum

            FROM
                ' . $this->table . ' g
            WHERE
                g.mgrSSN = ? AND
                g.scheduleNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->mgrSSN);
            $stmt->bindParam(2, $this->scheduleNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->MgrSSN = $row['mgrSSN'];
            $this->scheduleNum = $row['scheduleNum'];
           
        }


        //Create a cvs tuple
        public function createManagerViewsSchedule() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    mgrSSN = :mgrSSN,
                    scheduleNum = :scheduleNum';
                    

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('mgrSSN', $this->mgrSSN);
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
           

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete cvs data
        public function deleteManagerViewsSchedule() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE MgrSSN = :MgrSSN AND ScheduleNum = :ScheduleNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->mgrSSN = htmlspecialchars(strip_tags($this->mgrSSN));
            $this->scheduleNum = htmlspecialchars(strip_tags($this->scheduleNum));

            // Bind data
            $stmt->bindParam('mgrSSN', $this->mgrSSN);
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
           
            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }