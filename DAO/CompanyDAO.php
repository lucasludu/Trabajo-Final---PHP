<?php namespace DAO;
    
    use \Exception as Exception;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO {
        private $companyList = array();
        private $connection;
        private $tableName = "companies";

        public function AddPDO(Company $company) {
            try {
                $query = "INSERT INTO ".$this->tableName." (companyId,cuit,companyName, companyCity, companyDescription, companyEmail, companyPhoneNumber) 
                    VALUES (:companyId, :cuit, :companyName, :companyCity, :companyDescription, :companyEmail, :companyPhoneNumber);";
                    $parameters['companyId'] = $company->getCompanyId();
                    $parameters['cuit'] = $company->getCompanyCuit();
                    $parameters['companyName'] = $company->getCompanyName();
                    $parameters['companyCity'] = $company->getCompanyCity();
                    $parameters['companyDescription'] = $company->getCompanyDescription();
                    $parameters['companyEmail'] = $company->getCompanyEmail();
                    $parameters['companyPhoneNumber'] = $company->getCompanyPhoneNumber();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                echo "<script> if(alert('No se pudo agregar la empresa, ya esta ingresada ')); </script>";
                require_once(VIEWS_PATH."add-company.php");
            }
        }

        public function GetAllPDO() {
            try {
                $companyList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $newCompany = new Company();
                    $newCompany->setCompanyId($row['companyId']);
                    $newCompany->setCompanyCuit($row['cuit']);
                    $newCompany->setCompanyName($row['companyName']);
                    $newCompany->setCompanyCity($row['companyCity']);
                    $newCompany->setCompanyDescription($row['companyDescription']);
                    $newCompany->setCompanyEmail($row['companyEmail']);
                    $newCompany->setCompanyPhoneNumber($row['companyPhoneNumber']);
                    array_push($this->companyList , $newCompany);
                }
                return $companyList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function UpdateById($companyId, $cuit, $companyName, $companyCity, $companyDescription, $companyEmail, $companyPhoneNumber) {
            try {
                $query = "UPDATE ".$this->tableName." SET cuit=:cuit, companyName=:companyName, companyCity=:companyCity,  companyDescription=:companyDescription, companyEmail=:companyEmail, companyPhoneNumber=:companyPhoneNumber WHERE companyId=:companyId;";

                $parameters["companyId"] = $companyId;
                $parameters["cuit"] = $cuit;
                $parameters["companyName"] = $companyName;
                $parameters["companyCity"] = $companyCity;
                $parameters["companyDescription"] = $companyDescription;
                $parameters["companyEmail"] = $companyEmail;
                $parameters["companyPhoneNumber"] = $companyPhoneNumber;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($companyId) {

            $sql = "DELETE FROM companies WHERE companyId=:companyId";
            $parameters['companyId'] = $companyId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function SearchCompany($companyId) {
            $sql = "SELECT * FROM company WHERE companyId=:companyId";
            $parameters['companyId'] = $companyId;
            try {
                $this->connection = Connection::getInstance();
                $this->companyList = $this->connection->execute($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }/*
            if (!empty($this->companyList)) {
                return $this->retrieveData();
            } else {
                return false;
            }*/
        }

        
        public function GetAll() {
            $this->GetAllPDO();
            return $this->companyList;            
        }

        public function GetByName($companyName) {
            try {
                $companyList = array();
                $toLowerCase = strtolower($companyName);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (companyName = :companyName)";
                $parameters['companyName'] = $toLowerCase;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $company = new Company();
                    $company->setCompanyId($row['companyId']);
                    $company->setCompanyCuit($row['cuit']);
                    $company->setCompanyName($row['companyName']);
                    $company->setCompanyCity($row['companyCity']);
                    $company->setCompanyDescription($row['companyDescription']);
                    $company->setCompanyEmail($row['companyEmail']);
                    $company->setCompanyPhoneNumber($row['companyPhoneNumber']);
                    array_push($companyList, $company);
                }
                return $companyList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function GetByEmail($companyEmail) {
            try {
                $companyList = array();
                $toLowerCase = strtolower($companyEmail);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (companyEmail = :companyEmail)";
                $parameters['companyEmail'] = $toLowerCase;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $company = new Company();
                    $company->setCompanyId($row['companyId']);
                    $company->setCompanyCuit($row['cuit']);
                    $company->setCompanyName($row['companyName']);
                    $company->setCompanyCity($row['companyCity']);
                    $company->setCompanyDescription($row['companyDescription']);
                    $company->setCompanyEmail($row['companyEmail']);
                    $company->setCompanyPhoneNumber($row['companyPhoneNumber']);
                    array_push($companyList, $company);
                }
                return $companyList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function GetById($companyId) {
            try {
                $companyList = array();
                $toLowerCase = strtolower($companyId);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (companyId = :companyId)";
                $parameters['companyId'] = $toLowerCase;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $company = new Company();
                    $company->setCompanyId($row['companyId']);
                    $company->setCompanyCuit($row['cuit']);
                    $company->setCompanyName($row['companyName']);
                    $company->setCompanyCity($row['companyCity']);
                    $company->setCompanyDescription($row['companyDescription']);
                    $company->setCompanyEmail($row['companyEmail']);
                    $company->setCompanyPhoneNumber($row['companyPhoneNumber']);
                    array_push($companyList, $company);
                }
                return $companyList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        function remove($cuit)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE (cuit = :cuit)";
    
                $parameters["cuit"] =  $cuit;
    
                $this->connection = Connection::GetInstance();
    
                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $e)
            {
           ///     echo "<script> if(alert('No se pudo eliminar la empresa')); </script>";
            }
        }


    }
?>