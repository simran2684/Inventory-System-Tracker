<?php
    Class ManagerViewsSchedule {
        private $connect;
        private $table = 'mgrViewsSchedule';

        // Buy properties/attribute

        public $MgrSSN;
        public $ScheduleNum;
      

        // Create the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all cvs data
        public function getManagerViewsSchedule() {
            // Create query
            $query = 'SELECT
                g.MgrSSN,
                g.ScheduleNum
            
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
                g.MgrSSN,
                g.ScheduleNum

            FROM
                ' . $this->table . ' g
            WHERE
                g.MgrSSN = ? AND
                g.ScheduleNum = ?
            LIMIT 0,2';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->MgrSSN);
            $stmt->bindParam(2, $this->ScheduleNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->MgrSSN = $row['MgrSSN'];
            $this->scheduleNum = $row['ScheduleNum'];
           
        }


        //Create a cvs tuple
        public function createManagerViewsSchedule() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    MgrSSN = :MgrSSN,
                    ScheduleNum = :ScheduleNum';
                    

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('MgrSSN', $this->MgrSSN);
            $stmt->bindParam('ScheduleNum', $this->ScheduleNum);
           

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
            $this->MgrSSN = htmlspecialchars(strip_tags($this->MgrSSN));
            $this->ScheduleNum = htmlspecialchars(strip_tags($this->ScheduleNum));

            // Bind data
            $stmt->bindParam('MgrSSN', $this->MgrSSN);
            $stmt->bindParam('ScheduleNum', $this->ScheduleNum);
           
            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }