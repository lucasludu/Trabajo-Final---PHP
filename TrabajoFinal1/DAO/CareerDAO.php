<?php namespace DAO;

    use \Exception as Exception;
    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;

    class CareerDAO implements ICareerDAO {
        private $connection;
      private $careerList = array();
        private $tableName = "careers";

        /****************************************** API ******************************************/

        private function consumeFromApi() {
            $careerList = array();
            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: " . API_KEY)
            );
            $context = stream_context_create($options);
            $response = file_get_contents(API_URL .'Career', false, $context);
            $arrayToDecode = json_decode($response, true);
            foreach($arrayToDecode as $valuesArray) {
                $career = new Career();
                $career->setCareerId($valuesArray['careerId']);
                $career->setDescription($valuesArray['description']);
                $career->setActive($valuesArray['active']);
                array_push($careerList, $career);
            
            }
            return $careerList;
        }


        private function RetrieveDataApi () {
            try {
                $ch = curl_init();
                if ($ch === false) {
                    throw new Exception('failed to initialize');
                }
                curl_setopt($ch, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Career');
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

        public function GetAllApi() {
            $jsonApi = $this->RetrieveDataApi();
            $careerList = array();
            foreach($jsonApi as $value) {
                $career = new Career();
                $career->setCareerId($value['careerId']);
                $career->setDescription($value['description']);
                $career->setActive($value['active']);
                array_push($this->careerList, $career);
            }
            return $careerList;
        }


        public function GetAll() {
            
            $this->consumeFromApi();
            return $this->careerList;
        }

        public function GetById($careerId) {
            try {
                $careerList = array();
                $toLowerCase = strtolower($careerId);
                $query = "SELECT * FROM ".$this->tableName. " WHERE (careerId = :careerId)";
                $parameters['careerId'] = $toLowerCase;

                $this->connection = Connection::GetInstance();
            ///    $resultSet =
             $this->connection->executeNonQuery($query, $parameters);
                
              //  foreach ($resultSet as $value) {                
                    $career = new Career();
                    $career->setCareerId(['careerId']);
                    $career->setDescription(['description']);
                    $career->setActive(['active']);
                   /// array_push($this->careerList, $career);
             //   }
                return $career;
            } catch(\PDOException $ex) {
                throw $ex;
            }
        }

        public function getCareerById($id) {
           $careerList =  $this->consumeFromApi();
            foreach ($this->careerList as $career) {
                if ($career->getCareerId() == $id){
                    return $career;
                }
            }
            return null;
        }


        /****************************************** BBDD ******************************************/

        public function AddPDO(Career $career) {
            try {
                $query = "INSERT INTO ".$this->tableName." (careerId, description, active) 
                    VALUES (:careerId, :description, :active);";

                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllPDO() {
            try {
                $careerList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $career = new career();
                    $career->setCareerId($row['careerId']);
                    $career->setDescription($row['description']);
                    $career->setActive($row['active']);
                    array_push($careerList, $career);
                }
                return $careerList;
            } catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function UpdateById($careerId, $description, $active) {
            try {
                $query = "UPDATE ".$this->tableName." SET careerId=:careerId, description=:description, active=:active WHERE careerId=:careerId;";

                $parameters["careerId"] = $description;
                $parameters["description"] = $description;
                $parameters["active"] = $active;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($careerId) {

            $sql = "DELETE FROM career WHERE careerId=:careerId";
            $parameters['careerId'] = $careerId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }
      
    }

?>