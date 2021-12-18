<?php namespace Models;

    class Appoitment {
        private  $student;
        private  $jobOffer;
        private $cv;
        private $message;

        public function getStudent() { return $this->student; }
        public function getJobOffer() { return $this->jobOffer; }
        public function getCv() { return $this->cv; }
        public function getMessage() { return $this->message; }

        public function setStudent(Student $student) { $this->student = $student; }
        public function setJobOffer(JobOffer $jobOffer) { $this->jobOffer = $jobOffer; }
        public function setCv($cv) { $this->cv = $cv; }
        public function setMessage($message) { $this->message = $message; }

    }

?>