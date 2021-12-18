<?php namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\IJobOfferDAO as IJobOfferDAO;
use DAO\IJobDAO as IJobDAO;
use DAO\IAppoitmentDAO as IAppoitmentDAO;
use DAO\ICompanyDAO as ICompanyDAO;
use DAO\IStudentDAO as IStudentDAO;
use Models\Appoitment as Appoitment;
use Models\Company as Company;
use Models\Job as Job;
use Models\Career as Career;
use Models\Student as Student;
use Models\JobOffer as JobOffer;



class JobOfferDAO implements IJobOfferDAO {

        private $connection;
        private $tableName = "joboffers";
        private $tableJob = "jobs";
        private $tableCompany = "companies";

        private $jobOfferList = array();


        public function AddPDO(JobOffer $jobOffer) {
            try {
        
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, publishedDate, finishDate, task, skills, salary, jobPositionId, companyId) VALUES (:jobOfferId, :publishedDate, :finishDate, :task, :skills, :salary, :jobPositionId, :companyId);";
                $parameters['jobOfferId'] = $jobOffer->getJobOfferId();
                $parameters['publishedDate'] = $jobOffer->getPublishedDate();
                $parameters['finishDate'] = $jobOffer->getFinishDate();
                $parameters['task'] = $jobOffer->getTask();
                $parameters['skills'] = $jobOffer->getSkills();
                $parameters['salary'] = $jobOffer->getSalary();
                $parameters['jobPositionId'] = $jobOffer->getJobs()->getJobPositionId();
                $parameters['companyId'] = $jobOffer->getCompany()->getCompanyId();
              ///  $parameters['careerId'] = $jobOffer->getCareer()->getCareerId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }


        public function GetAllPDO() {
            try {
                $jobOfferList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $newJobOffer = new JobOffer();
                    $job = new Job();
                    $job->setJobPositionId($row["jobPositionId"]);

                    $company = new Company();
                    $company->setCompanyId($row["companyId"]);

                    $newJobOffer->setJobOfferId($row['jobOfferId']);
                    $newJobOffer->setPublishedDate($row['publishedDate']);
                    $newJobOffer->setFinishDate($row['finishDate']);
                    $newJobOffer->setTask($row['task']);
                    $newJobOffer->setSkills($row['skills']);
                    $newJobOffer->setSalary($row['salary']);
                    $newJobOffer->setJobs($job);
                    $newJobOffer->setCompany($company);
                  ///  $newJobOffer->setCareer()->setCar($row['careerId']);

                    array_push($this->jobOfferList , $newJobOffer);
                }
                return $jobOfferList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetJobOfferStudent($careerId) {
            try {
                $jobOfferList = array();

                $query = "SELECT  jo.jobOfferId, jo.salary, j.description, c.companyName FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJob. " j on j.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId WHERE (j.careerId =:careerId)";

                $parameters['careerId'] = $careerId;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {     
                    $jobOff['jobOfferId'] = $row["jobOfferId"];           
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['companyName'] = $row["companyName"];
                    array_push($jobOfferList, $jobOff);

                }
                return $jobOfferList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function UpdateById($jobOfferId, $title, $publishedDate, $finishDate, $task, $skills, $salary, $jobPosition) {
            try {
                $query = "UPDATE ".$this->tableName." SET jobOfferId=:jobOfferId, title=:title, publishedDate=:publishedDate,  finishDate=:finishDate, task=:task, skills=:skills, jobPosition=:jobPosition WHERE jobOfferId=:jobOfferId;";

                $parameters["jobOfferId"] = $jobOfferId;
                $parameters["title"] = $title;
                $parameters["publishedDate"] = $publishedDate;
                $parameters["finishDate"] = $finishDate;
                $parameters["task"] = $task;
                $parameters["skills"] = $skills;
                $parameters["salary"] = $salary;
                $parameters["jobPosition"] = $jobPosition;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($jobOfferId) {

            try {
                $query = "DELETE FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId)";
                $parameters["jobOfferId"] =  $jobOfferId;
                $this->connection = Connection::GetInstance();
                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $e)
            {
           ///     echo "<script> if(alert('No se pudo eliminar la empresa')); </script>";
            }
        }

        public function GetAll() {
            $this->GetAllPDO();
            return $this->jobOfferList;            
        }

        public function GetAllStudent()
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.salary, j.description, c.companyName FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJob. " j on j.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOff['jobOfferId'] = $row["jobOfferId"];
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['companyName'] = $row["companyName"];

                    array_push($jobOfferList, $jobOff);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function searchJobOfferById($jobOfferId)
        {
            $sql = "SELECT * FROM joboffers WHERE jobOfferId=:jobOfferId";
            $parameters['jobOfferId'] = $jobOfferId;
    
            try {
                $this->connection = Connection::getInstance();
                $this->jobOfferList = $this->connection->execute($sql, $parameters);
            } catch (\PDOException $exception) {
                throw $exception;
            }
           
            if (!empty($this->jobOfferList)) {
                return $this->retrieveDataSingleJobOffer();
            } else {
                return false;
            }
        }

        public function retrieveDataSingleJobOffer(){

            foreach ($this->jobOfferList as $row) {
                $newJobOffer = new JobOffer();
                $job = new Job();
                $company = new Company();
                $career = new Career();

                $newJobOffer->setJobOfferId($row['jobOfferId']);
                $newJobOffer->setPublishedDate($row['publishedDate']);
                $newJobOffer->setFinishDate($row['finishDate']);
                $newJobOffer->setTask($row['task']);
                $newJobOffer->setSkills($row['skills']);
                $newJobOffer->setSalary($row['salary']);
                $job->setJobPositionId($row['jobPositionId']);
                $company->setCompanyId($row['companyId']);
                $career->setCareerId($row['careerId']);
                $newJobOffer->setjobs($job);
                $newJobOffer->setCompany($company);
                $newJobOffer->setCareer($career);
                
            }
            return  $newJobOffer;
        }

        public function FindById($jobOfferId) {
            try {
                $jobOfferList = array();
                $toLowerCase = strtolower($jobOfferId);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (jobOfferId = :jobOfferId)";
                $parameters['jobOfferId'] = $toLowerCase;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                $company = new CompanyDAO();
            
                foreach ($resultSet as $row) {                
                    $newJobOffer = new JobOffer();
                    $newJobOffer->getJobOfferId($row['jobOfferId']);
                    $newJobOffer->setPublishedDate($row['publishedDate']);
                    $newJobOffer->setFinishDate($row['finishDate']);
                    $newJobOffer->setTask($row['task']);
                    $newJobOffer->setSkills($row['skills']);
                    $newJobOffer->setSalary($row['salary']);
                    $newJobOffer->getJobs()->setJobPositionId($row['jobPositionId']);
                   $newJobOffer->getCompany()->setCompanyId($row['companyId']);
                    $newJobOffer->getCareer()->setCareerId($row['careerId']);
                    array_push($jobOfferList, $newJobOffer);


                } 
                    return $jobOfferList;
            }catch(\PDOException $ex) {
                throw $ex;
            }
        }



        function remove($jobOfferId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId)";
    
                $parameters["jobOfferId"] =  $jobOfferId;
    
                $this->connection = Connection::GetInstance();
    
                return $count=$this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\Exception $e)
            {
           ///     echo "<script> if(alert('No se pudo eliminar la empresa')); </script>";
            }
        }

        public function GetOffersByJobPosition($job)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.salary, j.description, c.companyName FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " j on j.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId
                WHERE (jp.description = :job)";

                $parameters['jobP']=$job;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $jobOff['jobOfferId'] = $row["jobOfferId"];
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['companyName'] = $row["companyName"];

                    array_push($jobOfferList, $jobOff);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

        public function GetOffersByCareer($career)
        {
            try
            {
                $jobOfferList = array();

                $query = "SELECT jo.jobOfferId, jo.projectDescription, jo.salary, jo.remote, jp.description, c.name FROM ". $this->tableName. " jo INNER JOIN ". $this->tableJobPosition. " jp on jp.jobPositionId = jo.jobPositionId INNER JOIN ". $this->tableCompany. " c on c.copmanyId = jo.copmanyId INNER JOIN ". $this->tableCareer. " car on car.careerId = jp.careerId
                WHERE (car.description = :career)";

                $parameters['career']=$career;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $jobOff['jobOfferId'] = $row["jobOfferId"];
                    $jobOff['projectDescription'] = $row["projectDescription"];
                    $jobOff['salary'] = $row["salary"];
                    $jobOff['remote'] = $row["remote"];
                    $jobOff['description'] = $row["description"];
                    $jobOff['name'] = $row["name"];

                    array_push($jobOfferList, $jobOff);
                }

                return $jobOfferList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No se pudo listar las ofertas laborales')); </script>";
            }
        }

       
        
    
    }
?>