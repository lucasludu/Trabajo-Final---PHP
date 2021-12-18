<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use DAO\Connection as Connection;

    class StudentDAO implements IStudentDAO {
        private $connection;
        private $studentList = array();
        private $studentUnico = array();

        /****************************************** API ******************************************/

        private function consumeFromApi() {
            $this->jobList = array();
            $options = array(
                'http' => array(
                'method'=>"GET",
                'header'=>"x-api-key: " . API_KEY)
            );
            $context = stream_context_create($options);
            $response = file_get_contents(API_URL .'Student', false, $context);
            $arrayToDecode = json_decode($response, true);
            foreach($arrayToDecode as $valuesArray) {
                $student = new Student();
                $student->setStudentId($valuesArray['studentId']);
                $student->setCareerId($valuesArray['careerId']);
                $student->setFirstName($valuesArray['firstName']);
                $student->setLastName($valuesArray['lastName']);
                $student->setDni($valuesArray['dni']);
                $student->setFileNumber($valuesArray['fileNumber']);
                $student->setGender($valuesArray['gender']);
                $student->setBirthDate($valuesArray['birthDate']);
                $student->setEmail($valuesArray['email']);
                $student->setPhoneNumber($valuesArray['phoneNumber']);
                $student->setActive($valuesArray['active']);
                array_push($this->studentList, $student);
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

        public function GetAllApi() {
            $jsonApi = $this->RetrieveDataApi();
            $studentList = array();

            foreach($jsonApi as $value) {
                $student = new Student();
                $student->setStudentId($value['studentId']);
                $student->setCareerId($value['careerId']);
                $student->setFirstName($value['firstName']);
                $student->setLastName($value['lastName']);
                $student->setDni($value['dni']);
                $student->setFileNumber($value['fileNumber']);
                $student->setGender($value['gender']);
                $student->setBirthDate($value['birthDate']);
                $student->setEmail($value['email']);
                $student->setPhoneNumber($value['phoneNumber']);
                $student->setActive($value['active']);

                array_push($studentList,$student);
            }
            return $studentList;
        }

        public function GetAll() {
            $this->consumeFromApi();
            return $this->studentList;            
        }

        public function GetApiByEmail ($email){
            $studentList = $this->GetAll();
            $student = null;

            foreach($studentList as $value){
                if ($value->getEmail() == $email){
                    $student = $value;
                }
            }
            return $student;
        }
        /****************************************** BBDD ******************************************/
    

        public function UpdateById($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active) {
            try {
                $query = "UPDATE ".$this->tableName." SET studentId=:studentId, careerId=:careerId, firstName=:firstName , lastName=:lastName, dni=:dni, fileNumber=:fileNumber, gender=:gender, birthDate=:birthDate, email=:email, phoneNumber=:phoneNumber, active=:active WHERE jobPositionId=:jobPositionId;";

                $parameters['studentId'] = $studentId;
                $parameters['careerId'] = $careerId;
                $parameters['firstName'] = $firstName;
                $parameters['lastName'] = $lastName;
                $parameters['dni'] = $dni;
                $parameters['fileNumber'] = $fileNumber;
                $parameters['gender'] = $gender;
                $parameters['birthDate'] = $birthDate;
                $parameters['email'] = $email;
                $parameters['phoneNumber'] = $phoneNumber;
                $parameters['active'] = $active;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch(Exception $ex) {
                throw $ex;
            }
        }

        public function DeleteById($studentId) {
            $sql = "DELETE FROM student WHERE studentId=:studentId";
            $parameters['studentId'] = $studentId;
            try {
                $this->connection = Connection::getInstance();
                return $this->connection->executeNonQuery($sql, $parameters);
            } catch (\PDOException $ex) {
                throw $ex;
            }
        }

        public function getStudentByMail($email) {
            $this->consumeFromApi();

            foreach ($this->studentList as $student) {
                if ($student->getEmail() == $email) {
                    return $student;
                }
            }
            return null;
        }

        public function traerdatos($email){
    
            $studentList = $this->GetAllApi();
            foreach($studentList as $stList){
                if($stList->getStudentByMail($email) == $email){
                    return $stList;
                }
            }
        }
    }

?>