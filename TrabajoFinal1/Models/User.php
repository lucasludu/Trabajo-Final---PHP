<?php namespace Models;

    class User {
        private $userId;
        private $email;
        private $password;
        private $profile;
        private $question;


        public function getUserId() { return $this->userId; }
        public function getEmail() { return $this->email; }
        public function getPassword() { return $this->password; }
        public function getProfile() { return $this->profile; }
        public function getQuestion() { return $this->question; }

        public function setUserId($userId) { $this->userId = $userId; }
        public function setEmail($email) { $this->email = $email; }
        public function setPassword($password) { $this->password = $password; }
        public function setProfile($profile) { $this->profile = $profile; }
        public function setQuestion($question) { $this->question = $question; }
        
    }

?>