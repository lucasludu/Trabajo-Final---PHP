<?php namespace Models;

        class Company {
                private $companyId;
                private $cuit;
                private $companyName;
                private $companyCity;
                private $companyDescription;
                private $companyEmail;
                private $companyPhoneNumber;

                public function getCompanyId() { return $this->companyId; }
                public function getCompanyCuit() { return $this->cuit; }
                public function getCompanyName() { return $this->companyName; }
                public function getCompanyCity() { return $this->city; }
                public function getCompanyDescription() { return $this->description; }
                public function getCompanyEmail() { return $this->email; }
                public function getCompanyPhoneNumber() { return $this->phoneNumber; }

                public function setCompanyId($companyId) { $this->companyId = $companyId; }
                public function setCompanyCuit($cuit) { $this->cuit = $cuit; }
                public function setCompanyName($companyName) { $this->companyName = $companyName; }
                public function setCompanyCity($city) { $this->city = $city; }
                public function setCompanyDescription($description) { $this->description = $description; }
                public function setCompanyEmail($email) { $this->email = $email; }
                public function setCompanyPhoneNumber($phoneNumber) { $this->phoneNumber = $phoneNumber; }
        }

?>