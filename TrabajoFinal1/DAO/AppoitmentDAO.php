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

    class AppoitmentDAO implements IAppoitmentDAO {
        private $connection;
        private $tableName = "appoitments";
        private $tableUsers = "users";
        private $tableJobOffer = "jobOffers";
        private $tableCompany = "companies";
        private $tablePosition = "jobs";
        private $tableCareer = "careers";

        private $appoitmentList = array();


        public function AddPDO(Appoitment $appoitment) {

            try {

                $query = "INSERT INTO ".$this->tableName." (jobOfferId, studentId, message, cv) VALUES (:jobOfferId, :studentId, :message, :cv);";
                $parameters['jobOfferId'] = $appoitment->getJobOffer()->getJobOfferId();
                $parameters['studentId'] = $appoitment->getStudent()->getStudentId();
                $parameters['message'] = $appoitment->getMessage();
                $parameters['cv'] = $appoitment->getCv();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function GetAll() {
            try {
                $appoitmentList = array();

                $query = "SELECT a.message, a.cv, u.email, j.description, c.companyName FROM ".$this->tableName. " a INNER JOIN ". $this->tableUsers. " u on u.userId = a.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = a.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId INNER JOIN ". $this->tablePosition. " j on j.jobPositionId = jo.jobPositionId";
        ///       $query = "SELECT ap.message, ap.cv, u.email, j.description, c.companyName FROM ".$this->tableName. " ap INNER JOIN ". $this->tableUsers. " u on u.userId = ap.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = ap.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId INNER JOIN ". $this->tablePosition. " j on j.jobPositionId = jo.jobPositionId";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $appoitment['companyName'] = $row["companyName"];
                    $appoitment['description'] = $row["description"];
                    $appoitment['email'] = $row["email"];
                    $appoitment['message'] = $row["message"];
                    $appoitment['cv'] = $row["cv"];

                    array_push($appoitmentList, $appoitment);
                }
                return $appoitmentList;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function UpdateById($jobOfferId, $studentId, $message, $cv) {
            try {
                $query = "UPDATE ".$this->tableName." SET jobOfferId=:jobOfferId, studentId=:studentId, message=:message, cv=:cv WHERE jobOfferId=:jobOfferId;";

                $parameters["jobOfferId"] = $jobOfferId;
                $parameters["studentId"] = $studentId;
                $parameters["message"] = $message;
                $parameters["cv"] = $cv;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($jobOfferId) {

            $sql = "DELETE FROM appoitments WHERE jobOfferId=:jobOfferId";
            $parameters['jobOfferId'] = $jobOfferId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function GetByIdStudent($studentId)
        {
            try
            {
                $appoitmentList = array();

                $query = "SELECT ap.message, a.cv, u.email, j.description, c.companyName FROM ".$this->tableName. " ap INNER JOIN ". $this->tableUsers. " u on u.userId = ap.studentId INNER JOIN ". $this->tableJobOffer. " jo on jo.jobOfferId = ap.jobOfferId INNER JOIN ". $this->tableCompany. " c on c.companyId = jo.companyId INNER JOIN ". $this->tablePosition. " j on j.jobPositionId = jo.jobPositionId WHERE (u.userId = :studentId)";

                $parameters["studentId"] =  $studentId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $appoitment['companyName'] = $row["companyName"];
                    $appoitment['description'] = $row["description"];
                    $appoitment['email'] = $row["email"];
                    $appoitment['message'] = $row["message"];
                    $appoitment['cv'] = $row["cv"];

                    array_push($appoitmentList, $appoitment);
                }

                return $appoitmentList;
            }
            catch(\PDOException $ex)
            {
                echo "<script> if(alert('No tiene postulaciones realizadas')); </script>";
            }
        }
    }
?>