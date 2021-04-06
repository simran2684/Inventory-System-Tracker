<?php
    class Database {
        // Database Parameters
        private $host = 'localhost';
        private $db_name = 'inventoryTracker';
        private $username = 'root';
        private $password = 'abc123';
        private $connect;

        //Connect
        public function connect() {
            $this->connect = null;

            try {
                $this->connect = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->db_name, $this->username, $this->password);

                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo 'Connection Error: '. $e->getMessage();
            }

            return $this->connect;
        }
    }