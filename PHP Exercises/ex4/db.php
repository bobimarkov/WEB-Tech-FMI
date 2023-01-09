<?php
    class Db {
        private $connection;

        public function __construct()
        {
            $HOSTNAME = "localhost";
            $DB_NAME = "electives";
            $USER = "root";
            $PASSWORD = "";

            $this->connection = new PDO("mysql:host=$HOSTNAME;dbname=$DB_NAME", $USER, $PASSWORD); 
        }

        public function getConnection()
        {
            return $this->connection;
        }

        public function postData($title, $description, $lecturer) 
        {
            $insertion_template = $this->connection->prepare("
                INSERT INTO electives (TITLE, DESCRIPTION, LECTURER)
                VALUES (:title, :description, :lecturer)
            ");

            $insertion_template->execute(['title' => $title, 'description' => $description, 'lecturer' => $lecturer]);
        }

        public function updateDataByID($id, $title, $description, $lecturer) 
        {
            $update_template = $this->connection->prepare("
                UPDATE electives 
                SET title = :title,
                description = :description,
                lecturer = :lecturer
                where id = :id
            ");

            $update_template->execute(['title' => $title, 'description' => $description, 'lecturer' => $lecturer, 'id' => $id]);
        }

        public function getDataByID($id) {
            $get_data = $this->connection->prepare("
                SELECT TITLE, DESCRIPTION, LECTURER FROM electives
                WHERE ID = :id    
            ");

            $get_data -> execute(['id' => $id]);
            $rows = $get_data -> fetchALL(PDO::FETCH_NAMED);

            return $rows;
        }

    } 

?>