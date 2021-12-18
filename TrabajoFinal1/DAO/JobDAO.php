<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IJobDAO as IJobDAO;
    use Models\Job as Job;
    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;
    class JobDAO implements IJobDAO {
        private $connection;
        private $jobList = array();
        private $tableName = "jobs";

        
        /****************************************** API ******************************************/

        private function consumeFromApi() {
            $this->jobList = array();
            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: " . API_KEY)
            );
            $context = stream_context_create($options);
            $response = file_get_contents(API_URL .'JobPosition', false, $context);
            $arrayToDecode = json_decode($response, true);
            foreach($arrayToDecode as $valuesArray) {
                $job = new Job ();
                $career = new Career();
                $job->setJobPositionId($valuesArray['jobPositionId']);
                $career->setCareerId($valuesArray['careerId']);
                $job->setCareer($career);
                $job->setDescription($valuesArray['description']);
                array_push($this->jobList, $job);
            }
        }


        private function RetrieveDataApi () {
            try {
                $ch = curl_init();
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                $content = curl_exec($ch);
                $toJson = json_decode($content, true);
                if ($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }
                $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            } catch(Exception $e) {         
                trigger_error(sprintf(
                    'Curl failed with error #%d: %s',
                    $e->getCode(), $e->getMessage()),
                    E_USER_ERROR);
            }
            return $toJson;
        }

/*        public function GetAllApi () {
            $jsonApi = $this->RetrieveDataApi();
            $userList = array();
            foreach($jsonApi as $value) {
                $job = new Job ();
                $job->setJobPositionId($value['jobPositionId']);
                $job->setCareerId($value['careerId']);
                $job->setDescription($value['description']);
                array_push($jobList,$job);
            }
            return $jobList;
        }*/

        public function GetAllApi ()
        {
            $jsonApi = $this->RetrieveDataApi();

            foreach($jsonApi as $value){
                $job = new Job ();
                $career = new Career();

                $career->setCareerId($value['careerId']);
                $job->setJobPositionId($value['jobPositionId']);
                $job->setCareer($career);

                $job->setDescription($value['description']);

                $this->Add($job);
            }

            return $jsonApi;
        }

        private function Add(Job $job)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description);";
                
                $parameters["jobPositionId"] = $job->getJobPositionId();
                $parameters["careerId"] = $job->getCareer()->getCareerId();
                $parameters["description"] = $job->getDescription();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetAll() {
            $this->consumeFromApi();
            return $this->jobList;
        }

        public function Get($id) {
            $this->RetrieveDataApi();
            return $this->jobList[$id];
        }

        public function GetById12 ($id)
        {
            try
            {
                $jobPositionList = array();

                $query = "SELECT * FROM ".$this->tableName. " jp WHERE (jp.jobPositionId = :id)";

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $job = new Job();
                    $job->setJobPositionId($row["jobPositionId"]);
                    $career = new Career();
                    $career->setCareerId($row["careerId"]);
                    $job->setCareer($career);
                    $job->setDescription($row["description"]);

                    array_push($jobPositionList, $job);
                }

                return $jobPositionList;
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function getById1 ($id)
        {
            $jobPositionList = $this->GetAll();

            foreach($jobPositionList as $jobPosition){
                if($jobPosition->getJobPositionId() == $id){
                    return $jobPosition;
                }
            }
        }

        /****************************************** BBDD ******************************************/

        public function AddPDO(Job $job) {
            try {

                $query = "INSERT INTO ". $this->tableName ." (jobPositionId,careerId,description) VALUES (:jobPositionId, :careerId, :description);";
                $parameters['jobPositionId'] = $job->getJobPositionId();
                $parameters['careerId'] = $job->getCareer()->getCareerId();
                $parameters['description'] = $job->getDescription();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function GetAllPDO() {
            try {
                $jobList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row) {
                    $job = new Job();
                    $career = new Career();
                    $career->setCareerId($row['careerId']);

                    $job->setJobPositionId($row['jobPositionId']);
                    $job->setCareer($career);

                    $job->setDescription($row['description']);
                    array_push($jobList, $job);
                }
                return $jobList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function UpdateById($jobPositionId, $careerId, $description) {
            try {
                $query = "UPDATE ".$this->tableName." SET jobPositionId=:jobPositionId, careerId=:careerId, description=:description WHERE jobPositionId=:jobPositionId;";

                $parameters['jobPositionId'] = $jobPositionId;
                $parameters['careerId'] = $careerId;
                $parameters['description'] = $description;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($jobPositionId) {
            $sql = "DELETE FROM job WHERE jobPositionId=:jobPositionId";
            $parameters['jobPositionId'] = $jobPositionId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function getJobById($id) {
            $this->consumeFromApi();
            foreach ($this->jobList as $job) {
                if ($job->getJobPositionId() == $id){
                    return $job;
                }
            }
            return null;
        }

    }
    
    



?>