<?php
    Class Schedule {
        private $connect;
        private $table = 'schedule';

        //Schedule properties/attributes

        public $scheduleNum;
        public $deliveryInvoiceNum;

        // Construct the database
        public function __construct($db) {
            $this->connect = $db;
        }


        //Get all schedules
        public function getSchedule() {
            //Query
            $query = 'SELECT
                s.scheduleNum,
                s.deliveryInvoiceNum
            FROM
                ' . $this->table . ' s';

            //Prepare statment
            $stmt  = $this->connect->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        //Get one schedule
        public function getSingleSchedule() {
            $query = 'SELECT
                s.scheduleNum,
                s.deliveryInvoiceNum
            FROM
                ' . $this->table . ' s
            WHERE
                s.scheduleNum = ?
            LIMIT 0,1';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->scheduleNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->scheduleNum = $row['scheduleNum'];
            $this->deliveryInvoiceNum = $row['deliveryInvoiceNum'];
        }


        //Create a schedule
        public function createSchedule() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    scheduleNum = :scheduleNum,
                    deliveryInvoiceNum = :deliveryInvoiceNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
            $stmt->bindParam('deliveryInvoiceNum', $this->deliveryInvoiceNum);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Update Schedule
        public function updateSchedule() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    deliveryInvoiceNum = :deliveryInvoiceNum
                WHERE
                    scheduleNum = :scheduleNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('scheduleNum', $this->scheduleNum);
            $stmt->bindParam('deliveryInvoiceNum', $this->deliveryInvoiceNum);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete Schedule
        public function deleteSchedule() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE scheduleNum = :scheduleNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->scheduleNum = htmlspecialchars(strip_tags($this->scheduleNum));

            // Bind data
            $stmt->bindParam(':scheduleNum', $this->scheduleNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }