<?php
    Class Deliveries {
        private $connect;
        private $table = 'deliveries';

        //Delivery properties/attributes
        public $invoiceNum;
        public $dateOrdered;
        public $timeOrdered;
        public $dateScheduled;
        public $timeScheduled;

        //Create the database
        public function __construct($db) {
            $this->connect = $db;
        }


        //Get deliveries
        public function getDeliveries() {
            $query = 'SELECT 
                d.invoiceNum,
                d.dateOrdered,
                d.timeOrdered,
                d.dateScheduled,
                d.timeScheduled
            FROM
                ' . $this->table . ' d';

            //prepare the statement
            $stmt = $this->connect->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get a single delivery 
        public function getSingleDelivery() {
            $query = 'SELECT
                d.invoiceNum,
                d.dateOrdered,
                d.timeOrdered,
                d.dateScheduled,
                d.timeScheduled
            FROM
                ' . $this->table . ' d
            WHERE
                d.invoiceNum = ?
            LIMIT 0,1';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->invoiceNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->invoiceNum = $row['invoiceNum'];
            $this->dateOrdered = $row['dateOrdered'];
            $this->timeOrdered = $row['timeOrdered'];
            $this->dateScheduled = $row['dateScheduled'];
            $this->timeScheduled = $row['timeScheduled'];
        }

        // Function to create deliveries
        public function createDeliveries() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    invoiceNum = :invoiceNum,
                    dateOrdered = :dateOrdered,
                    timeOrdered = :timeOrdered,
                    dateScheduled = :dateScheduled,
                    timeScheduled = :timeScheduled';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam(':invoiceNum', $this->invoiceNum);
            $stmt->bindParam(':dateOrdered', $this->dateOrdered);
            $stmt->bindParam(':timeOrdered', $this->timeOrdered);
            $stmt->bindParam(':dateScheduled', $this->dateScheduled);
            $stmt->bindParam(':timeScheduled', $this->timeScheduled);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function updateDelivery() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    dateOrdered = :dateOrdered,
                    timeOrdered = :timeOrdered,
                    dateScheduled = :dateScheduled,
                    timeScheduled = :timeScheduled 
                WHERE
                    invoiceNum = :invoiceNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            $this->invoiceNum = htmlspecialchars(strip_tags($this->invoiceNum));
            $this->dateOrdered = htmlspecialchars(strip_tags($this->dateOrdered));
            $this->timeOrdered = htmlspecialchars(strip_tags($this->timeOrdered));
            $this->dateScheduled = htmlspecialchars(strip_tags($this->dateScheduled));
            $this->timeScheduled = htmlspecialchars(strip_tags($this->timeScheduled));


            //Bind data
            $stmt->bindParam(':invoiceNum', $this->invoiceNum);
            $stmt->bindParam(':dateOrdered', $this->dateOrdered);
            $stmt->bindParam(':timeOrdered', $this->timeOrdered);
            $stmt->bindParam(':dateScheduled', $this->dateScheduled);
            $stmt->bindParam(':timeScheduled', $this->timeScheduled);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete a delivery
        public function deleteDelivery() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE invoiceNum = :invoiceNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->invoiceNum = htmlspecialchars(strip_tags($this->invoiceNum));

            // Bind data
            $stmt->bindParam(':invoiceNum', $this->invoiceNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }