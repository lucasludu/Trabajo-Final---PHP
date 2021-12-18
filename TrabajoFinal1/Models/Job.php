<?php namespace Models;

    class Job {
        private $jobPositionId;
        private $career;
        private $description;
        
        public function getJobPositionId () { return $this->jobPositionId; }
        public function getCareer () { return $this->career; }
        public function getDescription () { return $this->description; }
        
        public function setJobPositionId($jobPositionId) { $this->jobPositionId = $jobPositionId; }
        public function setCareer(Career $career) { $this->career = $career; }
        public function setDescription($description) { $this->description = $description; }
    }
    
?>

