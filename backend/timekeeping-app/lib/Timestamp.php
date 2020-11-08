<?php
    class Timestamp {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Get every user from given company
        public function getAll($company_id) {

            $params = array($company_id);

            $this->db->query("SELECT * FROM users WHERE company_id = ?;", $params);

            $results = $this->db->resultSet();
            return $results;
        }

        // Delete user with given id
        public function deleteUser($id, $company_id) {
            $params = array($id, $company_id);

            $this->db->query("DELETE FROM users WHERE id=? AND company_id=?;", $params);

            $results = $this->db->execute();

            return ($results) ? "success" : "error";
        }

        // Update user with given id
        public function updateUser($id, $first, $last, $email, $company_id) {

            // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
            $first = filter_var($first, FILTER_SANITIZE_STRING);
            $last = filter_var($last, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            if (!$this->validateData($first, $last, $email)) return "error - failed validation";
            if (!$this->checkIfEmailIsAvailable($email, $id)) return "error - email in use";

            $params = array($first, $last, $email, $id, $company_id);

            $this->db->query("UPDATE users SET first_name=?, last_name=?, email=? WHERE id=? AND company_id=?;", $params);    

            $results = $this->db->execute();

            return ($results) ? "success" : "error";
 
        }

        // Create user with given id
        public function createUser($first, $last, $email, $pwd, $authority_level,  $company_id) {

            // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
            $first = filter_var($first, FILTER_SANITIZE_STRING);
            $last = filter_var($last, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_STRING);
            $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);
            $authority_level  = filter_var($authority_level, FILTER_SANITIZE_STRING);

            if (!$this->validateData($first, $last, $email, $pwd, $authority_level)) return "error - failed validation";
            if (!$this->checkIfEmailIsAvailable($email, -1)) return "error - email in use";

            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

            $params = array($first, $last, $email, $hashedPwd, $authority_level, $company_id);

            $this->db->query("INSERT INTO users (first_name, last_name, email, password, authority_level, company_id) VALUES (?,?,?,?,?,?);", $params); 
            
            $results = $this->db->execute();

            $last_id = $this->db->lastInsertId();
            echo $last_id;

            // return ($results) ? $last_id : "error";

        }

        // Validate data for a user
        private function validateData($first = null, $last = null, $email = null, $pwd = null, $authority_level = null) {
            if ($first !== null) {
                if (empty($first) || !preg_match("/^[a-zA-Z]*$/", $first)) {
                    return false;
                }
            }

            if ($last !== null) {
                if (empty($last) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                    return false;
                }
            }

            if ($email !== null) {
                if (empty($last) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return false;
                }
            }

            if ($pwd !== null) {
                if (empty($pwd)) {
                    return false;
                }
            }

            if ($authority_level !== null) {
                if ($authority_level < 0 || $authority_level > 2) {
                    return false;
                }
            }
        
            return true;

        }

        // Check if an email already exists in the database
        private function checkIfEmailIsAvailable($email, $id) {

            $params = array($email, $id);

            $this->db->query("SELECT * FROM users WHERE email=? AND id<>?;", $params);    

            $results = $this->db->resultSet();

            $number_of_emails = count($results);

            return ($number_of_emails === 0);
        }

    }